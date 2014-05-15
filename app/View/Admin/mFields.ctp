<?php
	$this->extend('/Common/Admin/index');

	// load script
	$this->Html->script(array(
        "/assets/js/bootbox.min",
		"/assets/js/jquery.nestable.min",
        "/assets/js/jquery.json-2.4.min",
		"Action/mFields",
	), array('block' => "script_extra", 'inline' => false));
?>
<div class="row">
	<div class="col-sm-12" style="position: relative;">
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">
				<i class="icon-remove"></i>
			</button>
			<strong>
				编辑：
			</strong>
            最多可创建 3 个一级菜单，每个一级菜单下可创建最多 5 个二级菜单, 子菜单可通过拖拽实现。编辑中的菜单不会马上被用户看到，请放心调试。
			<br>
		</div>
	    <div class="tabbable">
            <button id="addnewitem" type="button" class="btn btn-xs btn-warning" style="float:right;margin-left:20px;">
                <i class="icon-fire bigger-110"></i>
                添加菜单
            </button>
            <button id="saveitem" type="button" class="btn btn-xs btn-info" style="float:right;">
                <i class="icon-fire bigger-110"></i>
                保存
            </button>
	       	<ul class="nav nav-tabs" id="myTab" style="width:50%;">
	            <li class="active">
	                <a data-toggle="tab" href="#home">
	                    <i class="green icon-home bigger-110"></i>
	                    DIY菜单
	                </a>
	            </li>
				<li style="margin-left:200px">

				</li>
				<li style="margin-left:450px">

				</li>
	        </ul>
	        <div class="tab-content">
	            <div id="home" class="tab-pane in active">
	                <div style="max-width:none" class="dd dd-list" id="nestable"><ol></ol></div>
	            </div>
	        </div>
	    </div>
	</div>
</div>

<div class="alert alert-info" style="margin-top:20px">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>
	<strong>
		发布：
	</strong>
	编辑中的菜单不能直接在用户手机上生效，你需要进行发布，发布后24小时内所有的用户都将更新到新的菜单。
	<br>
</div>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataTw', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
?>
<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit">
			<i class="icon-ok bigger-110"></i>
			发布
		</button>
		&nbsp; &nbsp; &nbsp;
		<button type="button" class="btn" id="previewbox">
			<i class="icon-undo bigger-110"></i>
			预览菜单
		</button>
		&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<font color="red">(提示：一切修改操作完成后，先点上面的保存按钮，然后再点击发布。)</font>
	</div>
</div>
<?php echo $this->Form->end(); ?>