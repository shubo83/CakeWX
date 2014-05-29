<?php
	$this->extend('/Common/Admin/index');
	$nav = array(
		'home' => array('name' => "全局设置", 'default' => TRUE), 
		// 'follow' => array('name' => "被关注回复"), 
		// 'mch' => array('name' => "无匹配回复")
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
		<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
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
			<div id="home" class="tab-pane active">
				<?php 
				$this->Form->inputDefaults(array('label' => true, 'div' => true));
				echo $this->Form->create('WxWcdata', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
				echo $this->Main->formhr_input('FSignText', array(
						'div' => "form-group", 
						'label' => array('text' => "个性签名：", 'class' => "col-sm-3 control-label no-padding-right"), 
						'type' => "textarea", 
						'placeholder' => "", 
						'class' => "col-xs-10 col-sm-5",
						'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
						'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>（签名只会应用于关键字的回复内容）</span></span></div></div>",
						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
					));
				?>
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="icon-ok bigger-110"></i>
							提交
						</button>
						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="icon-undo bigger-110"></i>
							重置
						</button>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>

			<div id="follow" class="tab-pane">
				<?php 
				$this->Form->inputDefaults(array('label' => true, 'div' => true));
				echo $this->Form->create('WxWcdata', array('url' => "{$WC_URL}?_m=follow", 'name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
				echo $this->Main->formhr_input('FFollowType', array(
						'div' => "form-group", 
						'options' => array('0' => "文本", '1' => "图文", '2' => "图文集"),
						'label' => array('text' => "回复类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
						'type' => "select", 
						'placeholder' => "", 
						'class' => "col-xs-10 col-sm-5",
						'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
						'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
					));
				echo $this->Main->formhr_input('FFollowContent', array(
						'div' => "form-group", 
						'label' => array('text' => "被关注回复内容：", 'class' => "col-sm-3 control-label no-padding-right"), 
						'type' => "textarea", 
						'placeholder' => "", 
						'class' => "col-xs-10 col-sm-5",
						'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
						'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
					));
				?>
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="icon-ok bigger-110"></i>
							提交
						</button>
						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="icon-undo bigger-110"></i>
							重置
						</button>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>

			<div id="mch" class="tab-pane">
				<?php 
				$this->Form->inputDefaults(array('label' => true, 'div' => true));
				echo $this->Form->create('WxWcdata', array('url' => "{$WC_URL}?_m=mch", 'name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
				echo $this->Main->formhr_input('FDefaultType', array(
						'div' => "form-group", 
						'options' => array('0' => "文本", '1' => "图文", '2' => "图文集"),
						'label' => array('text' => "回复类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
						'type' => "select", 
						'placeholder' => "", 
						'class' => "col-xs-10 col-sm-5",
						'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
						'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
					));
				echo $this->Main->formhr_input('FDefaultContent', array(
						'div' => "form-group", 
						'label' => array('text' => "无匹配回复内容：", 'class' => "col-sm-3 control-label no-padding-right"), 
						'type' => "textarea", 
						'placeholder' => "", 
						'class' => "col-xs-10 col-sm-5",
						'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
						'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
					));
				?>
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="icon-ok bigger-110"></i>
							提交
						</button>
						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="icon-undo bigger-110"></i>
							重置
						</button>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>