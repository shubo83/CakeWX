<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxSession extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'wcsess';
	public $expires = "86400";
	public $wxid = '';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
		'FData' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
	    'FWebchat' => array(
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
	function setWxId($id)
	{
		$this->wxid = $id;
		return TRUE;
	}
	
	/**
	 * 写入Wxsess
	 *
	 * @return void
	 * @author apple
	 **/
	function write($name, $data) {
		$id = $this->wxid;
		$wxdata = $this->find('first', array('conditions' => array('FWebchat' => $id), 'recursive' => 0));
		$wxid = isset($wxdata['WxSession']['Id']) ? $wxdata['WxSession']['Id'] : '';
		$this->id = $wxid;
		$data = array($name => $data);
		if ($this->id) {
			$wxdata_FData = unserialize($wxdata['WxSession']['FData']);
			$data = $wxdata_FData ? array_merge($wxdata_FData, $data) : $data;
			$data = $data ? serialize($data) : '';
			
		} else {
			$this->set('FCreatedate', date('Y-m-d H:i:s'));
			$data = serialize($data);
		}
		$this->set('Id', $this->id ? $this->id : String::uuid());
		$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		$this->set('FWebchat', $id);
		$this->set('FData', $data);
		$this->set('FExpires', time() + $this->expires);
		// echo '<pre>';print_r($this->data);exit;
		$query = $this->save($this->data);
		if ($query) return $this->id;
	}
	
	/**
	 * 读取Wxsess 
	 *
	 * @return void
	 * @author apple
	 **/
	function read($name) {
		$id = $this->wxid;
		$wxdata = $this->find('list', array('fields' => array('FWebchat', 'FData'), 'conditions' => array('FWebchat' => $id), 'recursive' => 0));
	    $data = reset($wxdata) ? unserialize(reset($wxdata)) : '';
		$data = isset($data[$name]) ? $data[$name] : '';
		return $data;
	}
	
	/**
	 * 删除Wxsess 
	 *
	 * @param string $name 
	 * @return void
	 * @author apple
	 */
	function delete($name) {
		$id = $this->wxid;
		$wxdata = $this->find('list', array('fields' => array('Id', 'FData'), 'conditions' => array('FWebchat' => $id), 'recursive' => 0));
		$sessid = array_keys($wxdata) ? reset(array_keys($wxdata)) : '';
		$data = reset($wxdata) ? unserialize(reset($wxdata)) : FALSE;
		if ($data)
		{
			unset($data[$name]);
			$this->id = $sessid;
			$this->set('FUpdatedate', date('Y-m-d H:i:s'));
			$this->set('FData', serialize($data));
			$query = $this->save($this->data, FALSE);
			return $query;
		}
	}
	
}
