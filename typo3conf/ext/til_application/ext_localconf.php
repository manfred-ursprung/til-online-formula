<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MUM.' . $_EXTKEY,
	'Form',
	array(
		'Candidate' => 'new, edit, show, list ',
		'OnlineFormula'	=> 'step0, step1, step2, step3,step4,step5,step6,create,generatePdf, approval, updateStep1,updateStep2,updateStep3, updateStep4, updateStep5',
	),
	// non-cacheable actions
	array(
		'Candidate' => 'create, update',
		'OnlineFormula'	=> 'step1, step2, step3, step4, step5, step6, create,generatePdf, approval, updateStep1,updateStep2,updateStep3, updateStep4, updateStep5',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MUM.' . $_EXTKEY,
	'Evaluation',
	array(
		'Candidate' => 'excel, download, show, list,new, edit ',

	),
	// non-cacheable actions
	array(
		'Candidate' => 'create, update',

	)
);
