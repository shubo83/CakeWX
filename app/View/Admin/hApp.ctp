<?php
	$this->extend('/Common/Admin/index');
	$nav = array(
		'home' => array('name' => "全局设置", 'default' => TRUE), 
		'follow' => array('name' => "问答列表"), 
		'mch' => array('name' => "功能介绍")
	);
?>
<style type="text/css">
	.mar_5 {
		margin: 0 0 0 10px;
	}
	.maroon {
		color: red;
		margin-right: 5px;
	}
	.form-group.error input, .form-group.error select, .form-group.error textarea {
		border-color: #f09784;
		color: #d68273;
		-webkit-box-shadow: none;
		box-shadow: none;
	}
	.form-group.error .control-label, .form-group.error .help-block, .form-group.error .help-inline {
	color: #d16e6c;
	}
</style>
<div class="col-sm-12">
	<div class="tabbable">
		<ul class="nav nav-tabs padding-10" id="myTab4">
			<? foreach ($nav as $key => &$vals): ?>
				<?php
					if (in_array($WC_query['mod'], array_keys($nav)))
					{
						$nav[$WC_query['mod']]['active'] = TRUE;
					}
					else
					{
						$vals['active'] = isset($vals['default']) ? TRUE : FALSE;
					}
					$view['actvop'] = $vals['active'] ? 'active' : '';
				?>
				<li class="<?= $view['actvop'] ?>">
					<a data-toggle="tab" href="<?= "#{$key}" ?>"><?= $vals['name'] ?></a>
				</li>
			<? endforeach ?>
		</ul>

		<div class="tab-content">
		</div>
	</div>
</div>