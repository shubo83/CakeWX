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
	    $this->Auth->allow('*'); 
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
		$data['title'] = $result['FName'];
		$data['author'] = $result['FAuthor'];
		$data['content'] = $result['FContent'];
		$data['memeo'] = $result['FMemo'];
		$data['dateline'] = $result['FCreatedate'];
		$this->set('post', $data);
		$this->render('/Mobile/index');
	}
	
}