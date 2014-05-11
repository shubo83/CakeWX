<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxWcdata extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'wcdata';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
		'FDefaultType' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
	    'FDefaultContent' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FFollowContent' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FFollowType' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FSignText' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveData($data, $uid, $id)
	{
		$wxdata = $this->find('first', array('conditions' => array('FWebchat' => $id), 'recursive' => 0));
		$wxid = isset($wxdata['WxWcdata']['Id']) ? $wxdata['WxWcdata']['Id'] : '';
		$this->id = $wxid;
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('Id', $this->id ? $this->id : String::uuid());
		$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		$this->set('FWebchat', $id);
		$this->set($data);
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
	function getDataList($webchat, $id = 'NULL')
	{
		$data = $this->find('first', array('conditions' => array('FWebchat' => $webchat), 'recursive' => 0));
		// if ($id != 'NULL')
		// 	{
		// 		$data = $this->find('first', array('conditions' => array('FWebchat' => $id), 'recursive' => 0));
		// 		// $data = isset($data['WxWebchat']) ? $data['WxWebchat'] : '';
		// 	}
		// 	else
		// 	{
		// 		$data['list'] = $this->find('all', array('conditions' => array(), 'order' => "FCreatedate desc", 'recursive' => 0));
		// 		$data['count'] = $this->find('count', array('conditions' => array(), 'recursive' => 0));
		// 		foreach ($data['list'] as $key => &$vals)
		// 		{
		// 			// $vals['WxWebchat']['FIcon'] = 'abc';
		// 		}
		// 		// echo '<pre>';print_r($data);
		// 	}
		return $data;
	}
	
	/**
	 * WX_API
	 *
	 * @return void
	 * @author apple
	 **/
	function getMsg($type = null, $webchat, $var = null)
	{
		$data = $this->getDataList($webchat);
		switch ($type)
		{
			case 'subscribe':			// 订阅
				if ($data['WxWcdata']['FFollowType'] == 1 && $data['WxWcdata']['FFollowId']) {
					$WX_twj = $data['WxWcdata']['FFollowId'];
					$msg = ClassRegistry::init('WxDataTw')->getMsg($WX_twj, 'news');
				} else {
					$msg = isset($data['WxWcdata']['FFollowContent']) ? $data['WxWcdata']['FFollowContent'] : FALSE;
					$msg = !$msg ? $this->getMsg(null, $webchat) : $msg;
				}
 				break;
			case 'signtext':			// 个性签名
				$msg = isset($data['WxWcdata']['FSignText']) ? $data['WxWcdata']['FSignText'] : '';
				break;
			case 'keyword':			// 关键字
				$msg = ClassRegistry::init('WxDataKds')->getMsg($webchat, $var['keyword']);
				break;
			default:
				if ($data['WxWcdata']['FFollowType'] == 1 && $data['WxWcdata']['FDefaultId']) {
					$WX_twj = $data['WxWcdata']['FDefaultId'];
					$msg = ClassRegistry::init('WxDataTw')->getMsg($WX_twj, 'news');
				} else {
					$msg = isset($data['WxWcdata']['FDefaultContent']) ? $data['WxWcdata']['FDefaultContent'] : FALSE;
				}
				break;
		}
		return $msg;
	}
	
}
