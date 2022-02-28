<?php $__env->startSection('setting'); ?>
 <div class="container">
 	<div class="col-md-6 mt-3">
	 	<div class="card" style="width:30rem;">
			<div class="card-header bg-info">
				<h3> Sancofa's Member Info</h3>
			</div>
			<div class="card-body card-block ">
				<div class="card-img card-img-top mb-3">
					<img src="<?php echo e(asset($sancofa_user->profile)); ?>" width="50rem;" height="50rem">
				</div>
				<p><b>full name:</b><span><?php echo e($sancofa_user->full_name); ?></span></p>
				<p><b>department:</b><span><?php echo e($sancofa_user->department); ?></span></p>
				<p><b>university id:</b><span><?php echo e($sancofa_user->university_id); ?></span></p>
				<p><b>sancofa id:</b><span><?php echo e($sancofa_user->sancofa_id); ?></span></p>
				<b>activation:
                  <?php if($sancofa_user->activation): ?>
                    active member
                  <?php else: ?>
                   not active
                  <?php endif; ?>

				</b>
			</div>
	    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/detailformember.blade.php ENDPATH**/ ?>