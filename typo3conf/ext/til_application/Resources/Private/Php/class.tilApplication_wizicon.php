<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Add tilApplication extension to the wizard in page module
 *
 * @package TYPO3
 * @subpackage tx_tilapplication
 */
class til_application_form_wizicon {

	const KEY = 'tilapplication';

	/**
	 * Processing the wizard items array
	 *
	 * @param array $wizardItems The wizard items
	 * @return array array with wizard items
	 */
	public function proc($wizardItems) {
		$wizardItems['plugins_tx_' . self::KEY] = array(
			'icon'			=> \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath(self::KEY) . 'Resources/Public/Icons/ce_wiz.gif',
			'title'			=> 'Online Bewerbungsformular',  //$GLOBALS['LANG']->sL('LLL:EXT:news/Resources/Private/Language/locallang_be.xlf:pi1_title'),
			'description'	=> 'ein Formular über 3 Steps',  //$GLOBALS['LANG']->sL('LLL:EXT:news/Resources/Private/Language/locallang_be.xlf:pi1_plus_wiz_description'),
			'params'		=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=' . self::KEY . '_form'
		);

		return $wizardItems;
	}
}