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
	function tw($id)
	{
		$this->loadModel("WxDataTw");
		$result = $this->WxDataTw->getDataList(NULL, $id);
		$data['title'] = $result['WxDataTw']['FTitle'];
		$data['author'] = $result['WxDataTw']['FAuthor'];
		$data['content'] = $result['WxDataTw']['FContent'];
		$data['memeo'] = $result['WxDataTw']['FMemo'];
		$data['dateline'] = $result['WxDataTw']['FCreatedate'];
		$this->set('post', $data);
		$this->render('/Mobile/index');
	}
	
}