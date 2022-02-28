<?php $__env->startSection('setting'); ?>
<div class="container my-5">
 	<div class="row">
	 	<div class="col-md-5 ">
	 	   <?php if(isset($Home_Profile)): ?>		
			<div class="card bg-dark text-white">
				<img src="<?php echo e(asset($Home_Profile->profile)); ?>" class="card-img" alt="sancofa image">
				<div class="card-img-overlay">
					<h1 class="card-title"><?php echo e($Home_Profile->tittle); ?></h1>
					<p class="card-text"><?php echo e($Home_Profile->message); ?></p>
				</div>
			</div>
			<?php endif; ?>
        </div>

        <div class="col-md-5">
        	<a href="<?php echo e(route('Sancofa.Setting.AddProfile')); ?>" class="btn btn-block btn-primary">Change</a>
        	<a href="<?php echo e(route('Sancofa.Setting.OldHomeProfile')); ?>" class="btn btn-block btn-success">Old Profiles</a>
        </div>
    </div> 	
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/index.blade.php ENDPATH**/ ?>