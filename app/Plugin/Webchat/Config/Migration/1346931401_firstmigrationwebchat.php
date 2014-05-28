<?php

class FirstMigrationWebchat extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'webchat' => array(
					'Id' => array('type' => 'string', 'length' => 38, 'null' => false, 'key' => 'primary'),
					'FPerson' => array('type' => 'string', 'length' => 38, 'null' => false),
					'FWxopenId' => array('type' => 'string', 'length' => 200),
					'FWxId' => array('type' => 'string', 'length' => 200),
					'FName' => array('type' => 'string', 'length' => 200),
					'FCreatedate' => array('type' => 'datetime'),
					'FOffdate' => array('type' => 'datetime'),
					'FIcon' => array('type' => 'string', 'length' => 500),
					'FStatus' => array('type' => 'boolean', 'length' => 1),
					'FIsActive' => array('type' => 'boolean', 'length' => 1),
					'FWxType' => array('type' => 'string', 'length' => 200),
					'FWxApi' => array('type' => 'string', 'length' => 200),
					'FWxToken' => array('type' => 'string', 'length' => 200),
					'FWxAppId' => array('type' => 'string', 'length' => 200),
					'FWxAppSecret' => array('type' => 'string', 'length' => 200),
					'FAddress' => array('type' => 'string', 'length' => 200),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
				'wcsess' => array(
					'Id' => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
					'FData' => array('type' => 'text', 'null' => false),
					'FExpires' => array('type' => 'integer', 'length' => 11),
					'FWebchat' => array('type' => 'string', 'length' => 38),
					'FCreatedate' => array('type' => 'datetime'),
					'FUpdatedate' => array('type' => 'datetime'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
				'wcdata' => array(
					'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary'),
					'FWebchat' => array('type' => 'string', 'length' => 38, 'null' => false),
					'FDefaultType' => array('type' => 'boolean', 'length' => 1),
					'FDefaultContent' => array('type' => 'text'),
					'FDefaultId' => array('type' => 'string', 'length' => 38),
					'FFollowType' => array('type' => 'boolean', 'length' => 1),
					'FFollowContent' => array('type' => 'text'),
					'FFollowId' => array('type' => 'string', 'length' => 38),
					'FCreatedate' => array('type' => 'datetime'),
					'FUpdatedate' => array('type' => 'datetime'),
					'FSignText' => array('type' => 'string', 'length' => 500),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
				'wcdata_kds' => array(
					'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary'),
					'FWebchat' => array('type' => 'string', 'length' => 38, 'null' => false),
					'FKey' => array('type' => 'string', 'length' => 200, 'null' => false),
					'FType' => array('type' => 'integer', 'boolean' => 1),
					'FTwj' => array('type' => 'text'),
					'FWbContent' => array('type' => 'text'),
					'FCreatedate' => array('type' => 'datetime'),
					'FUpdatedate' => array('type' => 'datetime'),
					'FKeyMacth' => array('type' => 'boolean', 'length' => 1),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
				'wcdata_tw' => array(
					'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary'),
					'FWebchat' => array('type' => 'string', 'length' => 38, 'null' => false),
					'FTitle' => array('type' => 'string', 'length' => 200, 'null' => false),
					'FUrl' => array('type' => 'string', 'length' => 1000),
					'FUpyunUrl' => array('type' => 'string', 'length' => 1000),
					'FMemo' => array('type' => 'string', 'length' => 500),
					'FCreatedate' => array('type' => 'datetime'),
					'FUpdatedate' => array('type' => 'datetime'),
					'FType' => array('type' => 'boolean', 'length' => 1),
					'FAuthor' => array('type' => 'string', 'length' => 100),
					'FContent' => array('type' => 'text'),
					'FLink' => array('type' => 'string', 'length' => 1000),
					'FTwj' => array('type' => 'text'),
					'FTwType' => array('type' => 'string', 'length' => 100),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
				'wcdata_tw_events' => array(
					'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary'),
					'FOwnerId' => array('type' => 'string', 'length' => 38, 'null' => false),
					'FMaxPersonCount' => array('type' => 'integer', 'length' => 11),
					'FPersonCount' => array('type' => 'integer', 'length' => 11),
					'FAddress' => array('type' => 'string', 'length' => 500),
					'FMemo' => array('type' => 'text'),
					'FStartdate' => array('type' => 'datetime'),
					'FCreatedate' => array('type' => 'datetime'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
				'wcdata_mus' => array(
					'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary'),
					'FWebchat' => array('type' => 'string', 'length' => 38, 'null' => false),
					'FOwnerMenu' => array('type' => 'string', 'length' => 200),
					'FName' => array('type' => 'string', 'length' => 200),
					'FOrder' => array('type' => 'integer', 'length' => 11),
					'FKeysOrLink' => array('type' => 'string', 'length' => 200),
					'FIsActive' => array('type' => 'boolean', 'length' => 1),
					'FCreatedate' => array('type' => 'datetime'),
					'FUpdatedate' => array('type' => 'datetime'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
				'tperson' => array(
					'Id' => array('type' => 'string', 'null' => false, 'length' => 38, 'key' => 'primary'),
					'FMemberId' => array('type' => 'string', 'length' => 38, 'null' => false, 'unique' => 1),
					'FPassWord' => array('type' => 'string', 'length' => 200, 'null' => false),
					'FullName' => array('type' => 'string', 'length' => 200),
					'FEName' => array('type' => 'string', 'length' => 200),
					'FSex' => array('type' => 'integer', 'length' => 50),
					'FBirthday' => array('type' => 'datetime'),
					'FEMail' => array('type' => 'string', 'length' => 500),
					'FMobileNumber' => array('type' => 'string', 'length' => 100),
					'FPhone' => array('type' => 'string', 'length' => 500),
					'FAddress' => array('type' => 'string', 'length' => 500),
					'FCity' => array('type' => 'string', 'length' => 200),
					'FCreatedate' => array('type' => 'datetime'),
					'FUpdatedate' => array('type' => 'datetime'),
					'FIsActive' => array('type' => 'boolean', 'length' => 1),
					'FIsAuth' => array('type' => 'boolean', 'length' => 1),
					'FIsAdmin' => array('type' => 'boolean', 'length' => 1, 'null' => false, 'default' => '0'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'Id', 'unique' => 1),
						'FMemberId' => array('column' => 'FMemberId', 'unique' => 1)
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'webchat', 'wcsess', 'wcdata', 'wcdata_kds', 'wcdata_tw', 'wcdata_mus', 'tperson'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		if ($direction === 'down') {
			return false;
		}
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}

}
