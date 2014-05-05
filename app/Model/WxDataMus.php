<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataMus extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_mus';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'Id';
	
	/**
	 * undocumented variable
	 *
	 * @var string
	 */
	public $validate = array(
	    'FKey' => array(
			'notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "必须填写",
				'required' => true
			),
			'alphaNumeric' => array(
				'rule' => "alphaNumeric",
				'message' => "请填写字母或者数字",
				'required' => true
			)
	    ),
		'FKeyMacth' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FType' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FWbContent' => array(
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
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('Id', $this->id ? $this->id : String::uuid());
		$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		$this->set('FWebchat', $id);
		// print_r($this->data);exit;
		$query = $this->save($this->data);
		if ($query) return $this->id;
	}

}
