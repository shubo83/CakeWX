<?php
	$this->extend('/Common/Admin/user');
	
	// load css
	$this->Html->css(array(
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
	), array('block' => "script_extra", 'inline' => false));
?>
<style type="text/css">
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
.user {
	margin: 30px 0 0 0;
}
</style>
<div class="user">
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('TPerson', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
	echo $this->Main->formhr_input('FMemberId', array(
			'div' => "form-group", 
			'options' => array('0' => "文本", '1' => "图文", '2' => "图文集"),
			'label' => array('text' => "用户名：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "请输入账号", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FPassWord', array(
			'div' => "form-group", 
			'label' => array('text' => "密码：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "password", 
			'placeholder' => "请输入密码", 
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
				登录到后台
			</button>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?php echo Router::url('/signup'); ?>" class="btn btn-success">
				<i class="icon-pencil bigger-110"></i>
				注册新的账号
			</a>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
</div>