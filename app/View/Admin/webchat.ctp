<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
?>
<button class="btn btn-sm btn-primary"  onclick="location.href='<?= Router::url(array('controller' => "admin", 'action' => "webchatAdd")) ?>'">
	<i class="icon-plus align-top bigger-125"></i>
	添加公众账号
</button>

<div class="alert" style="margin-top:15px">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>
	<strong>温馨提示：</strong>
		您还有<?= $data['leavecount'] ?>个微信公众号配额，请珍惜使用名额！
	<br>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="sample-table-1" class="table table-striped table-bordered table-hover account">
				<thead>
					<tr>
						<th style="text-align:center;">公众号名称</th>
						<th>会员套餐</th>
						<th class="hidden-480">创建时间/到期时间</th>
						<th class="hidden-480">
							请求数
						</th>
						<th class="hidden-480">状态</th>
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
								<td style="text-align:center;">
									<?= $this->Html->image($vals['WxWebchat']['FIcon'], array('fullBase' => true, 'width' => "100px", 'alt' => "")); ?>
									<p class="mtm"><?= $vals['WxWebchat']['FName'] ?></p>
								</td>
								<td>
									免费版
								</td>
								<td class="hidden-480">
									<p>创建时间:<?= date('Y-m-d', strtotime($vals['WxWebchat']['FCreatedate'])) ?></p>
									<p>到期时间:<?= date('Y-m-d', strtotime('2200-4-15')) ?></p>
								</td>
								<td>
									<p>请求数剩余：不限制</p>
								</td>

								<td class="hidden-480">
									<span class="label label-info label-success">
										永久可用
									</span>
								</td>

								<td class="wc_actions">
                                    <button class="e_btn1" onclick="parent.location.href='<?= Router::url(array('controller' => "admin", 'action' => "webchatEdit", $vals['WxWebchat']['Id'])) ?>'">
                                        <i class="icon-edit bigger-120"></i>编辑
                                    </button>

                                    <button class="e_btn1 mtm bootbox-confirm" alt="<?= Router::url(array('controller' => "admin", 'action' => "webchatDel", $vals['WxWebchat']['Id'])) ?>">
                                        <i class="icon-trash bigger-120"></i>删除
                                    </button>

                                    <button class="e_btn1 mtm" onclick="parent.location.href='<?= Router::url('/admin/wc/'.md5($vals['WxWebchat']['Id']).'/center'); ?>'">
                                        <i class="icon-cogs bigger-120"></i>管理
                                    </button>
								</td>
							</tr>
						<? endforeach ?>
					<? endif ?>
				</tbody>
			</table>
			<ul class='pagination' style="margin-top:0">
				<?php 
					echo $this->Paginator->hasPrev() ? $this->Paginator->prev(
					  '« 上一页',
					  array('tag' => "li"),
					  null,
					  array('class' => 'disabled', 'tag' => "li", 'disabledTag' => "a")
					) : '';
					echo $this->Paginator->numbers(array('tag' => "li", 'separator' => "", 'currentClass' => "active", 'currentTag' => "a"));
				
					// Shows the next and previous links
					echo $this->Paginator->hasNext() ? $this->Paginator->next(
					  '下一页 »',
					  array('tag' => "li"),
					  null,
					  array('class' => 'disabled', 'tag' => "li", 'disabledTag' => "a")
					) : '';
				 ?>
			 </ul>
		</div><!-- /.table-responsive -->
	</div>
</div>