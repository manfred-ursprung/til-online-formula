<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MUM.' . $_EXTKEY,
	'Alumni',
	array(
		'Alumni' => 'list, search ',
	),
	// non-cacheable actions
	array(
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MUM.' . $_EXTKEY,
	'StudentCounseilling',
	array(
		'Counseilling' => 'list, search',

	),
	// non-cacheable actions
	array(

	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'MUM.' . $_EXTKEY,
    'Network',
    array(
        'Network' => 'list, search',

    ),
    // non-cacheable actions
    array(

    )
);