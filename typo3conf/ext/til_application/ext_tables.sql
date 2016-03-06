#
# Table structure for table 'tx_tilapplication_domain_model_candidate'
#
CREATE TABLE tx_tilapplication_domain_model_candidate (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

  gender varchar(20) DEFAULT '' NOT NULL,
	family_status varchar(20) DEFAULT '' NOT NULL,
	married_since varchar(255) DEFAULT '' NOT NULL,
	birthdate int(11) unsigned DEFAULT '0' NOT NULL,
	country_of_birth varchar(255) DEFAULT '' NOT NULL,
	migration_background tinyint(1) unsigned DEFAULT '0' NOT NULL,
	nationality varchar(255) DEFAULT '' NOT NULL,
	resident_since varchar(255) DEFAULT '' NOT NULL,
	residence_status int(11) DEFAULT '0' NOT NULL,
	residence_misc varchar(255) DEFAULT '' NOT NULL,
	family_addon varchar(255) DEFAULT '' NOT NULL,
	asset_real_estate varchar(255) DEFAULT '' NOT NULL,
	asset_savings varchar(255) DEFAULT '' NOT NULL,
	asset_misc_estate varchar(255) DEFAULT '' NOT NULL,
	integrity tinyint(1) unsigned DEFAULT '0' NOT NULL,
	fe_user int(11) unsigned DEFAULT '0',
	address int(11) unsigned DEFAULT '0',
	school_career int(11) unsigned DEFAULT '0' NOT NULL,
	family int(11) unsigned DEFAULT '0' NOT NULL,
	costs int(11) unsigned DEFAULT '0',
	income int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_tilapplication_domain_model_address'
#
CREATE TABLE tx_tilapplication_domain_model_address (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	street varchar(255) DEFAULT '' NOT NULL,
	housenumber varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	mobile varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	at_parent tinyint(1) unsigned DEFAULT '0' NOT NULL,
	own_room tinyint(1) unsigned DEFAULT '0' NOT NULL,
	sibling_room tinyint(1) unsigned DEFAULT '0' NOT NULL,
	sibling_room_number int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_tilapplication_domain_model_school'
#
CREATE TABLE tx_tilapplication_domain_model_school (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	candidate int(11) unsigned DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	type_of_school varchar(255) DEFAULT '' NOT NULL,
	school_year varchar(255) DEFAULT '' NOT NULL,
	actual tinyint(1) unsigned DEFAULT '0' NOT NULL,
	school_order int(11) DEFAULT '0' NOT NULL,
	visit_from varchar(255) DEFAULT '' NOT NULL,
	visit_til varchar(255) DEFAULT '' NOT NULL,
	planned_graduation_select int(11) DEFAULT '0' NOT NULL,
	planned_graduation_text varchar(255) DEFAULT '' NOT NULL,
	planned_graduation_finish varchar(255) DEFAULT '' NOT NULL,
	school_certificate_points double(11,2) DEFAULT '0.00' NOT NULL,
	school_certificate_date date DEFAULT '0000-00-00',
	address int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_tilapplication_domain_model_relative'
#
CREATE TABLE tx_tilapplication_domain_model_relative (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	candidate int(11) unsigned DEFAULT '0' NOT NULL,

	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	birthdate date DEFAULT '0000-00-00',
	nationality varchar(255) DEFAULT '' NOT NULL,
	educational_qualification varchar(255) DEFAULT '' NOT NULL,
	job varchar(255) DEFAULT '' NOT NULL,
	family_relation int(11) DEFAULT '0' NOT NULL,
	income int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_tilapplication_domain_model_costs'
#
CREATE TABLE tx_tilapplication_domain_model_costs (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	living_costs int(11) DEFAULT '0' NOT NULL,
	credit_costs int(11) DEFAULT '0' NOT NULL,
	other_outgoings int(11) DEFAULT '0' NOT NULL,
	travel_costs int(11) DEFAULT '0' NOT NULL,
	further_education_costs int(11) DEFAULT '0' NOT NULL,
	private_coaching_costs int(11) DEFAULT '0' NOT NULL,
	rental int(11) DEFAULT '0' NOT NULL,
	living_costs_single int(11) DEFAULT '0' NOT NULL,
	other_costs int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_tilapplication_domain_model_income'
#
CREATE TABLE tx_tilapplication_domain_model_income (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	gross_salary int(11) DEFAULT '0' NOT NULL,
	net_salary int(11) DEFAULT '0' NOT NULL,
	self_employed_salary int(11) DEFAULT '0' NOT NULL,
	welfare int(11) DEFAULT '0' NOT NULL,
	unemployment_benefit int(11) DEFAULT '0' NOT NULL,
	housing_benefit int(11) DEFAULT '0' NOT NULL,
	pension int(11) DEFAULT '0' NOT NULL,
	other_incomes int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_tilapplication_domain_model_school'
#
CREATE TABLE tx_tilapplication_domain_model_school (

	candidate  int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_tilapplication_domain_model_relative'
#
CREATE TABLE tx_tilapplication_domain_model_relative (

	candidate  int(11) unsigned DEFAULT '0' NOT NULL,

);
