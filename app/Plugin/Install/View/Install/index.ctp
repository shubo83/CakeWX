<div class="install">
	<h2><?php echo $title_for_layout; ?></h2>
	<?php
		$check = true;
		
		// apache rewrite
		$result = apache_get_modules(); 
		if(in_array('mod_rewrite', $result)) { 
			echo '<p class="success">' . __d('croogo', 'Apache Rewrite 组件已安装。') . '</p>';
		} else {
			$check = false;
			echo '<p class="error">' . __d('croogo', 'Apache Rewrite 组件未安装。') . '</p>';
		}
		
		// tmp is writable
		if (is_writable(TMP)) {
			echo '<p class="success">' . __d('croogo', 'app/tmp 目录可写。') . '</p>';
		} else {
			$check = false;
			echo '<p class="error">' . __d('croogo', 'app/tmp 目录不可写。') . '</p>';
		}

		// config is writable
		if (is_writable(APP . 'Config')) {
			echo '<p class="success">' . __d('croogo', 'app/Config 目录可写。') . '</p>';
		} else {
			$check = false;
			echo '<p class="error">' . __d('croogo', 'app/Config 目录不可写。') . '</p>';
		}

		// php version
		$minPhpVersion = '5.2.8';
		$operator = '>=';
		if (version_compare(phpversion(), $minPhpVersion, $operator)) {
			echo '<p class="success">' . sprintf(__d('croogo', 'PHP version %s %s %s'), phpversion(), $operator, $minPhpVersion) . '</p>';
		} else {
			$check = false;
			echo '<p class="error">' . sprintf(__d('croogo', 'PHP version %s < %s'), phpversion(), $minPhpVersion) . '</p>';
		}
		
		// short_open_tag
		if (ini_get('short_open_tag') == 1) {
			echo '<p class="success">' . __d('croogo', 'PHP short_open_tag 已开启') . '</p>';
		} else {
			$check = false;
			echo '<p class="error">' . __d('croogo', 'PHP short_open_tag 未开启') . '</p>';
		}
		
		// curl
		if (function_exists('curl_init')) {
			echo '<p class="success">' . __d('croogo', 'PHP Curl 组件已开启') . '</p>';
		} else {
			$check = false;
			echo '<p class="error">' . __d('croogo', 'PHP Curl 组件不支持') . '</p>';
		}

		// cakephp version
		$minCakeVersion = '2.4.4';
		$cakeVersion = Configure::version();
		$operator = '>=';
		if (version_compare($cakeVersion, $minCakeVersion, $operator)) {
			echo '<p class="success">' . __d('croogo', 'CakePHP version %s %s %s', $cakeVersion, $operator, $minCakeVersion) . '</p>';
		} else {
			$check = false;
			echo '<p class="error">' . __d('croogo', 'CakePHP version %s < %s', $cakeVersion, $minCakeVersion) . '</p>';
		}

?>
</div>
<?php
if ($check) {
	$out = $this->Html->link(__d('croogo', '安装'), array(
		'action' => 'database',
	), array(
		'button' => 'success',
		'tooltip' => array(
			'data-title' => __d('croogo', 'Click here to begin installation'),
			'data-placement' => 'left',
		),
	));
} else {
	$out = '<p>' . __d('croogo', '安装不能进行，请把所需的组件安装并开启后尝试。') . '</p>';
}
echo $this->Html->div('form-actions', $out);
?>
