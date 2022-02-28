<div class="card" style="width:30rem;">
	<div class="card-header bg-info">
		<h3> Sancofa's Member Info</h3>
	</div>
	<div class="card-body card-block ">
		<div class="card-img card-img-top mb-3">
			<img src="<?php echo e(asset($image)); ?>" width="50rem;" height="50rem">
		</div>
		<p><b>full name:</b><span><?php echo e($full_name); ?></span></p>
		<p><b>department:</b><span><?php echo e($department); ?></span></p>
		<p><b>university id:</b><span><?php echo e($univ_id); ?></span></p>
		<p><b>sancofa id:</b><span><?php echo e($sancofa_id); ?></span></p>
		<b>activation:<?php echo e($activation); ?></b>
	</div>
</div><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/includes/SancofaCard.blade.php ENDPATH**/ ?>