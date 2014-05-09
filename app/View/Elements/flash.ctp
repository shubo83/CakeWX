<?php
	$tips['type'] = isset($tipsType) ? $tipsType : "success";
?>
<div class="page_tips <?php echo $tips['type'] ?>">
	<?php if ($message): ?>
		<div class="inner"><?php echo h($message); ?></div>
	<?php endif ?>
</div>