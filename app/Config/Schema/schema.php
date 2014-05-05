<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $T002 = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F001' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F002' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'F003' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'F004' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F005' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F006' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F007' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F008' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F009' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F010' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	public $TActivitieCritique = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FActivitie' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FActive' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TActivitieCustomInfo = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FActivitie' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TActivities = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'CheckState' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FIsActive' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FPublishDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FStartDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FEndDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FOffDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMaxPersonCount' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FAddress' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FContent' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FSendMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPric' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIcon' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FImageOwner' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FQuestionnaire' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsTJ' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FPricNumber' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '18,2'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TAnnouncement = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPost' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TChapter = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FGroupName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FClass' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FGroupState' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FCreatePerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FIsActive' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIcon' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FJoinPattern' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FZC' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FText' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FWebSit' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAdmin' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAdminPwd' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAdminEMail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FParent' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsAutoDate' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FDateString' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FKeyWord' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FKeyName' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FGJ' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FQY' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FisReg' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FPhone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAddress' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FDistCode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Ffddbr' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLinkMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLinkManPhone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLinkManMobile' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLinkManFax' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fywzgdw' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fdkcs' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fpzdw' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fbsjgrs' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FMemberCount' => array('type' => 'integer', 'null' => true, 'default' => null),
		'Fsjdzzmc' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fdzzclsj' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'Fdzzqc' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fdzzfzr' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fdzzlsgx' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fdzzlly' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Fdjzdyjpcdw' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Flhjlhfgdzz' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TChapterAdmin = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FChapterType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FChapter' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAllowDel' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FAllowAdd' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FAllowEdit' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FAllowExport' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'iFPerson_TChapterAdmin' => array('column' => 'FPerson', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TChapterFramework = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FGroup' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FBeginDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FEndDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TCustomField = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'IsActive' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FIsManageField' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FShow' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FAllowDel' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FIndex' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FieldDisName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTableName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FieldName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FEnumName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FEnumFieldAllowEdit' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FLen' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FLenDig' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FRemark' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FInWebSite' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FClassName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAllowEdit' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FEnumMuti' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FMustValue' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	public $TCustomFieldAdmin = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'CustomField' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TCustomTable = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsActive' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FAllowDel' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FTableName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTableDisName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FRemark' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'iFTableName_TCustomTable' => array('column' => 'FTableName', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TDbIni = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FValue' => array('type' => 'binary', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TEnumItem = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIndex' => array('type' => 'integer', 'null' => true, 'default' => null),
		'EnumName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'EnumType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TGroup = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FUsePop' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FGroupName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreatePerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIcon' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'CheckState' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FIsActive' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FJoinPattern' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FText' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FWebSit' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAdmin' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAdminPwd' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAdminEMail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FClass' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FTypeMain' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FParent' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsTrue' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FisOfficial' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FIsAuth' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FState' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCountry' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FDistCode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCity' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FZC' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FGroupState' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FKeyWord' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsAutoDate' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FDateString' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FKeyName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FModeStyle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FModeRowKey' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'iFParent_TGroup' => array('column' => 'FParent', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TGroupAdmin = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FGroup' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TGroupPendingPerson = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FGroup' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FInviter' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TGroupPerson = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FGroup' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FDir' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TImage = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIcon' => array('type' => 'binary', 'null' => true, 'default' => null),
		'FImageOwner' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FWidth' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FHigth' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FSizeStr' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TImageOwner = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FActiveitie' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCoverld' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FActivitie' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCoverId' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	public $TMessage = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FContent' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FontAndColor' => array('type' => 'binary', 'null' => true, 'default' => null),
		'FIsDel' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TMessageTo = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsRead' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FMessage' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMessageType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FIsDel' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TPerson = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemberId' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FullName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FBirthday' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FEMail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'CreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'CreateMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FSex' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCountry' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCity' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FHomeplace' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPoliticalStatus' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPaperType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIDNumber' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FResume' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMobileNumber' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FQQ' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPhone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAddress' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 250, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAddressCode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FRemark' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FNational' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMarriage' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCompanyName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 250, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCompanyPosition' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCompanyXZ' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCompanyIndustry' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F028' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F029' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F030' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F031' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F032' => array('type' => 'integer', 'null' => true, 'default' => null),
		'F033' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F034' => array('type' => 'integer', 'null' => true, 'default' => null),
		'F035' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsAuth' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'F036' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F037' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F038' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F039' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F040' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F041' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsLogin' => array('type' => 'integer', 'null' => true, 'default' => null),
		'F042' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10),
		'FPassWord' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsPwdChange' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F043' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F044' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F045' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F046' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F047' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F055' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F056' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'continent' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'F076' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAlumType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FAuthType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'iFMemberId_TPerson' => array('column' => 'FMemberId', 'unique' => 1),
			'Id_index' => array('column' => 'Id', 'unique' => 0),
			'Id' => array('column' => 'Id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	public $TPersonEditInfo = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FieldType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FTableName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FieldName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FValueOld' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FValueNew' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FEditTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FEditState' => array('type' => 'integer', 'null' => true, 'default' => null),
		'ProcMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TPersonFeed = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAction' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLink' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FImageUrl' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsNotShow' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TPersonFriend = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FriendId' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FClass' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FState' => array('type' => 'boolean', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TPersonIcon = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIcon' => array('type' => 'binary', 'null' => true, 'default' => null),
		'FSmallIcon' => array('type' => 'binary', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'iFPerson_TPersonIcon' => array('column' => 'FPerson', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TPersonLog = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TPost = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FContent' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FPublishDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FCreateMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FPostOwner' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FViewNum' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TQuestionnaire = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => false),
		'FCreateMan' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TQuestionnaireAnswer = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FQuestionnaire' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FQuestionnaireItem' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Ftext' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TQuestionnaireItem = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FOwner' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIndex' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FTitle' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Ftext' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TUpdateInfo = array(
		'Id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'FTableName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FFieldID' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'onlykey' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'iFTableName_TUpdateInfo' => array('column' => 'FTableName', 'unique' => 0),
			'iFFieldID_TUpdateInfo' => array('column' => 'FFieldID', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $TUser = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FisActive' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'PopGroup' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'isManage' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FIsAdmin' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1),
		'FLoginName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPassWord' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLastLoginTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'iFLoginName_TUser' => array('column' => 'FLoginName', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_active = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => false),
		'FType' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'FValue' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FKey' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsActive' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_authinfo = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FullName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIdNumber' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FEMail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FExtraInfo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'FMobileNumber' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_blogs = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_captcha = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'captcha_time' => array('type' => 'integer', 'null' => true, 'default' => null),
		'ip_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'word' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_classes = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FContent' => array('type' => 'text', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FSource' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_comments = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FMessage' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => false),
		'FOwner' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_doing = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FMessage' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsMood' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'FIsNotShow' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_donatefield = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FDonate' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_donateperson = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FOrderNumber' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FCompleteDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FMessage' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FullName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FEMail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => false),
		'FOwnerDonate' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPayType' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPayOrderNumber' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FSite' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FSiteName' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPayStatus' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FPhoneNumber' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPayMoney' => array('type' => 'float', 'null' => false),
		'FSchoolLinkMan' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_donates = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTitle' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FIcon' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FPrice' => array('type' => 'float', 'null' => true, 'default' => null),
		'FNumbers' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FState' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'FGoods' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_download = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FileName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FOldName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FileType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FileSize' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCate' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_feedback = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_fields = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FieldOwner' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAction' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5),
		'FIndex' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_filter = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => false),
		'FTableNmae' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTableId' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FKeywords' => array('type' => 'text', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FState' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_friendgroup = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FName' => array('type' => 'string', 'null' => false, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => false),
		'indexes' => array(
			'Id' => array('column' => 'Id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_friends = array(
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FUid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FOwnerFriendGroup' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FStatus' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'FNote' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_menu = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMenuName' => array('type' => 'string', 'null' => false, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIndex' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FMenuLevel' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FMenuParent' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FIsActive' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'FRoutes' => array('type' => 'string', 'null' => false, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FImage' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_messages = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreatePerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FMessage' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_multiclass = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTableName' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTableId' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => false),
		'FOwnerClass' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_optimize = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FOwner' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FOwnerVirtual' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCount' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'FLastWiteTable' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FChildCount' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_party = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FMemo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FStartDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_partyperson = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FParty' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_recommend = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FOwnerId' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => false, 'length' => 5),
		'FMessage' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FState' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('FPerson', 'Id'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_remind = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8', 'key' => 'primary'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5),
		'FMessage' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FState' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2),
		'FPersonOwner' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FOwnerId' => array('type' => 'string', 'null' => false, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_spacevisitors = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FUid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FVisitorId' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FDateTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_tuan = array(
		'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAuth' => array('type' => 'string', 'null' => false, 'length' => 5000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FCreateDate' => array('type' => 'datetime', 'null' => false),
		'FTuanIP' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FInvite' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FInviteValues' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('FPerson', 'Id'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_useractived = array(
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FBasicInfo' => array('type' => 'text', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FType' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4),
		'FCreateDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FEMail' => array('type' => 'string', 'null' => false, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FExtraInfo' => array('type' => 'text', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FState' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'FMailInfo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FReg' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'FIP' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FInvite' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 38, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FInviteExtra' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FTableInfo' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'FPerson', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $social_users = array(
		'FPerson' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLoginName' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FRegDate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FRegIP' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FLastLoginTime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'FLastLoginIP' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FIsLogin' => array('type' => 'integer', 'null' => true, 'default' => null),
		'FPassWord' => array('type' => 'integer', 'null' => false),
		'FRole' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5),
		'FQuestion' => array('type' => 'string', 'null' => true, 'default' => '0', 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FAnswer' => array('type' => 'string', 'null' => true, 'default' => '0', 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FSoapIsLogin' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'FSoapSessionId' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'FPerson', 'unique' => 1),
			'FLoginName' => array('column' => 'FLoginName', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
}
