<?php

 /**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */

class MainHelper extends AppHelper {
	
	public function __construct(View $view, $settings = array())
	{
		parent::__construct($view, $settings);
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function sns_url($rurl = '')
	{
		$url = ClassRegistry::init('XyhSetting')->getSettingsUrl();
		$url = $this->Array->element('sns_url', $url['sns_url']);
		return $url.$rurl;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function menuSearch($arr, $type = 'hmenu')
	{
		if ($type == 'hmenu')
		{
			$action = $this->request->params['action'] == 'index' ? '' : '/'.$this->request->params['action'];
			$url = Router::url('/'.$this->request->params['controller'].$action);
		}
		else
		{
			$id = $this->request->params['pass'][0];
			$ac = $this->request->params['pass'][1];
			$url = Router::url("/admin/wc/{$id}/{$ac}");
		}
		
		$value = $this->Array->MY_arrSearch($arr, $url, 'url', TRUE, 'child');
		return $value;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function MY_currmenu($arr, $one = FALSE, $child = "child")
	{
		$str = "";
		if (!is_array($arr)) return FALSE;
		$arr_v = array_keys($arr);
		$value1 = reset($arr_v);
		if ($one) 
		{
			$str = $value1;
		}
		else
		{
			$str = $value1;
			if (isset($arr[$value1][$child]))
			{
				$arr_vs = array_keys($arr[$value1][$child]);
				$value2 = reset($arr_vs);
				$str = $str."<small>
					<i class=\"icon-double-angle-right\"></i>
					{$value2}
				</small>";
			}
		}
		return $str;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_input($name, $arr = array())
	{
		$html = $this->Form->input($name, $arr);
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_hidden($name, $arr = array())
	{
		$html = $this->Form->hidden($name, $arr);
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
}