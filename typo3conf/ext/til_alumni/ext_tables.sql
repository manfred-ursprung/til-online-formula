#
# Table structure for table 'tx_tilalumni_domain_model_alumni'
#
CREATE TABLE tx_tilalumni_domain_model_alumni (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	firstname varchar(255) DEFAULT '' NOT NULL,
	lastname varchar(255) DEFAULT '' NOT NULL,
	gender int(11) DEFAULT '0' NOT NULL,
	birthday int(11) DEFAULT '0' NOT NULL,
	city_of_birth varchar(255) DEFAULT '' NOT NULL,
	country_of_birth varchar(255) DEFAULT '' NOT NULL,
	hobbys varchar(255) DEFAULT '' NOT NULL,
	life_motto varchar(255) DEFAULT '' NOT NULL,
	strreet varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	mobile varchar(255) DEFAULT '' NOT NULL,
	language_skills varchar(255) DEFAULT '' NOT NULL,
	scholarship_period varchar(255) DEFAULT '' NOT NULL,
	type_of_school varchar(255) DEFAULT '' NOT NULL,
	university_course varchar(255) DEFAULT '' NOT NULL,
	university varchar(255) DEFAULT '' NOT NULL,
	graduation varchar(255) DEFAULT '' NOT NULL,
	profession varchar(255) DEFAULT '' NOT NULL,
	student_counseilling int(11) unsigned DEFAULT '0',
	network int(11) unsigned DEFAULT '0',

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
# Table structure for table 'tx_tilalumni_domain_model_studentcounseilling'
#
CREATE TABLE tx_tilalumni_domain_model_studentcounseilling (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	qualification1 varchar(255) DEFAULT '' NOT NULL,
	qualification2 varchar(255) DEFAULT '' NOT NULL,
	opportunities_after_study varchar(255) DEFAULT '' NOT NULL,
	university_informations varchar(255) DEFAULT '' NOT NULL,
	local_informations varchar(255) DEFAULT '' NOT NULL,
	prior_university_experiences varchar(255) DEFAULT '' NOT NULL,
	activities varchar(255) DEFAULT '' NOT NULL,
	scholarships varchar(255) DEFAULT '' NOT NULL,
	semester_abroad varchar(255) DEFAULT '' NOT NULL,
	study_slogan varchar(255) DEFAULT '' NOT NULL,
	tip1 varchar(255) DEFAULT '' NOT NULL,
	tip2 varchar(255) DEFAULT '' NOT NULL,
	tip3 varchar(255) DEFAULT '' NOT NULL,
	tip4 varchar(255) DEFAULT '' NOT NULL,
	tip5 varchar(255) DEFAULT '' NOT NULL,

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
# Table structure for table 'tx_tilalumni_domain_model_network'
#
CREATE TABLE tx_tilalumni_domain_model_network (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	language_skills varchar(255) DEFAULT '' NOT NULL,
	school_career varchar(255) DEFAULT '' NOT NULL,
	personel_experiences varchar(255) DEFAULT '' NOT NULL,
	advice_topics varchar(255) DEFAULT '' NOT NULL,

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
