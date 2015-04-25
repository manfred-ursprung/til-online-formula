<?php
/*
 * Register necessary class names with autoloader
 */
$extensionClassPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('catenologin') .'Classes/';
return array(
	'tx_catenologin_controller_login' => $extensionClassPath . 'Controller/LoginController.php',
	//'tx_catenotemplates_viewHelpers_catenopagebrowsingviewhelper' => $extensionClassPath . 'ViewHelpers/CatenoPageBrowsingViewHelper.php',
	//'tx_vhs_viewhelpers_assetviewhelper' => $extensionClassesPath . 'ViewHelpers/AssetViewHelper.php',
);
?>