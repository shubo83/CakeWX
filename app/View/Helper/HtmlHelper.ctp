<?php

 /**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */

class HtmlHelper extends AppHelper {
	
	public function __construct(View $view, $settings = array())
	{
		parent::__construct($view, $settings);
	}

	
}