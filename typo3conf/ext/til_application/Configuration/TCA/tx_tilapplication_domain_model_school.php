<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school',
		'label' => 'name',
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
		'searchFields' => 'name,type_of_school,school_year,actual,school_order,visit_from,visit_til,planned_graduation_select,planned_graduation_text,planned_graduation_finish,school_certificate_points,school_certificate_date,address,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('til_application') . 'Resources/Public/Icons/tx_tilapplication_domain_model_school.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, type_of_school, school_year, actual, school_order, visit_from, visit_til, planned_graduation_select, planned_graduation_text, planned_graduation_finish, school_certificate_points, school_certificate_date, address',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, type_of_school, school_year, actual, school_order, visit_from, visit_til, planned_graduation_select, planned_graduation_text, planned_graduation_finish, school_certificate_points, school_certificate_date, address, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_tilapplication_domain_model_school',
				'foreign_table_where' => 'AND tx_tilapplication_domain_model_school.pid=###CURRENT_PID### AND tx_tilapplication_domain_model_school.sys_language_uid IN (-1,0)',
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

		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'type_of_school' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.type_of_school',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'school_year' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.school_year',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'actual' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.actual',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'school_order' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.school_order',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'visit_from' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.visit_from',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'visit_til' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.visit_til',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'planned_graduation_select' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.planned_graduation_select',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
					array('Abitur', 'Abitur'),
					array('Fachhochschulreife', 'Fachhochschulreife'),
					array('Sonstiges', 'Sonstiges'),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'planned_graduation_text' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.planned_graduation_text',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'planned_graduation_finish' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.planned_graduation_finish',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'school_certificate_points' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.school_certificate_points',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			)
		),
		'school_certificate_date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.school_certificate_date',
			'config' => array(
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00'
			),
		),
		'address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_school.address',
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
		
		'candidate' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);