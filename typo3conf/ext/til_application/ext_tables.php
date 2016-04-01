<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'MUM.' . $_EXTKEY,
	'Form',
	'Online Bewerbungsformular'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'MUM.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'export',	// Submodule key
		'',						// Position
		array(
			'Candidate' => 'show, new, create, edit, update',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_export.xlf',
		)
	);

}

$pluginSignature = str_replace('_','',$_EXTKEY) . '_form';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_form.xml');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'TIL Online Bewerbungsformular');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilapplication_domain_model_candidate', 'EXT:til_application/Resources/Private/Language/locallang_csh_tx_tilapplication_domain_model_candidate.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilapplication_domain_model_candidate');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilapplication_domain_model_address', 'EXT:til_application/Resources/Private/Language/locallang_csh_tx_tilapplication_domain_model_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilapplication_domain_model_address');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilapplication_domain_model_school', 'EXT:til_application/Resources/Private/Language/locallang_csh_tx_tilapplication_domain_model_school.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilapplication_domain_model_school');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilapplication_domain_model_relative', 'EXT:til_application/Resources/Private/Language/locallang_csh_tx_tilapplication_domain_model_relative.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilapplication_domain_model_relative');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilapplication_domain_model_costs', 'EXT:til_application/Resources/Private/Language/locallang_csh_tx_tilapplication_domain_model_costs.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilapplication_domain_model_costs');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilapplication_domain_model_income', 'EXT:til_application/Resources/Private/Language/locallang_csh_tx_tilapplication_domain_model_income.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilapplication_domain_model_income');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilapplication_domain_model_documents', 'EXT:til_application/Resources/Private/Language/locallang_csh_tx_tilapplication_domain_model_documents.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilapplication_domain_model_documents');


/***************
 * Wizard pi1

$GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses'][$pluginSignature . '_wizicon'] =
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Private/Php/class.' . $_EXTKEY . '_wizicon.php';
*/