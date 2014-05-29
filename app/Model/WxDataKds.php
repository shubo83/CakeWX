<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxDataKds extends AppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'wcdata_kds';

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
	
	public $type = array('0' => "文本", '1' => "图文");
	public $matchType = array('0' => "完全匹配", '1' => "模糊匹配");
	
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
        if (isset($this->data['WxDataKds']['FTwj'])) {
            $this->data['WxDataKds']['FTwj'] = serialize($this->data['WxDataKds']['FTwj']);
        }
		// print_r($this->data);exit;
		$query = $this->save($this->data, FALSE);
		if ($query) return $this->id;
	}
	
	/**
	 * Overridden paginate method - group by week, away_team_id and home_team_id
	 */
	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) 
	{
	    $recursive = -1;
		$data = $this->find(
	        'all',
	        compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive', 'group')
	    );
		foreach ($data as $key => &$vals)
		{	
			$vals['WxDataKds']['C_FType'] = $this->type[$vals['WxDataKds']['FType']];
			$vals['WxDataKds']['M_FType'] = $this->matchType[$vals['WxDataKds']['FKeyMacth']] ? $this->matchType[$vals['WxDataKds']['FKeyMacth']] : "完全匹配";
		}
	    return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getDataList($id, $cid = 'NULL')
	{	
		if ($cid != 'NULL')
		{
			$data = $this->find('first', array('conditions' => array('Id' => $cid, 'FWebchat' => $id), 'recursive' => 0));
			if (is_array($data)) {
				$data['WxDataKds']['FTwj'] = unserialize($data['WxDataKds']['FTwj']);
				$data['WxDataKds']['FPreTwj'] = implode(',', $data['WxDataKds']['FTwj']);
			}
		}
		else
		{
			$data['datalist'] = $this->find('all', array('conditions' => array('FWebchat' => $id), 'order' => "FCreatedate desc", 'recursive' => 0));
			$data['count'] = $this->find('count', array('conditions' => array('FWebchat' => $id), 'recursive' => 0));
			foreach ($data['datalist'] as $key => &$vals)
			{	
				$vals['WxDataKds']['C_FType'] = $this->type[$vals['WxDataKds']['FType']];
				$vals['WxDataKds']['FTwj'] = unserialize($vals['WxDataKds']['FTwj']);
			}
			// echo '<pre>';print_r($data);exit;
		}
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function checkId($id, $cid)
	{
		$conditions = array('FWebchat' => $id, 'Id' => $cid);
		$count = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
		if ($count) return TRUE;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getWxType($webchat, $keywords) {
		$data = $this->find('first', array('conditions' => array('FKey' => $keywords, 'FWebchat' => $webchat, 'AND' => array('OR' => array(array('FKeyMacth' => null), array('FKeyMacth' => 0)))), 'recursive' => 0));
		if (!$data) {		// 模糊匹配			
			$data = $this->find('first', array('conditions' => array("LOCATE(`Fkey`, '{$keywords}') >" => "0", 'FWebchat' => $webchat, 'FKeyMacth' => "1"), 'recursive' => 0));
		}
		$type = isset($data['FType']) ? $data['FType'] : FALSE;
		return $type;
	}
	
	/**
	 * WX_API
	 *
	 * @return void
	 * @author apple
	 **/
	function getMsg($webchat, $keywords) {
		$content = array();
		$suffix = ClassRegistry::init('WxWcdata')->getMsg('signtext', $webchat);
		$data = $this->find('first', array('conditions' => array("FIND_IN_SET('{$keywords}', REPLACE(FKey,'|',','))", 'FWebchat' => $webchat, 'AND' => array('OR' => array(array('FKeyMacth' => null), array('FKeyMacth' => 0)))), 'recursive' => 0));
		if (!$data) {		// 模糊匹配			
			$data = $this->find('first', array('conditions' => array("LOCATE(`Fkey`, '{$keywords}') >" => "0", 'FWebchat' => $webchat, 'FKeyMacth' => "1"), 'recursive' => 0));
		}
		$type = isset($data['WxDataKds']['FType']) ? intval($data['WxDataKds']['FType']) : FALSE;
		if ($data) {
			switch ($type) {
				case '0':
					$content['type'] = "text";
					$content['data'] = isset($data['WxDataKds']['FWbContent']) ? $data['WxDataKds']['FWbContent'].$suffix : ClassRegistry::init('WxWcdata')->getMsg('null', $webchat);
					break;
				case '1':
					$WX_twj = isset($data['WxDataKds']['FTwj']) ? unserialize($data['WxDataKds']['FTwj']) : FALSE;
					$WX_twData = ClassRegistry::init('WxDataTw')->getMsg($WX_twj);
					$content['data']['ArticleCount'] = $WX_twData['count'];
					$content['data']['items'] = $WX_twData['items'];
					$content['type'] = "news";
					break;
			}
		} else {
			$content = ClassRegistry::init('WxWcdata')->getMsg('null', $webchat);
		}
		return $content;
	}
}
