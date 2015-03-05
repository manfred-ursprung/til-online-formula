<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Templates für TIL Bayern');
\FluidTYPO3\Flux\Core::registerProviderExtensionKey('sitetemplates', 'Page');
\FluidTYPO3\Flux\Core::registerProviderExtensionKey('sitetemplates', 'Content');

