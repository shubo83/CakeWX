<?php
App::uses('AppController', 'Controller');

/**
 * Mobile Controller
 *
 * @property Mobile $niancode
 */
class MobController extends AppController {
	
	public $layout = "mobile";
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('tw'); 
		$this->loadModel("TPerson");
        $this->loadModel("TPerson");
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function index()
	{
		$this->render('/Mobile/index');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function tw($id, $cid)
	{
		$this->loadModel("WxDataTw");
		// $id = $id == 'events' ? $cid : $id;
		switch ($id) {
			case 'events':
				// Check Id
				if (!$this->WxDataTw->findById($cid)) {
					$this->flashError("不存在此内容。");
					$this->redirect("/");
				}
				$result = $this->WxDataTw->getDataList(NULL, $cid);
				if ($result['WxDataTw']['FType'] == 0 && $result['WxDataTw']['FTwType'] == 'events') {
					$data['title'] = $result['WxDataTw']['FTitle'];
					$data['cover'] = $result['WxDataTw']['FUrl'];
					$data['author'] = $result['WxDataTw']['FAuthor'];
					$data['content'] = $result['WxDataTw']['FContent'];
					$data['memeo'] = $result['WxDataTw']['FMemo'];
					$data['dateline'] = $result['WxDataTw']['FCreatedate'];
					$data['start'] = $result['WxDataTwEvent']['FStartdate'];
					$data['maxpercount'] = $result['WxDataTwEvent']['FMaxPersonCount'];
					$data['address'] = $result['WxDataTwEvent']['FAddress'];
					$data['percount'] = $result['WxDataTwEvent']['FPersonCount'];
					$this->set('post', $data);
					$this->render('/Mobile/events');
				}
				break;
			default:
				// Check Id
				if (!$this->WxDataTw->findById($id)) {
					$this->flashError("不存在此内容。");
					$this->redirect("/");
				}
				$result = $this->WxDataTw->getDataList(NULL, $id);
				$data['title'] = $result['WxDataTw']['FTitle'];
				$data['author'] = $result['WxDataTw']['FAuthor'];
				$data['content'] = $result['WxDataTw']['FContent'];
				$data['memeo'] = $result['WxDataTw']['FMemo'];
				$data['dateline'] = substr($result['WxDataTw']['FCreatedate'],0,strpos($result['WxDataTw']['FCreatedate'],' '));
				$this->set('post', $data);
				$this->render('/Mobile/index');
		}
	}
}