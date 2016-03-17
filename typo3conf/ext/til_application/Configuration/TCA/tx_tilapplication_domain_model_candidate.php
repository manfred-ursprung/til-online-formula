<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate',
		'label' => 'fe_user',
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
		'searchFields' => 'gender,family_status,married_since, birthdate,country_of_birth,migration_background,nationality,resident_since,residence_status,residence_misc,family_addon,asset_real_estate,asset_savings,asset_misc_estate,integrity,fe_user,address,school_career,family,costs,income,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('til_application') . 'Resources/Public/Icons/tx_tilapplication_domain_model_candidate.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, gender, family_status, married_since, birthdate, country_of_birth, migration_background, nationality, resident_since, residence_status, residence_misc, family_addon, asset_real_estate, asset_savings, asset_misc_estate, integrity, fe_user, address, school_career, family, costs, income',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, gender, family_status, married_since, birthdate, country_of_birth, migration_background, nationality, resident_since, residence_status, residence_misc, family_addon, asset_real_estate, asset_savings, asset_misc_estate, integrity, fe_user, address, school_career, family, costs, income, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_tilapplication_domain_model_candidate',
				'foreign_table_where' => 'AND tx_tilapplication_domain_model_candidate.pid=###CURRENT_PID### AND tx_tilapplication_domain_model_candidate.sys_language_uid IN (-1,0)',
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

		'gender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.gender',
			'config' => array(
				'type' => 'check',
				'default' => 0,
				'items' => array(
					array('LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.gender.male', 'male'),
					array('LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.gender.female', 'female')
				),
			),
		),
		'family_status' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.family_status',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
					array('LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.family_status.single', 'single'),
					array('LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.family_status.married', 'married')
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'married_since' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.married_since',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'birthdate' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.birtdate',
			'config' => array(
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00'
			),
		),
		'country_of_birth' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.country_of_birth',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'migration_background' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.migration_background',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'nationality' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.nationality',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'resident_since' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.resident_since',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'residence_status' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.residence_status',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
					array('LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.residence_status.niederlassung', '1'),
					array('LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.residence_status.aufenthalt', '2'),
					array('LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.residence_status.sonstiges', '3'),

				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'residence_misc' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.residence_misc',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'family_addon' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.family_addon',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'asset_real_estate' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.asset_real_estate',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'asset_savings' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.asset_savings',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'asset_misc_estate' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.asset_misc_estate',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'integrity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.integrity',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'fe_user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.fe_user',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => '',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.address',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_tilapplication_domain_model_address',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'school_career' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.school_career',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_tilapplication_domain_model_school',
				'foreign_field' => 'candidate',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'family' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.family',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_tilapplication_domain_model_relative',
				'foreign_field' => 'candidate',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'costs' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.costs',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_tilapplication_domain_model_costs',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'income' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_candidate.income',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_tilapplication_domain_model_income',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		
	),
);