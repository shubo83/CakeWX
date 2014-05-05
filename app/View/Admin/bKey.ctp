<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
?>
<div class="row col-xs-12" style="margin-bottom:15px">
	<button class="btn btn-sm btn-primary"  onclick="location.href='<?= "{$WC_URL}?_a=add" ?>'">
		<i class="icon-pencil align-top bigger-125"></i>
		添加关键字
	</button>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>关键字</th>
						<th>回复类型</th>
						<th>匹配类型</th>
						<th>创建时间</th>
						<th>更新时间</th>
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
									<p><?= $vals['WxDataKds']['FKey'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataKds']['C_FType'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataKds']['M_FType'] ?></p>
								</td>
								<td class="hidden-480">
									<p><?= $vals['WxDataKds']['FCreatedate'] ?></p>
									
								</td>
								<td>
									<p><?= $vals['WxDataKds']['FUpdatedate'] ?></p>
								</td>

								<td>
									<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

										<button class="btn btn-xs btn-info" onclick="parent.location.href='<?= "{$WC_URL}?_a=edit&_id={$vals['WxDataKds']['Id']}" ?>'">
											<i class="icon-edit bigger-120"></i>
										</button>

										<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?= "{$WC_URL}?_a=del&_id={$vals['WxDataKds']['Id']}" ?>">
											<i class="icon-trash bigger-120"></i>
										</button>
									</div>
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