<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Alumni-Buch');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilalumni_domain_model_alumni', 'EXT:til_alumni/Resources/Private/Language/locallang_csh_tx_tilalumni_domain_model_alumni.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilalumni_domain_model_alumni');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilalumni_domain_model_studentcounseilling', 'EXT:til_alumni/Resources/Private/Language/locallang_csh_tx_tilalumni_domain_model_studentcounseilling.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilalumni_domain_model_studentcounseilling');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tilalumni_domain_model_network', 'EXT:til_alumni/Resources/Private/Language/locallang_csh_tx_tilalumni_domain_model_network.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tilalumni_domain_model_network');
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MUM.' . $_EXTKEY,
    'Alumni',
    'Alumnibuch'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MUM.' . $_EXTKEY,
    'Counseilling',
    'Studienberatung'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MUM.' . $_EXTKEY,
    'Network',
    'Wir für Bayern'
);

// Flexform for alumni plugin
$pluginSignature = str_replace('_','',$_EXTKEY) . '_alumni';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_alumni.xml');

// Flexform for counseilling plugin
$pluginSignature = str_replace('_','',$_EXTKEY) . '_counseilling';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_counseilling.xml');

// Flexform for network plugin
$pluginSignature = str_replace('_','',$_EXTKEY) . '_network';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_network.xml');

if (TYPO3_MODE == 'BE'){
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'MUM.' . $_EXTKEY,
        //'MUM.' . 'TilAlumni',
        'web',
        'Importer',
        '',
        array(
            'Importer' => 'import,list',
        ),
        array(
            'access'    => 'admin',
            'icon'      => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
            'labels'   => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xlf'
        )
    );
}