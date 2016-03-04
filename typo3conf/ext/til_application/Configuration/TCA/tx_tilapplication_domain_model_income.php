<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income',
		'label' => 'gross_salary',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'gross_salary,net_salary,self_employed_salary,welfare,unemployment_benefit,housing_benefit,pension,other_incomes,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('til_application') . 'Resources/Public/Icons/tx_tilapplication_domain_model_income.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, gross_salary, net_salary, self_employed_salary, welfare, unemployment_benefit, housing_benefit, pension, other_incomes',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, gross_salary, net_salary, self_employed_salary, welfare, unemployment_benefit, housing_benefit, pension, other_incomes, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_tilapplication_domain_model_income',
				'foreign_table_where' => 'AND tx_tilapplication_domain_model_income.pid=###CURRENT_PID### AND tx_tilapplication_domain_model_income.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'gross_salary' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.gross_salary',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'net_salary' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.net_salary',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'self_employed_salary' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.self_employed_salary',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'welfare' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.welfare',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'unemployment_benefit' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.unemployment_benefit',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'housing_benefit' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.housing_benefit',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'pension' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.pension',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'other_incomes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_income.other_incomes',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		
	),
);