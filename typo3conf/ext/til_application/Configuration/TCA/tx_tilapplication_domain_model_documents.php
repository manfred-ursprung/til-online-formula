<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents',
		'label' => 'living_costs',
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
		'searchFields' => 'life_school_career, curriculum_vitae, survey, certificate1,certificate2, certificate3, passport_photo, identity_card, residence_permit,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('til_application') . 'Resources/Public/Icons/tx_tilapplication_domain_model_documents.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, life_school_career, curriculum_vitae, survey, certificate1,certificate2, certificate3, passport_photo, identity_card, residence_permit, ',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, life_school_career, curriculum_vitae, survey, certificate1,certificate2, certificate3, passport_photo, identity_card, residence_permit,  --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_tilapplication_domain_model_documents',
				'foreign_table_where' => 'AND tx_tilapplication_domain_model_documents.pid=###CURRENT_PID### AND tx_tilapplication_domain_model_documents.sys_language_uid IN (-1,0)',
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

		'life_school_career' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.life_school_career',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'curriculum_vitae' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.curriculum_vitae',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'survey' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.survey',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'certificate1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.certificate1',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'certificate2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.certificate2',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'certificate3' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.certificate3',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'passport_photo' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.passport_photo',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'identity_card' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.identity_card',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'residence_permit' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_documents.residence_permit',
			'config' => array(
				'type' => 'group',
				'internal_type'	=> 'file',
				'uploadfolder'	=> 'fileadmin/tx_tilapplication',
				'show_thumbs'	=> 1,
				'size' 			=> 1,
				'allowed'		=> $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' 	=> ''
			),
		),
		'candidate' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);