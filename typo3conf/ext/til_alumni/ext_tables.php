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
