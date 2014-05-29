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
<div class="user">
	<h3 class="lighter block green">
		请完整填写以下信息：
	</h3>
<?php 
echo $this->session->flash('auth');
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
echo $this->Main->formhr_input('FullName', array(
		'div' => "form-group", 
		'label' => array('text' => "姓名：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FPhone', array(
		'div' => "form-group", 
		'label' => array('text' => "电话：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FMobileNumber', array(
		'div' => "form-group", 
		'label' => array('text' => "手机：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FEMail', array(
		'div' => "form-group", 
		'label' => array('text' => "邮箱：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FCity', array(
		'div' => "form-group", 
		'label' => array('text' => "城市：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
?>
	<div class="clearfix form-actions">
		<div class="col-sm-3 no-padding-right">
			<button class="btn btn-grey" type="button" onclick="location.href='<?php echo Router::url('/'); ?>'">
                <i class="icon-arrow-left bigger-110"></i>
                返回
            </button>
		</div>
		<div class="col-xs-12 col-sm-9">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                注册账号
            </button>
		</div>
	
	</div>
	<?php echo $this->Form->end(); ?>
</div>