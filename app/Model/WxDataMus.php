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
	function saveData($data, $id)
	{
		if (isset($data['WxDataMus']['Id'])) {
			$this->id = $data['WxDataMus']['Id'];
			unset($data['WxDataMus']['Id']);
		} else {
			$this->set('Id', String::uuid());
		}
		if (!$this->id) $this->set('FCreatedate', date('Y-m-d H:i:s'));
		$this->set('FUpdatedate', date('Y-m-d H:i:s'));
		$this->set('FWebchat', $id);
		$this->set($data);
		$query = $this->save($this->data, FALSE);
		if ($query) return $this->id;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function svMenus($data) {
		$dbs = array();
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (isset($value['children'])) {
					foreach ($value['children'] as $k => $v) {
						$this->id = $v['id'];
						$this->set('FOrder', intval($k) + 1);
						$this->set('FOwnerMenu', $value['id']);
						$this->save($this->data, FALSE);
					}
				}
				$this->id = $value['id'];
				$this->set('FOrder', intval($key) + 1);
				$this->set('FOwnerMenu', NULL);
				$this->save($this->data, FALSE);
			}
		}
		return TRUE;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getDataList($id, $cid = NULL, $ids = NULL)
	{
		if ($cid != NULL) {
			$data = $this->find('first', array('conditions' => array('Id' => $cid, 'FWebchat' => $id), 'recursive' => 0));
			if (is_array($data)) {
				$data['WxDataMus']['FTwj'] = unserialize($data['WxDataMus']['FTwj']);
				$data['WxDataMus']['FPreTwj'] = implode(',', $data['WxDataMus']['FTwj']);
			}
		} else {
			$newData = array();
			$conditions = array('FWebchat' => $id, 'FOwnerMenu' => NULL);
			if ($ids) $conditions['Id'] = $ids;
			$data['datalist'] = $this->find('all', array('conditions' => $conditions, 'order' => "FCreatedate asc, FOrder asc", 'recursive' => 0));
			$data['count'] = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
			foreach ($data['datalist'] as $key => &$vals) {
				$ownerId = $vals['WxDataMus']['Id'];
				$conditions = array('FWebchat' => $id, 'FOwnerMenu' => $ownerId);
				$ownerData['datalist'] = $this->find('all', array('conditions' => $conditions, 'order' => "FCreatedate asc, FOrder asc", 'recursive' => 0));
				$ownerData['count'] = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
				$newData[$key] = array('name' => $vals['WxDataMus']['FName'], 'id' => $vals['WxDataMus']['Id'], 'url' => $vals['WxDataMus']['FKeysOrLink']);
				if ($ownerData['count']) {
					foreach ($ownerData['datalist'] as $k => $v) {
						 $newData[$key]['children'][$k] = array('name' => $v['WxDataMus']['FName'], 'id' => $v['WxDataMus']['Id'], 'url' => $v['WxDataMus']['FKeysOrLink']);
					}
				}
			}
			$data = $newData;
			// echo $this->getLastQuery();
			// print_r(json_encode($newData));exit;
		}
		return $data;
	}

}
