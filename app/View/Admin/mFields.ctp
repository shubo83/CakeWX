<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"/assets/js/jquery.nestable.min",
		"Action/mFields",
	), array('block' => "script_extra", 'inline' => false));
?>

<!-- <button type="button" class="btn btn-sm btn-primary">
	<i class="icon-pencil align-top bigger-125"></i>
	添加菜单
</button> -->


<div class="col-sm-7">
	<div class="tabbable">
		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a data-toggle="tab" href="#home">
					<i class="green icon-home bigger-110"></i>
					DIY菜单
				</a>
			<li>
		</ul>

		<div class="tab-content">
			<div id="home" class="tab-pane in active">
				<div class="dd" id="nestable">
						<ol class="dd-list">
							<li class="dd-item" data-id="1">
								<div class="dd-handle">
									Item 1
									<i class="pull-right bigger-130 icon-warning-sign orange2"></i>
								</div>
							</li>

							<li class="dd-item " data-id="2">
								<div class="dd-handle">Item 2</div>
								<ol class="dd-list">
									<li class="dd-item" data-id="3">
										<div class="dd-handle">
											Item 3
											<a data-rel="tooltip" data-placement="left" title="Change Event Date" href="#" class="badge badge-primary radius-5 tooltip-info pull-right white no-hover-underline">
												<i class="bigger-120 icon-calendar"></i>
											</a>
										</div>
									</li>

									<li class="dd-item" data-id="4">
										<div class="dd-handle">
											<span class="orange">Item 4</span>
											<span class="lighter grey">
												&nbsp; with some description
											</span>
										</div>
									</li>

								

									<li class="dd-item" data-id="9">
										<div class="dd-handle btn-yellow no-hover">Item 9</div>
									</li>

									<li class="dd-item" data-id="10">
										<div class="dd-handle">Item 10</div>
									</li>
								</ol>
							</li>

							<li class="dd-item" data-id="11">
								<div class="dd-handle">
									Item 11
									<span class="sticker">
										<span class="label label-success arrowed-in">
											<i class="icon-ok bigger-110"></i>
										</span>
									</span>
								</div>
							</li>

							<li class="dd-item" data-id="12">
								<div class="dd-handle">Item 12</div>
							</li>
						</ol>
				</div>
			</div>

			<div id="profile" class="tab-pane">
				<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
			</div>

			<div id="dropdown1" class="tab-pane">
				<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
			</div>

			<div id="dropdown2" class="tab-pane">
				<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-5" style="margin-top:30px; border:1px solid #e3e3e3; background-color:#f5f5f5;">
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo "<h1>添加菜单：</h1>";
	echo $this->Form->create('WxDataMus', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
	echo $this->Main->formhr_input('FName', array(
			'div' => "form-group", 
			'label' => array('text' => "菜单名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FOwnerMenu', array(
		'div' => "form-group", 
		'options' => array('1' => '是', '0' => '否'),
		'label' => array('text' => "主菜单：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
	echo $this->Main->formhr_input('FKeysOrLink', array(
			'div' => "form-group", 
			'label' => array('text' => "菜单关键字或链接：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FIsActive', array(
			'div' => "form-group", 
			'options' => array('1' => '是', '0' => '否'),
			'label' => array('text' => "是否启用：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "select", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "</div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button class="btn btn-info" type="submit">
				<i class="icon-ok bigger-110"></i>
				保存
			</button>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
