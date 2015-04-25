<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Isb.' . $_EXTKEY,
	'Pi1',
	array(
		'Login' => 'index, login, authenticate',
		
	),
	// non-cacheable actions
	array(
		
	)
);

$TYPO3_CONF_VARS['FE']['eID_include']['catenologin'] = 'EXT:' . $_EXTKEY .'/AjaxDispatcher.php';

// XCLASS von   TYPO3\CMS\Felogin\Controller/FrontendLoginController
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Felogin\\Controller\\FrontendLoginController'] = array(
	'className' => 'Isb\\Catenologin\\Xclass\\FrontendLoginController',
);
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['tx_felogin_pi1'] = array(
	'className' => 'Isb\\Catenologin\\Xclass\\FrontendLoginController',
);


//Auth Service für Masterpasswort
/*
 *
 \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
	$_EXTKEY,  'auth' /* sv type /,  'tx_catenologin_sv1' /* sv key *//*,
	array(

		'title' => 'Catenologin Auth',
		'description' => 'Authentifizierung',

		'subtype' => 'getUserFE,authUserFE,getGroupsFE',

		'available' => TRUE,
		'priority' => 90,
		'quality' => 90,

		'os' => '',
		'exec' => '',

		'classFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'sv1/class.tx_mbauth_sv1.php',
		'className' => 'tx_mbauth_sv1',
	)
);
*/
?>