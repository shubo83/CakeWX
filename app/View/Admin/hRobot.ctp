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
		<ul class="nav nav-tabs" id="myTab4">
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
					<a href="<?= "?_m={$key}" ?>">
						<?php if ($key == 'home'): ?>
							<i class="green icon-home bigger-110"></i>
						<?php endif ?>
						<?= $vals['name'] ?>
					</a>
				</li>
			<? endforeach ?>
		</ul>

		<div class="tab-content">
			<?php if ($WC_query['mod'] == 'follow'): ?>
				<div class="row col-xs-12" style="margin-bottom:15px">
					<button class="btn btn-sm btn-primary"  onclick="location.href='<?= "{$WC_URL}?_a=add" ?>'">
						<i class="icon-pencil align-top bigger-125"></i>
						添加问答
					</button>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive">
							<table id="sample-table-1" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>问答标题</th>
										<th>回复内容</th>
										<th>创建时间</th>
										<th>
											<i class="icon-time bigger-110 hidden-480"></i>
											操作
										</th>
									</tr>
								</thead>

								<tbody>
									<? if (is_array($data['datalist'])): ?>
										<? foreach ($data['datalist'] as $key => $vals): ?>
											<tr>
												<td>
													<p><?= $this->Html->image($vals['WxWebchat']['FIcon'], array('fullBase' => true, 'width' => "88px", 'alt' => "")); ?></p>
													<p><?= $vals['WxWebchat']['FName'] ?></p>
												</td>
												<td>
													免费版
												</td>
												<td class="hidden-480">
													<p>创建时间:<?= $vals['WxWebchat']['FCreatedate'] ?></p>
													<p>到期时间:<?= $vals['WxWebchat']['FCreatedate'] ?></p>
												</td>
												<td>
													<p>请求数剩余：不限制</p>
												</td>

												<td class="hidden-480">
													<span class="label label-info label-success">
														永久可用
													</span>
												</td>

												<td>
													<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

														<button class="btn btn-xs btn-info" onclick="parent.location.href='<?= Router::url(array('controller' => "admin", 'action' => "webchatEdit", $vals['WxWebchat']['Id'])) ?>'">
															<i class="icon-edit bigger-120"></i>
														</button>

														<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?= Router::url(array('controller' => "admin", 'action' => "webchatDel", $vals['WxWebchat']['Id'])) ?>">
															<i class="icon-trash bigger-120"></i>
														</button>

														<button class="btn btn-xs btn-warning" onclick="parent.location.href='<?= Router::url('/admin/wc/'.md5($vals['WxWebchat']['Id']).'/center'); ?>'">
															<i class="icon-wrench bigger-120"></i>
														</button>
													</div>
												</td>
											</tr>
										<? endforeach ?>
									<? endif ?>
								</tbody>
							</table>
						</div><!-- /.table-responsive -->
					</div>
				</div>
			<?php elseif ($WC_query['mod'] == 'mch'): ?>
				<div id="mch">
					这里是功能介绍。
				</div>
			<?php else: ?>	
				<div id="home" class="tab-pane active">
					<?php 
					$this->Form->inputDefaults(array('label' => true, 'div' => true));
					echo $this->Form->create('WxWcdata', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
					echo $this->Main->formhr_input('FSignText', array(
							'div' => "form-group", 
							'options' => array('0' => "启用", '1' => "禁用"),
							'label' => array('text' => "功能状态：", 'class' => "col-sm-3 control-label no-padding-right"), 
							'type' => "select", 
							'placeholder' => "", 
							'class' => "col-xs-10 col-sm-5",
							'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
							'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
						));
					echo $this->Main->formhr_input('FSignText', array(
							'div' => "form-group", 
							'label' => array('text' => "启动关键字：", 'class' => "col-sm-3 control-label no-padding-right"), 
							'type' => "text", 
							'placeholder' => "客服", 
							'class' => "col-xs-10 col-sm-5",
							'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
							'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
						));
					echo $this->Main->formhr_input('FSignText', array(
							'div' => "form-group", 
							'label' => array('text' => "使用内置词库：", 'class' => "col-sm-3 control-label no-padding-right"), 
							'type' => "text", 
							'placeholder' => "", 
							'class' => "col-xs-10 col-sm-5",
							'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
							'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
						));
					echo $this->Main->formhr_input('FSignText', array(
							'div' => "form-group", 
							'label' => array('text' => "自动退出（秒）：", 'class' => "col-sm-3 control-label no-padding-right"), 
							'type' => "text", 
							'placeholder' => "", 
							'class' => "col-xs-10 col-sm-5",
							'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
							'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
						));
					echo $this->Main->formhr_input('FSignText', array(
							'div' => "form-group", 
							'label' => array('text' => "进入欢迎语：", 'class' => "col-sm-3 control-label no-padding-right"), 
							'type' => "text", 
							'placeholder' => "", 
							'class' => "col-xs-10 col-sm-5",
							'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
							'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
						));
					echo $this->Main->formhr_input('FSignText', array(
							'div' => "form-group", 
							'label' => array('text' => "退出结束语：", 'class' => "col-sm-3 control-label no-padding-right"), 
							'type' => "text", 
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
			<?php endif ?>
		</div>
	</div>
</div>