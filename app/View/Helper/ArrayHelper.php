<?php

 /**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */

class ArrayHelper extends AppHelper {
	
	public function __construct(View $view, $settings = array())
	{
		parent::__construct($view, $settings);
	}
	
	/**
	 * element function
	 *
	 * @return void
	 * @author apple
	 **/
	function element($item, $array, $default = FALSE)
	{
		if ( ! isset($array[$item]) OR $array[$item] == "")
		{
			return $default;
		}

		return $array[$item];
	}
	
	/**
	 * elements function
	 *
	 * @return void
	 * @author apple
	 **/
	function elements($items, $array, $default = FALSE)
	{
		$return = array();
		
		if ( ! is_array($items))
		{
			$items = array($items);
		}
		
		foreach ($items as $item)
		{
			if (isset($array[$item]))
			{
				$return[$item] = $array[$item];
			}
			else
			{
				$return[$item] = $default;
			}
		}

		return $return;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function sns_url()
	{
		$url = ClassRegistry::init('XyhSetting')->getSettingsUrl();
		
		return $url;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function MY_arrSearch($arr, $vls, $url = "", $each = FALSE, $child = "", $action = "action")
	{
		$newarr = array();
		$arr1 = array_keys($arr);
		$find = FALSE;
		if (is_array($arr))
		{
			
			// FIsActive
			foreach ($arr as $key => &$value)
			{
				if (isset($value['FIsActive']) && !$value['FIsActive']) unset($arr[$key]);
				if (isset($value[$child]))
				{
					foreach ($value[$child] as $k => &$v)
					{
						if (isset($v['FIsActive']) && !$v['FIsActive']) unset($value[$child][$k]);
					}
				}
			}
			
			// Search and Return
			foreach ($arr as $key => &$value)
			{
				if ($value[$url] == $vls)
				{
					$newarr[$key][$url] = $value[$url];
					
					// Active
					$newarr[$key]['active'] = 1;
					$value['active'] = 1;
					break;
				}
				else
				{
					if ($each & isset($value[$child]) && is_array($value[$child]))
					{
						foreach ($value[$child] as $k => &$v)
						{
							if ($v[$url] == $vls)
							{
								$newarr[$key][$url] = $value[$url];
								$newarr[$key]['active'] = 1;
								$newarr[$key]['open'] = 1;
								$newarr[$key][$child][$k] = $v[$url];
								
								// Active
								$value['active'] = 1;
								$value['open'] = 1;
								$v['active'] = 1;
								$find = TRUE;
								break;
							}
							else
							{
								if (isset($v[$action]) && is_array($v[$action]))
								{
									foreach ($v[$action] as $ak => &$av)
									{
										if ($av[$url] == $vls)
										{
											$newarr[$k][$url] = $v[$url];
											$newarr[$k]['active'] = 1;
											$newarr[$k]['open'] = 1;
											$newarr[$k][$child][$ak] = $av[$url];
											
											// Active
											$value['active'] = 1;
											$value['open'] = 1;
											$v['active'] = 1;
											$find = TRUE;
											break;
										}
									}
								}
							}
						}
						if ($find) break;
					}
				}
			}
		}
		return array('search' => $newarr, 'menu' => $arr);
	}

}