<?php if(session('success_msg')) : ?>
<div class="col-md-12">
	<div class="alert alert-success">
		<?=session('success_msg')?>
	</div>
</div>
<?php endif ?>