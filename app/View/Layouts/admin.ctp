<?php
	$layout = isset($layout) ? $layout : '';

	// CSS block
	$this->Html->css(array(
		'/assets/css/bootstrap.min',
		'/assets/css/font-awesome.min'
	), null, array('block' => "css_basic", 'inline' => false));
	$this->Html->css(array(
		"/assets/css/ace-fonts",
		"/assets/css/ace.min",
		"/assets/css/ace-rtl.min",
		"/assets/css/ace-skins.min"
	), null, array('block' => "css_font", 'inline' => false));
	$this->Html->css(array(
		"/assets/css/font-awesome-ie7.min"
	), null, array('block' => "css_ie7", 'inline' => false));
	$this->Html->css(array(
		"/assets/css/ace-ie.min"
	), null, array('block' => "css_ie8", 'inline' => false));
	$this->Html->css(array(
		"common"
	), null, array('block' => "css_common", 'inline' => false));
	
	// Script block
	$this->Html->script(array(
		"/assets/js/ace-extra.min",
	), array('block' => "script_ace", 'inline' => false));
	$this->Html->script(array(
		"/assets/js/html5shiv",
		"/assets/js/respond.min"
	), array('block' => "script_ie9", 'inline' => false));
	$this->Html->script(array(
		"/assets/js/excanvas.min",
	), array('block' => "script_ie8", 'inline' => false));
	$this->Html->script(array(
		"/assets/js/bootstrap.min",
		"/assets/js/typeahead-bs2.min"
	), array('block' => "script_basic", 'inline' => false));
	$this->Html->script(array(
		"/assets/js/jquery-ui-1.10.3.custom.min",
		"/assets/js/jquery.ui.touch-punch.min",
		"/assets/js/jquery.slimscroll.min",
		"/assets/js/jquery.easy-pie-chart.min",
		"/assets/js/jquery.sparkline.min",
		"/assets/js/flot/jquery.flot.min",
		"/assets/js/flot/jquery.flot.pie.min",
		"/assets/js/flot/jquery.flot.resize.min",
		"/assets/js/ace-elements.min",
		"/assets/js/ace.min"
	), array('block' => "script_aceos", 'inline' => false));
	$this->Html->script(array(
		"common",
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
	echo $this->Html->meta(array('name' => "author", 'content' => "liunian.CakeWX"));
	echo $this->Html->meta(array('name' => "generator", 'content' => "www.cakewx.com"));
	echo $this->Html->meta(array('viewport' => "width=device-width, initial-scale=1.0"));
	echo '<!-- basic styles -->'.$this->fetch('css_basic');
	echo '<!--[if IE 7]>'.$this->fetch('css_ie7').'<![endif]-->';
	echo '<!-- fonts -->'.$this->fetch('css_font');
	echo '<!--[if lte IE 8]>'.$this->fetch('css_ie8').'<![endif]-->';
	echo $this->fetch('css_common');
	echo $this->fetch('css_extra');
	echo '<!-- ace settings handler -->'.$this->fetch('script_ace');
	echo '<!--[if lt IE 9]>'.$this->fetch('script_ie9').'<![endif]-->';
?>
<link rel="stylesheet" href="<?= Router::url('/js/Editor/themes/default/default.css') ?>" />
<script type="text/javascript">
var BASE_URL = '<?= Router::url("/", TRUE) ?>';
var UPLOAD_URL = '<?= Router::url("/lib/picUpload") ?>';
var ADMIN_URL = '<?= Router::url("/admin/", TRUE) ?>';
var ADMIN_WC_URL = '<?= Router::url($WC_BASE) ?>';
</script>
</head>
	<body>	
		<?php
			echo $this->Session->flash('flash', array('element' => 'flash'));
			echo $this->Session->flash('error', array('element' => 'flash', 'params' => array('tipsType' => "error")));
			echo $this->Session->flash('auth', array('element' => 'flash', 'params' => array('tipsType' => "error")));
			echo $this->fetch('content');
			echo '<!--[if !IE]> --><script type="text/javascript">
				window.jQuery || document.write("<script src=\''.$this->Html->url('/assets/js/jquery-2.0.3.min.js').'\'>"+"<"+"/script>");
			</script><!-- <![endif]-->';
			echo '<!--[if IE]>
			<script type="text/javascript">
			window.jQuery || document.write("<script src=\''.$this->Html->url('/assets/js/jquery-1.10.2.min.js').'\'>"+"<"+"/script>");
			</script>
			<![endif]-->';
			echo '<script type="text/javascript">
					if("ontouchend" in document) document.write("<script src=\''.$this->Html->url('/assets/js/jquery.mobile.custom.min.js').'\'>"+"<"+"/script>");
				</script>';
			echo $this->fetch('script_basic');
			echo '<!--[if lte IE 8]>'.$this->fetch('script_ie8').'<![endif]-->';
			echo $this->fetch('script_aceos');
			echo $this->fetch('script_common');
			echo $this->fetch('script_extra');
		?>
		<div id='ajcont' style="display:none">
			<div id="aj_box"></div>
		</div>
	</body>
</html>
