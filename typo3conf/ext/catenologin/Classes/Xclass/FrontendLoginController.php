<?php
namespace Isb\Catenologin\Xclass;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Manfred Ursprung <manfred@manfred-ursprung.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * XCLASS of FrontendLoginController
 *
 *
 *
 * @author        Manfred Ursprung <manfred@manfred-ursprung.de>
 * @package       TYPO3
 * @subpackage    catenologin
 */

class FrontendLoginController extends \TYPO3\CMS\Felogin\Controller\FrontendLoginController {

	protected $userEmail;
	/**
	 * Shows the forgot password form
	 *
	 * @return string Content
	 */
	protected function showForgot() {
		//echo ' in XCLASS';
		//die();
		$subpart = $this->cObj->getSubpart($this->template, '###TEMPLATE_FORGOT###');
		$subpartArray = ($linkpartArray = array());

		$postData = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST($this->prefixId);

		if ($postData['forgot_email']) {
			// Get hashes for compare
			$postedHash = $postData['forgot_hash'];
			$hashData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'forgot_hash');
			if ($postedHash === $hashData['forgot_hash']) {
				$row = FALSE;
				// Look for user record
				$data = $GLOBALS['TYPO3_DB']->fullQuoteStr($this->piVars['forgot_email'], 'fe_users');
				$this->userEmail = $data;
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'uid, username, name, password, email',
					'fe_users',
					//'(email=' . $data . ' OR username=' . $data . ') AND pid IN (' . $GLOBALS['TYPO3_DB']->cleanIntList($this->spid) . ') ' . $this->cObj->enableFields('fe_users')
					'email=' . $data . '  AND pid IN (' . $GLOBALS['TYPO3_DB']->cleanIntList($this->spid) . ') ' . $this->cObj->enableFields('fe_users')
				);
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
					$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
					$mailNotFound = false;
				}else{

					$mailNotFound = true;
					$error = true;
				}
				$error = NULL;
				if ($row) {
					// Generate an email with the hashed link
					$error = $this->generateAndSendHash($row);
				} elseif ($this->conf['exposeNonexistentUserInForgotPasswordDialog']) {
					$error = $this->pi_getLL('ll_forgot_reset_message_error');
				}
				// Generate message
				if($mailNotFound){
					if(strlen($this->userEmail) == 0 || !(\TYPO3\CMS\Core\Utility\GeneralUtility::validEmail($this->userEmail))){
						$errorMsg = $this->pi_getLL('ll_msg_email_invalid');
					}else{
						$errorMsg = $this->pi_getLL('ll_forgot_reset_message_error');
					}
					$markerArray['###STATUS_MESSAGE###'] = $this->cObj->stdWrap($errorMsg, $this->conf['forgotErrorMessage_stdWrap.']);
				}elseif ($error) {
					$markerArray['###STATUS_MESSAGE###'] = $this->cObj->stdWrap($error, $this->conf['forgotErrorMessage_stdWrap.']);
				} else {
					$markerArray['###STATUS_MESSAGE###'] = $this->cObj->stdWrap(
						$this->pi_getLL('ll_forgot_reset_message_emailSent', '', 1),
						$this->conf['forgotResetMessageEmailSentMessage_stdWrap.']
					);
				}
				$subpartArray['###FORGOT_FORM###'] = '';
			} else {
				// Wrong email
				$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('forgot_reset_message', $this->conf['forgotMessage_stdWrap.']);
				$markerArray['###BACKLINK_LOGIN###'] = '';
			}
		} else {
			$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('forgot_reset_message', $this->conf['forgotMessage_stdWrap.']);
			$markerArray['###BACKLINK_LOGIN###'] = '';
		}
		$markerArray['###BACKLINK_LOGIN###'] = $this->getPageLink($this->pi_getLL('ll_forgot_header_backToLogin', '', 1), array());
		$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('forgot_header', $this->conf['forgotHeader_stdWrap.']);
		$markerArray['###LEGEND###'] = $this->pi_getLL('legend', $this->pi_getLL('reset_password', '', 1), 1);
		$markerArray['###ACTION_URI###'] = $this->getPageLink('', array($this->prefixId . '[forgot]' => 1), TRUE);
		$markerArray['###EMAIL_LABEL###'] = $this->pi_getLL('your_email', '', 1);
		$markerArray['###FORGOT_PASSWORD_ENTEREMAIL###'] = $this->pi_getLL('forgot_password_enterEmail', '', 1);
		$markerArray['###FORGOT_EMAIL###'] = $this->prefixId . '[forgot_email]';
		$markerArray['###SEND_PASSWORD###'] = $this->pi_getLL('reset_password', '', 1);
		$markerArray['###DATA_LABEL###'] = $this->pi_getLL('ll_enter_your_data', '', 1);
		$markerArray = array_merge($markerArray, $this->getUserFieldMarkers());
		// Generate hash
		$hash = md5($this->generatePassword(3));
		$markerArray['###FORGOTHASH###'] = $hash;
		// Set hash in feuser session
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'forgot_hash', array('forgot_hash' => $hash));
		return $this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray);
	}


	/**
	 * Generates a hashed link and send it with email
	 *
	 * @param array $user Contains user data
	 * @return string Empty string with success, error message with no success
	 */
	protected function generateAndSendHash($user) {
		$hours = intval($this->conf['forgotLinkHashValidTime']) > 0 ? intval($this->conf['forgotLinkHashValidTime']) : 24;
		$validEnd = time() + 3600 * $hours;
		$validEndString = date($this->conf['dateFormat'], $validEnd);
		$hash = md5(\TYPO3\CMS\Core\Utility\GeneralUtility::generateRandomBytes(64));
		$randHash = $validEnd . '|' . $hash;
		$randHashDB = $validEnd . '|' . md5($hash);
		// Write hash to DB
		$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('fe_users', 'uid=' . $user['uid'], array('felogin_forgotHash' => $randHashDB));
		// Send hashlink to user
		$this->conf['linkPrefix'] = -1;
		$isAbsRelPrefix = !empty($GLOBALS['TSFE']->absRefPrefix);
		$isBaseURL = !empty($GLOBALS['TSFE']->baseUrl);
		$isFeloginBaseURL = !empty($this->conf['feloginBaseURL']);
		$link = $this->pi_getPageLink($GLOBALS['TSFE']->id, '', array(
			$this->prefixId . '[user]' => $user['uid'],
			$this->prefixId . '[forgothash]' => $randHash
		));
		// Prefix link if necessary
		if ($isFeloginBaseURL) {
			// First priority, use specific base URL
			// "absRefPrefix" must be removed first, otherwise URL will be prepended twice
			if (!empty($GLOBALS['TSFE']->absRefPrefix)) {
				$link = substr($link, strlen($GLOBALS['TSFE']->absRefPrefix));
			}
			$link = $this->conf['feloginBaseURL'] . $link;
		} elseif ($isAbsRelPrefix) {
			// Second priority
			// absRefPrefix must not necessarily contain a hostname and URL scheme, so add it if needed
			$link = GeneralUtility::locationHeaderUrl($link);
		} elseif ($isBaseURL) {
			// Third priority
			// Add the global base URL to the link
			$link = $GLOBALS['TSFE']->baseUrlWrap($link);
		} else {
			// No prefix is set, return the error
			return $this->pi_getLL('ll_change_password_nolinkprefix_message');
		}
		$msg = sprintf($this->pi_getLL('ll_forgot_validate_reset_password', '', 0), $user['name'], $link, $validEndString);
		// Add hook for extra processing of mail message
		if (
			isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['felogin']['forgotPasswordMail'])
			&& is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['felogin']['forgotPasswordMail'])
		) {
			$params = array(
				'message' => &$msg,
				'user' => &$user
			);
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['felogin']['forgotPasswordMail'] as $reference) {
				if ($reference) {
					GeneralUtility::callUserFunction($reference, $params, $this);
				}
			}
		}
		// no RDCT - Links for security reasons
		$oldSetting = $GLOBALS['TSFE']->config['config']['notification_email_urlmode'];
		$GLOBALS['TSFE']->config['config']['notification_email_urlmode'] = 0;
		// Send the email
		$this->cObj->sendNotifyEmail($msg, $user['email'], '', $this->conf['email_from'], $this->conf['email_fromName'], $this->conf['replyTo']);
		// Restore settings
		$GLOBALS['TSFE']->config['config']['notification_email_urlmode'] = $oldSetting;
		return '';
	}

}