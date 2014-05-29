<?php
App::uses('AppModel', 'Model');
/**
 * TPerson Model
 *
 */
class TPerson extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'tperson';

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public $newds = array();

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'Id';
	
	/*public $validate = array(
	    'FullName' => array(
			'rule' => "alphanumeric",
			'message' => "查询内容不能为空！",
			'required' => true
	    ),
		'FPassWord' => array(
			'rule' => "alphanumeric",
			'message' => "密码不能为空！",
			'required' => true
	    )
	);*/
	// public $validate = array('FullName' => 'email');
	/**
	 * undocumented variable
	 *
	 * @var string
	 */
	public $validate = array(
		'FMemberId' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			)
	    ),
		'FPassWord' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			),
			'minLength' => array(
				'rule' => array('minLength', '6'),
				'message' => "不能少于6位"
			)
	    ),
		'FRePassWord' => array(
			'rule' => 'validIdentical',
	    ),
		'FullName' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FMobileNumber' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FEMail' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			),
			'email' => array(
				'rule' => array('email', true),
				'message' => "电子邮件格式不正确",
			)
	    ),
		'FCity' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
	/**
	 * 取学院的人员数据
	 *
	 * @return void
	 * @author apple
	 **/
	function getCollegePersonResult($college, $isCount = 0, $limit = null, $offset = null, $sort = null, $desc = null, $conditions = null)
	{
		$limit = $limit ? array('limit' => $limit) : array();
		$offset = $offset ? array('offset' => $offset) : array();
		$find = $isCount ? 'count' : 'all';
		$order = $sort ? array('order' => array($sort => $desc)) : array();
		$attr = array(
			'conditions' => array(
				"T002.F004" => $college
			),
			'joins' => array(
				array(
					'table' => 'T002',
		            'alias' => 'T002',
		            'type' => 'INNER',
		            'conditions' => array(
		                'TPerson.Id = T002.FPerson'
		            )
				)
			),
			'fields' => array(
				"TPerson.*",
				"T002.F004 as Extra_college", 
				"T002.F002 as Extra_grade", 
				"T002.F005 as Extra_subject",
				"T002.F006 as Extra_class"
			),
			'group' => array('TPerson.Id'),
			'order' => array('CreateDate DESC')
		);
		$attr = array_merge($attr, $limit, $offset, $order);
		if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
		$result = $this->find($find, $attr);
		if ($isCount && empty($result)) return 0;
		return $result;
	}
	
	/**
	 * 取年级的人员数据
	 *
	 * @return void
	 * @author apple
	 **/
	function getGradePersonResult($college, $grade, $isCount = 0, $limit = null, $offset = null, $sort = null, $desc = null, $conditions = null)
	{
		$limit = $limit ? array('limit' => $limit) : array();
		$offset = $offset ? array('offset' => $offset) : array();
		$find = $isCount ? 'count' : 'all';
		$order = $sort ? array('order' => array($sort => $desc)) : array();
		$attr = array(
			'conditions' => array(
				"T002.F004" => $college, 
				"date_format(T002.F002, '%Y')" => $grade
			),
			'joins' => array(
				array(
					'table' => 'T002',
		            'alias' => 'T002',
		            'type' => 'INNER',
		            'conditions' => array(
		                'TPerson.Id = T002.FPerson'
		            )
				)
			),
			'fields' => array(
				"TPerson.*",
				"T002.F004 as Extra_college", 
				"T002.F002 as Extra_grade", 
				"T002.F005 as Extra_subject",
				"T002.F006 as Extra_class"
			),
			'group' => array('TPerson.Id'),
			'order' => array('CreateDate DESC')
		);
		$attr = array_merge($attr, $limit, $offset, $order);
		if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
		$result = $this->find($find, $attr);
		if ($isCount && empty($result)) return 0;
		return $result;
	}
	
	/**
	 * 取专业的人员数据
	 *
	 * @return void
	 * @author apple
	 **/
	function getSubjectPersonResult($college, $grade, $subject, $isCount = 0, $limit = null, $offset = null, $sort = null, $desc = null, $conditions = null)
	{
		$limit = $limit ? array('limit' => $limit) : array();
		$offset = $offset ? array('offset' => $offset) : array();
		$find = $isCount ? 'count' : 'all';
		$order = $sort ? array('order' => array($sort => $desc)) : array();
		$attr = array(
			'conditions' => array(
				"T002.F004" => $college,
				"date_format(T002.F002, '%Y')" => $grade,
				"T002.F005" => $subject
			),
			'joins' => array(
				array(
					'table' => 'T002',
		            'alias' => 'T002',
		            'type' => 'INNER',
		            'conditions' => array(
		                'TPerson.Id = T002.FPerson'
		            )
				)
			),
			'fields' => array(
				"TPerson.*", 
				"T002.F004 as Extra_college", 
				"T002.F002 as Extra_grade", 
				"T002.F005 as Extra_subject",
				"T002.F006 as Extra_class"
			),
			'group' => array('TPerson.Id'),
			'order' => array('CreateDate DESC')
		);
		$attr = array_merge($attr, $limit, $offset, $order);
		if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
		$result = $this->find($find, $attr);
		if ($isCount && empty($result)) return 0;
		return $result;
	}
	
	/**
	 * 取班级的人员数据
	 *
	 * @return void
	 * @author apple
	 **/
	function getClassPersonResult($college, $grade, $subject, $class, $isCount = 0, $limit = null, $offset = null, $sort = null, $desc = null, $conditions = null)
	{
		$limit = $limit ? array('limit' => $limit) : array();
		$offset = $offset ? array('offset' => $offset) : array();
		$find = $isCount ? 'count' : 'all';
		$order = $sort ? array('order' => array($sort => $desc)) : array();
		$attr = array(
			'conditions' => array(
				"T002.F004" => $college,
				"date_format(T002.F002, '%Y')" => $grade,
				"T002.F005" => $subject,
				"T002.F006" => $class
			),
			'joins' => array(
				array(
					'table' => 'T002',
		            'alias' => 'T002',
		            'type' => 'INNER',
		            'conditions' => array(
		                'TPerson.Id = T002.FPerson'
		            )
				)
			),
			'fields' => array(
				"TPerson.*",
				"T002.F004 as Extra_college", 
				"T002.F002 as Extra_grade", 
				"T002.F005 as Extra_subject",
				"T002.F006 as Extra_class"
			),
			'group' => array('TPerson.Id'),
			'order' => array('CreateDate DESC')
		);
		$attr = array_merge($attr, $limit, $offset, $order);
		if ($conditions) $attr['conditions'] = array_merge($attr['conditions'], $conditions);
		$result = $this->find($find, $attr);
		if ($isCount && empty($result)) return 0;
		return $result;
	}
	
	/**
	 * 获取修改的项
	 *
	 * @return void
	 * @author apple
	 **/
	function getDifferentsResult($data)
	{
		if (!is_array($data)) return FALSE;
		$t002_fields = array('T002.Extra_college', 'T002.Extra_grade', 'T002.Extra_subject', 'T002.Extra_class');
		foreach ($t002_fields as $key => $vals)
		{
			unset($data[$vals]);
		}
		$result = $this->findById($data['Id'], array_keys($data));
		$result = $result['TPerson'];
		if (!is_array($result)) return FALSE;
		$diff = array_diff_assoc($result, $data);
		$nearrr = array();
		if (is_array($diff))
		{
			foreach ($diff as $key => &$vals)
			{
				$nearrr[] = array(
					'FTableName' => $this->useTable,
					'FieldName' => $key,
					'FOldData' => $vals,
					'FNewData' => $data[$key]
				);
			}
		}
		return $nearrr;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function test()
	{
		return $this->uid;
	}
	
	/**
	 * 过滤 FMemberId为空的情况
	 *
	 * @return void
	 * @author apple
	 **/
	function SaSave($data)
	{
		if (isset($data['FMemberId']) && !empty($data['FMemberId'])) 
		{
			if ($this->save($data))
				return TRUE;
		}
	}
	
	/**
	 * 更新纪录的Save
	 *
	 * @return void
	 * @author apple
	 **/
	function reSave($data, $uid)
	{
		$this->newds = $data;
		$this->newds['xyhms_values'] = ClassRegistry::init('TPerson')->getDifferentsResult($this->newds);
		if ($this->SaSave($data))
		{
			ClassRegistry::init('TPersonLog')->save_edit_log($uid, 'update', $this->newds);
			return TRUE;
		}
	}
	
	function _clearT002Data($data)
	{
		$t002_fields = array('T002.Extra_college', 'T002.Extra_grade', 'T002.Extra_subject', 'T002.Extra_class');
		foreach ($t002_fields as $key => $vals)
		{
			if (isset($data[$vals])) unset($data[$vals]);
		}
		return $data;
	}
	
	/** ===================liunian_svc===================
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function reSaveAvatar($phone)
	{
		if ($this->find('count', array('conditions' => array('FMobileNumber' => $phone))))
		{
			$fdata = $this->find('first', array('conditions' => array('FMobileNumber' => $phone), 'recursive' => -1));
			$uid = $fdata['TPerson']['Id'];
			return $uid;
		}
		else
		{
			$data['Id'] = String::uuid();
			$data['FMobileNumber'] = $phone;
			if ($this->save($data, FALSE))
			{
				return $data['Id'];
			}
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function addActivePerson($phone)
	{
		$uid = ClassRegistry::init('SocialActive')->saveActiveByPhone($phone);	
		if ($uid)
		{
			$count = $this->find("count", array('conditions' => array('Id' => $uid)));
			$this->id = $uid;
			if (!$count) $data['Id'] = $uid; 
			$data['FMemberId'] = $this->_makeFMemberId();
			$data['FullName'] = "LIUNIAN";
			$data['FCreateDate'] = date('Y-m-d H:i:s');
			$data['FMobileNumber'] = $phone;
	 		$query = $this->save($data);
			if ($query) return $uid;
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function addPerson()
	{
		$data['Id'] = String::uuid();
		$data['FMemberId'] = $this->_makeFMemberId();
		$data['FullName'] = "LIUNIAN";
		$data['FBirthday'] = "1991-04-13 00:00:00";
		$data['FCreateDate'] = date('Y-m-d H:i:s');
		$query = $this->save($data);
		if ($query) return $data['Id'];
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function isWxsso($openid)
	{
		if (empty($openid)) return FALSE;
		$data = $this->find('first', array('conditions' => array('wx_openid' => $openid), 'recursive' => -1));
		$uid = isset($data['TPerson']['Id']) ? $data['TPerson']['Id'] : FALSE;
		if ($uid)
		return $this->getUserInfo($uid);
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _makeFMemberId()
	{
		$tbsini = ClassRegistry::init('TBSIni')->getMakeCacheArray();
		$config['defaultValue'] = $tbsini['MemberId_DefaultValue'];
		$config['step'] = $tbsini['MemberId_step'];
		$maxdata = $this->find("first", array("fields" => array("MAX(CONVERT(`FMemberId`,SIGNED)) as MAXField")));
		$max_id = $maxdata[0]['MAXField'];
		$max_id = !empty($max_id) ? $max_id : $config['defaultValue'];
		$step = !empty($config['step']) ? $config['step'] : 1;
		$user_id = intval($max_id) + intval($step);
		return $user_id;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getUserInfo($uid)
	{
		$pd = ClassRegistry::init('TPerson')->find('first', array('conditions' => array('Id' => $uid), 'recursive' => 0));
		$data = isset($pd['TPerson']) ? $pd['TPerson'] : '';
		return $data;
	}
	
	
	/**
	 * 按照手机号去保存用户信息
	 *
	 * @return void
	 * @author apple
	 **/
	function saveInfoByPhone($phone, $data)
	{
		$sdata = ClassRegistry::init('SocialActive')->getIdByPhone($phone);
		if (isset($sdata['uid']))
		{
			$this->read(null, $sdata['uid']);
			$this->set($data);
			$query = $this->save();
			if ($query) return $this->id;
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveAndEduInfo($uid, $pdata, $edata, $reg = 0)
	{
		$this->id = $uid;
		$pdata->FUpdateDate = date('Y-m-d H:i:s');
		if ($pdata->FPassWord) $pdata->FPassWord = base64_encode($pdata->FPassWord);
		$query = $this->save($pdata);
		if ($reg && $edata)
		{
			$equery = ClassRegistry::init('TEducation')->saveFirstEduInfo($uid, $edata);
			if ($query && $equery) return TRUE;
		}
		else
		{
			if ($query) return TRUE;
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function loginByPhone($phone, $password)
	{
		$attr = array(
			'conditions' => array(
				"SocialActive.FIsActive" => 1,
				"SocialActive.FType" => 1,
				"SocialActive.FValue" => $phone,
				"TPerson.FPassWord" => $password,
			),
			'joins' => array(
				array(
					'table' => 'social_active',
		            'alias' => 'SocialActive',
		            'type' => 'INNER',
		            'conditions' => array(
		                'TPerson.Id = SocialActive.FPerson'
		            )
				)
			),
			'fields' => array(
				"TPerson.*",
			),
			'group' => array('SocialActive.Id'),
			'recursive' => -1
		);
		$result = $this->find("first", $attr);
		return $result;
	}
	
	// ============ webchat
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function addUser($user) {
		App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
		$sp = new SimplePasswordHasher();
		$this->set($user);
		$this->set('Id', String::uuid());
		$this->set('FPassWord', $sp->hash($this->data['TPerson']['FPassWord']));
		$this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('FIsActive', 1);
		$this->set('FIsAuth', 1);
		// $this->create();
		// echo '<pre>';print_r($this->data);exit;
		$query = $this->save($this->data, FALSE);
		if ($query) return $this->id;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function addAdminUser($user) {
		App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
		$sp = new SimplePasswordHasher();
		$data['Id'] = String::uuid();
		$data['FMemberId'] = $user['TPerson']['FMemberId'];
		$data['FPassWord'] = $sp->hash($user['TPerson']['FPassWord']);
		$data['FullName'] = "系统管理员";
		$data['FCreatedate'] = $data['FUpdatedate'] = date('Y-m-d H:i:s');
		$data['FIsActive'] = 1;
		$data['FIsAuth'] = 1;
		$data['FIsAdmin'] = 1;
		$this->create();
		$query = $this->save($data, FALSE);
		if ($query) return $user;
	}
	
	/**
	 * validIdentical
	 *
	 * @param string $check
	 * @return boolean
	 */
	 public function validIdentical($check) {
		App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
		$sp = new SimplePasswordHasher();
		$checkPwd = $sp->hash($check['FRePassWord']);
		if (isset($this->data['TPerson']['FPassWord'])) {
			if ($this->data['TPerson']['FPassWord'] != $checkPwd) {
				return __d('croogo', '两次密码不一致');
			}
		}
		return true;
	}
	
	/**
	 * validIdentical
	 *
	 * @param string $check
	 * @return boolean
	 */
	 public function validIdentical_noEn($check) {
		$checkPwd = $check['FRePassWord'];
		if (isset($this->data['TPerson']['FPassWord'])) {
			if ($this->data['TPerson']['FPassWord'] != $checkPwd) {
				return __d('croogo', '两次密码不一致');
			}
		}
		return true;
	}

}
