<?php
namespace Isb\Catenologin\Controller;

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
 * Page Controller
 *
 * Controller which is used to do login of frontenduser
 *
 *
 * @package Catenologin
 * @subpackage Controller
 * @route off
 */
class LoginController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	public $storagePid;
	public $extKey;




	public function initializeAction(){
		parent::initializeAction();

		//fallback to current pid if no storagePid is defined
		if (version_compare(TYPO3_version, '6.0.0', '>=')) {
			$configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		} else {
			$configuration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		}
		//t3lib_utility_Debug::debugInPopUpWindow($configuration);
		if (empty($configuration['persistence']['storagePid'])) {
			$currentPid['persistence']['storagePid'] = $GLOBALS["TSFE"]->id;
			$currentPid['persistence']['storagePid'] = 41;
			$this->configurationManager->setConfiguration(array_merge($configuration, $currentPid));
			$this->storagePid = $currentPid['persistence']['storagePid'];
		}
		$this->configuration = $configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		//$this->response->addAdditionalHeaderData('<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAEcQo2dy8dM0fA429C0ZZIcKKyH71r2Tc&amp;sensor=false" type="text/javascript"></script>');
		$this->extKey = 'catenologin';
	}




	/**
	 * @return string
	 * this is it
	 */
	public function getUserNameAction(){
        $returnValue = array('isMaster' => false, 'username' => '');
		$requestParams = $this->request->getArguments();
		if(count($requestParams) == 0){
			//return '';
		}else{
			$username = $this->searchUserName( $requestParams['user']);

			$returnValue['username'] = $username;
			if(isset($requestParams['pass'])){
				$isMaster = $this->checkForMaster($requestParams['pass']);

				if($isMaster){
					if($this->checkForIp()){
						$returnValue['isMaster'] = $isMaster;
						//anmelden des User
						$GLOBALS['TSFE']->fe_user->checkPid = 0;
						$info = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
						$user = $GLOBALS['TSFE']->fe_user->fetchUserRecord( $info['db_user'], $username );
						$GLOBALS["TSFE"]->fe_user->user = $GLOBALS["TSFE"]->fe_user->fetchUserSession();
						$GLOBALS['TSFE']->loginUser = 1;
						$GLOBALS['TSFE']->fe_user->fetchGroupData();
						$GLOBALS['TSFE']->fe_user->start();
						$GLOBALS["TSFE"]->fe_user->createUserSession($user);
						$GLOBALS["TSFE"]->fe_user->loginSessionStarted = TRUE;
					}else{
                        return json_encode('Hallo, hier else-Zweig 3.ebene');
						//für Debug Zwecke
						/* $returnValue['ipaddresse'] = $_SERVER['REMOTE_ADDR'];
						$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]);
						$returnValue['validIpAddresses'] = $confArr['mbIpAddresses'];
						*/
					}
				}else{
                    return json_encode('Hallo, hier else-Zweig2.ebene');
                }
			}else{
                return json_encode($requestParams);
            }
			//return $username;

		}
		return json_encode($returnValue);

	}


	/**
	 * only in development environment used
	 */
	public function indexAction(){
		$requestParams = $this->request->getArguments();
		if(count($requestParams) == 0){
			$params = array(
				'permalogin' => 0,
				'storagePid' => $this->settings['userStoragePage'],
				'redirectUrl' => $this->settings['redirectToSuccess']
			);

			$this->view->assign('params', $params);
		}else{
			$result = $this->searchUser(array('user' => $requestParams['user'], 'pass' => $requestParams['pass']));
			$requestParams['result'] = $result;
			$this->view->assign('params', $requestParams);
		}
	}

	/**
	 * @param $userInput
	 * @return mixed
	 * main method to get the right username from userinput
	 */
	protected function searchUserName($userInput){
		//username von DB holen
		$query = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Query', 'TYPO3\\CMS\\Extbase\\Domain\\Model\\FrontendUser');
		$defaultQuerySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		// go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

		// don't add the pid constraint
		$defaultQuerySettings->setRespectStoragePage(FALSE);
		// add fields from enablecolumns constraint
        $defaultQuerySettings->setIgnoreEnableFields(TRUE);
		// don't add sys_language_uid constraint
		$defaultQuerySettings->setRespectSysLanguage(FALSE);
		$defaultQuerySettings->setReturnRawQueryResult(TRUE);
		$query->setQuerySettings($defaultQuerySettings);

		//Prüfe erst Username, m_customer_id (Kundennummer), dann die Email
		//$query->statement('SELECT uid, username FROM fe_users WHERE username like \'' . $userInput .'\'');
		$query->statement('SELECT uid, username FROM fe_users WHERE username like ?', array($userInput));
		$result = $query->execute();
		if(count($result) > 0){
			$userName = $result[0]['username'];
		}else{
			//Check Kundennummer
			//$query->statement('SELECT uid, username FROM fe_users WHERE m_customer_id like \'' . $userInput .'\'');
			$query->statement('SELECT uid, username FROM fe_users WHERE m_customer_id like ?', array($userInput));
			$result = $query->execute();
			if(count($result) > 0){
				$userName = $result[0]['username'];
			}else{
				//Check Email
				$query->statement('SELECT uid, username FROM fe_users WHERE email like ?', array($userInput));
				$result = $query->execute();
				if(count($result) > 0){
					$userName = $result[0]['username'];
				}else{
					//$userName = '';
					$userName =  $userInput;
				}
			}

		}
		return $userName;

	}


	protected function checkForMaster($passWd){
		$isMaster = false;
		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]);
		$masterPw = $confArr['mbMasterPassword'];
		if (!empty($masterPw)) {
			$isMaster = $masterPw == $passWd;
		}
		return $isMaster;
	}

	/**
	 * @return boolean
	 * wenn keine IP-Adressen angegeben sind, dann gibt die Methode TRUE zurück
	 */
	protected function checkForIp(){
		$isValid = false;
		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]);

		if (!empty($confArr['mbIpAddresses'])) {
			$ipAddresses = explode(',', $confArr['mbIpAddresses']);
			$remoteAddr = $_SERVER['REMOTE_ADDR'];
			foreach($ipAddresses as $ipAddress) {
				if(trim($ipAddress) == $remoteAddr) {
					$isValid = true;
					break;
				}
			}
		}else{
			$isValid = true;
		}
		return $isValid;
	}




	/**
	 * @param array $loginData
	 */
	protected function searchUser($loginData){
		$loginData = array(
			'uname' => $loginData['user'],
			'uident' => $loginData['pass'],
			'status' => 'login'
		);

		//username von DB holen
		$query = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Query', 'TYPO3\\CMS\\Extbase\\Domain\\Model\\FrontendUser');
		$defaultQuerySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		// go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

          // don't add the pid constraint
         $defaultQuerySettings->setRespectStoragePage(FALSE);
        // don't add fields from enablecolumns constraint
        $defaultQuerySettings->setIgnoreEnableFields(TRUE);
         // don't add sys_language_uid constraint
         $defaultQuerySettings->setRespectSysLanguage(FALSE);
         $query->setQuerySettings($defaultQuerySettings);
		//$query = $this->frontendUserRepository->createQuery();
		$query->statement('SELECT uid FROM fe_users WHERE username like \'' . $loginData['uname'] .'\'');
		$result = $query->execute();
		return $result;


		if(is_object($query)){
			echo 'Query Ausgabe';
		}else{
			echo 'Query ist nicht existen';
		}

		$GLOBALS['TSFE']->fe_user->checkPid = 0;
		$info = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
		$user = $GLOBALS['TSFE']->fe_user->fetchUserRecord( $info['db_user'], $loginData['uname'] );
		if ( $GLOBALS['TSFE']->fe_user->compareUident($user,$loginData) );
		{
			$GLOBALS["TSFE"]->fe_user->user = $GLOBALS["TSFE"]->fe_user->fetchUserSession();
			$GLOBALS['TSFE']->loginUser = 1;
			$GLOBALS['TSFE']->fe_user->fetchGroupData();
			$GLOBALS['TSFE']->fe_user->start();
			$GLOBALS["TSFE"]->fe_user->createUserSession($user);
			$GLOBALS["TSFE"]->fe_user->loginSessionStarted = TRUE;
		}

	}
	/**
	 * @param array $loginData

	protected function compareUident($loginData, $security_level='superchallenged'){
		$OK = FALSE;
		$security_level = $security_level ? $security_level : $this->security_level;

		switch ($security_level)	{
			case 'superchallenged':		// If superchallenged the password in the database ($user[$this->userident_column]) must be a md5-hash of the original password.
			case 'challenged':
				// Check challenge stored in cookie:
				if ($this->challengeStoredInCookie)	{
					session_start();
					if ($_SESSION['login_challenge'] !== $loginData['chalvalue']) {
						if ($this->writeDevLog) 	t3lib_div::devLog('PHP Session stored challenge "'.$_SESSION['login_challenge'].'" and submitted challenge "'.$loginData['chalvalue'].'" did not match, so authentication failed!', 't3lib_userAuth', 2);
						$this->logoff();
						return FALSE;
					}
				}
				/* CATENO MOD START
				$chkFields = array($this->username_column, 'm_customer_id', 'email');
				$userIdent = $user[$this->userident_column];
				$userIdentSalt = ':'.$userIdent.':'.$loginData['chalvalue'];
				$chkFieldHashes = array();
				foreach ($chkFields as $fieldName) {
					$userKey = $user[$fieldName];
					$chkFieldHashes[$fieldName] = (string)md5($userKey.$userIdentSalt);
					// Check if only field character case is different to request value;
					// If true, add a hash for the real request value
					if (strtolower($userKey) == strtolower($loginData['uname']) && $loginData['uname'] != $userKey) {
						$chkFieldHashes[$fieldName.'_req'] = (string)md5($loginData['uname'].$userIdentSalt);
					}
				}
				$loginPasswordMD5 = (string)$loginData['uident'];

				foreach ($chkFieldHashes as $hash) {
					if ($hash === $loginPasswordMD5) {
						$OK = TRUE;
						break;
					}
				}
				/* CATENO MOD END
				break;
			default:	// normal
				if ((string)$loginData['uident'] === (string)$user[$this->userident_column])	{
					$OK = TRUE;
				}
				break;
		}

		return $OK;
	}

	*/
/*
	protected function otherCode(){
		/* http://stackoverflow.com/questions/7695830/setting-a-fe-users-session-from-extbase */
		/** @var $fe_user tslib_feUserAuth */
/*		$fe_user = $GLOBALS['TSFE']->fe_user;
		$fe_user->createUserSession(array('uid' => $uid));
		$fe_user->user = $fe_user->getRawUserByUid($uid);
		$fe_user->fetchGroupData();
		$GLOBALS['TSFE']->loginUser = 1;


		// Instead of passing the actual user data to createUserSession, we
// pass an empty array to improve performance (e.g. no session record
// will be written to the database).
		$GLOBALS['TSFE']->fe_user->createUserSession(array());
		$GLOBALS['TSFE']->fe_user->user = $GLOBALS['TSFE']->fe_user->getRawUserByUid($userId);
		$GLOBALS['TSFE']->fe_user->fetchGroupData();
		$GLOBALS['TSFE']->loginUser = 1;
	}
*/
    public function authenticateAction(){
        $requestParams = $this->request->getArguments();
        return "Hallo";
        if(count($requestParams) == 0){


            $this->view->assign('params', 'No login possible');
        }else{
            $result = $this->doAuthentication(array('user' => $requestParams['user'], 'pass' => $requestParams['pass']));
            $requestParams['result'] = $result;
            $this->view->assign('params', $requestParams);
        }
    }

    protected function doAuthentication($loginData){
        $loginData = array(
            'uname' => $loginData['user'],
            'uident' => $loginData['pass'],
            'status' => 'login'
        );


        $GLOBALS['TSFE']->fe_user->checkPid = 0;
        $info = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
        $user = $GLOBALS['TSFE']->fe_user->fetchUserRecord( $info['db_user'], $loginData['uname'] );
        if ( $GLOBALS['TSFE']->fe_user->compareUident($user,$loginData) ){
            $GLOBALS["TSFE"]->fe_user->user = $GLOBALS["TSFE"]->fe_user->fetchUserSession();
            $GLOBALS['TSFE']->loginUser = 1;
            $GLOBALS['TSFE']->fe_user->fetchGroupData();
            $GLOBALS['TSFE']->fe_user->start();
            $GLOBALS["TSFE"]->fe_user->createUserSession($user);
            $GLOBALS["TSFE"]->fe_user->loginSessionStarted = TRUE;
            return 'successful';
        }else{
            return 'No success';
        }

    }
}