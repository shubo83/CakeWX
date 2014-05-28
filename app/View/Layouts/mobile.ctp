<?php
	$layout = isset($layout) ? $layout : '';

	// CSS block
	$this->Html->css(array(
		"Mobile/client-page1d90ea.css"
	), null, array('block' => "css_basic", 'inline' => false));
    $this->Html->css(array(
        "Mobile/pc-page1d90ea.css"
    ), null, array('block' => "css_ie9", 'inline' => false));

	// Script block
	$this->Html->script(array(
	), array('block' => "script_basic", 'inline' => false));
	$this->Html->script(array(
		"Mobile/common",
	), array('block' => "script_common", 'inline' => false));
	
	// Html view
	echo $this->Html->docType('html5');
	echo '<html xmlns="http://www.w3.org/1999/xhtml">';
	echo '<head>';
	echo $this->Html->charset();
	echo "<title>{$cakeTitle}</title>";
	echo $this->Html->meta('icon');
	echo $this->Html->meta('keywords', $cakeKeywords);
	echo $this->Html->meta('description', $cakeDescription);
	echo $this->Html->meta(array('name' => "author", 'content' => "liunian"));
	echo $this->Html->meta(array('name' => "generator", 'content' => "liunian.wln"));
	echo $this->Html->meta(array('name' => "viewport", 'content' => "width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"));
	echo $this->Html->meta(array('name' => "apple-mobile-web-app-capable", 'content' => "yes"));
	echo $this->Html->meta(array('name' => "apple-mobile-web-app-status-bar-style", 'content' => "black"));
	echo $this->Html->meta(array('name' => "format-detection", 'content' => "telephone=no"));
	echo '<!-- basic styles -->'.$this->fetch('css_basic');
    echo '<!--[if IE 9]>'.$this->fetch('css_ie9').'<![endif]-->';
    echo '<link media="screen and (min-width:1000px)" rel="stylesheet" type="text/css" href="'.Router::url('/css/Mobile/pc-page1d90ea.css').'"/>';
	echo $this->fetch('css_common');
	echo $this->fetch('css_extra');
?>
<script type="text/javascript">
var BASE_URL = '<?= Router::url("/", TRUE) ?>';
var UPLOAD_URL = '<?= Router::url("/lib/picUpload") ?>';
var ADMIN_URL = '<?= Router::url("/admin/", TRUE) ?>';
var ADMIN_WC_URL = '<?= Router::url($WC_BASE) ?>';
</script>
<style>
.copyright{text-align: center;margin:10px 0;font-size:10px;}
.copyright a{text-decoration: none;color:#393939;}
</style>
</head>
	<body id="activity-detail">
		<?php
			echo $this->fetch('content');
			echo $this->fetch('script_basic');
			echo $this->fetch('script_common');
			echo $this->fetch('script_extra');
		?>
		<div id='ajcont' style="display:none">
			<div id="aj_box"></div>
		</div>
	</body>
</html>
