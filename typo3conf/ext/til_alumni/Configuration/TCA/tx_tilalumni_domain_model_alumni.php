<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni',
		'label' => 'firstname',
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
		'searchFields' => 'firstname,lastname,gender,birthday,city_of_birth,country_of_birth,hobbys,life_motto,strreet,zip,city,email,mobile,language_skills,scholarship_period,type_of_school,university_course,university,graduation,profession,student_counseilling,network,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('til_alumni') . 'Resources/Public/Icons/tx_tilalumni_domain_model_alumni.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, firstname, lastname, gender, birthday, city_of_birth, country_of_birth, hobbys, life_motto, strreet, zip, city, email, mobile, language_skills, scholarship_period, type_of_school, university_course, university, graduation, profession, student_counseilling, network',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, firstname, lastname, gender, birthday, city_of_birth, country_of_birth, hobbys, life_motto, strreet, zip, city, email, mobile, language_skills, scholarship_period, type_of_school, university_course, university, graduation, profession, student_counseilling, network, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_tilalumni_domain_model_alumni',
				'foreign_table_where' => 'AND tx_tilalumni_domain_model_alumni.pid=###CURRENT_PID### AND tx_tilalumni_domain_model_alumni.sys_language_uid IN (-1,0)',
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

		'firstname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.firstname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'lastname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.lastname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'gender' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.gender',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'birthday' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.birthday',
			'config' => array(
				'type' => 'input',
				'size' => 6,
				'eval' => 'timesec',
				'checkbox' => 1,
				'default' => time()
			)
		),
		'city_of_birth' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.city_of_birth',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'country_of_birth' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.country_of_birth',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'hobbys' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.hobbys',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'life_motto' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.life_motto',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'strreet' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.strreet',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mobile' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.mobile',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'language_skills' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.language_skills',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'scholarship_period' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.scholarship_period',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'type_of_school' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.type_of_school',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'university_course' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.university_course',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'university' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.university',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'graduation' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.graduation',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'profession' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.profession',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'student_counseilling' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.student_counseilling',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_tilalumni_domain_model_studentcounseilling',
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
		'network' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_alumni.network',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_tilalumni_domain_model_network',
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