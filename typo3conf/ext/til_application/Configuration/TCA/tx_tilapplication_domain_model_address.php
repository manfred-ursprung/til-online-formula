<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address',
		'label' => 'street',
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
		'searchFields' => 'street,housenumber,city,zip,phone,mobile,email,at_parent,own_room,sibling_room,sibling_room_number,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('til_application') . 'Resources/Public/Icons/tx_tilapplication_domain_model_address.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, street, housenumber, city, zip, phone, mobile, email, at_parent, own_room, sibling_room, sibling_room_number',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, street, housenumber, city, zip, phone, mobile, email, at_parent, own_room, sibling_room, sibling_room_number, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_tilapplication_domain_model_address',
				'foreign_table_where' => 'AND tx_tilapplication_domain_model_address.pid=###CURRENT_PID### AND tx_tilapplication_domain_model_address.sys_language_uid IN (-1,0)',
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

		'street' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.street',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'housenumber' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.housenumber',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'phone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mobile' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.mobile',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'at_parent' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.at_parent',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'own_room' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.own_room',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'sibling_room' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.sibling_room',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'sibling_room_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:til_application/Resources/Private/Language/locallang_db.xlf:tx_tilapplication_domain_model_address.sibling_room_number',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			)
		),
	),
);