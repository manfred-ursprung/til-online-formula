<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MUM.' . $_EXTKEY,
	'Form',
	array(
		'Candidate' => 'new, edit, show, list ',
		'OnlineFormula'	=> 'step0, step1, step2, step3',
	),
	// non-cacheable actions
	array(
		'Candidate' => 'create, update',
		'OnlineFormula'	=> 'step1, step2, step3',
	)
);
