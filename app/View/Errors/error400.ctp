<?php
	$this->extend('/Common/Admin/user');
?>
<div class="col-xs-12">
	<!-- PAGE CONTENT BEGINS -->

	<div class="error-container">
		<div class="well">
			<h1 class="grey lighter smaller">
				<span class="blue bigger-125">
					<i class="icon-sitemap"></i>
					404
				</span>
				Page Not Found
			</h1>

			<hr>
			<!-- <h3 class="lighter smaller"></h3> -->

			<div>
				<div class="space"></div>
				<h4 class="smaller">Try one of the following:</h4>

				<ul class="list-unstyled spaced inline bigger-110 margin-15">
					<li>
						<i class="icon-hand-right blue"></i>
						Re-check the url for typos
					</li>

					<li>
						<i class="icon-hand-right blue"></i>
						Read the faq
					</li>

					<li>
						<i class="icon-hand-right blue"></i>
						Tell us about it
					</li>
				</ul>
			</div>

			<hr>
			<div class="space"></div>

			<div class="center">
				<a href="<?php echo Router::url('/'); ?>" class="btn btn-grey">
					<i class="icon-arrow-left"></i>
					返回
				</a>

				<a href="<?php echo Router::url('/admin'); ?>" class="btn btn-primary">
					<i class="icon-dashboard"></i>
					管理中心
				</a>
			</div>
		</div>
	</div><!-- PAGE CONTENT ENDS -->
</div>