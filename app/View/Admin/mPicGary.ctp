<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat",
		"Action/twPreview",
	), array('block' => "script_extra", 'inline' => false));
?>
<div style="margin-bottom:15px">
	<button class="btn btn-sm btn-primary"  onclick="location.href='<?= "{$WC_URL}?_a=add" ?>'">
		<i class="icon-pencil align-top bigger-125"></i>
		添加图文集
	</button>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>图文集名称</th>
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
									<?= $vals['WxDataTw']['FTitle'] ?>
								</td>
								<td class="hidden-480">
									<p><?= $vals['WxDataTw']['FCreatedate'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataTw']['FUpdatedate'] ?></p>
								</td>

								<td>
									<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

										<button class="btn btn-xs btn-info" onclick="parent.location.href='<?php echo "{$WC_URL}?_a=edit&_id={$vals['WxDataTw']['Id']}" ?>'">
											<i class="icon-edit bigger-120"></i>
										</button>

										<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?php echo "{$WC_URL}?_a=del&_id={$vals['WxDataTw']['Id']}" ?>">
											<i class="icon-trash bigger-120"></i>
										</button>
										
										<!--<button class="btn btn-xs btn-warning twPreview" id="<?php echo $vals['WxDataTw']['Id'] ?>">
											<i class="icon-search bigger-120"></i>
										</button>!-->
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