<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling',
		'label' => 'qualification1',
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
		'searchFields' => 'qualification1,qualification2,opportunities_after_study,university_informations,local_informations,prior_university_experiences,activities,scholarships,semester_abroad,study_slogan,tip1,tip2,tip3,tip4,tip5,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('til_alumni') . 'Resources/Public/Icons/tx_tilalumni_domain_model_studentcounseilling.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, qualification1, qualification2, opportunities_after_study, university_informations, local_informations, prior_university_experiences, activities, scholarships, semester_abroad, study_slogan, tip1, tip2, tip3, tip4, tip5',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, qualification1, qualification2, opportunities_after_study, university_informations, local_informations, prior_university_experiences, activities, scholarships, semester_abroad, study_slogan, tip1, tip2, tip3, tip4, tip5, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_tilalumni_domain_model_studentcounseilling',
				'foreign_table_where' => 'AND tx_tilalumni_domain_model_studentcounseilling.pid=###CURRENT_PID### AND tx_tilalumni_domain_model_studentcounseilling.sys_language_uid IN (-1,0)',
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

		'qualification1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.qualification1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'qualification2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.qualification2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'opportunities_after_study' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.opportunities_after_study',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'university_informations' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.university_informations',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'local_informations' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.local_informations',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'prior_university_experiences' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.prior_university_experiences',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'activities' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.activities',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'scholarships' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.scholarships',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'semester_abroad' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.semester_abroad',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'study_slogan' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.study_slogan',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'tip1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.tip1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'tip2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.tip2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'tip3' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.tip3',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'tip4' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.tip4',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'tip5' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_alumni/Resources/Private/Language/locallang_db.xlf:tx_tilalumni_domain_model_studentcounseilling.tip5',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
	),
);