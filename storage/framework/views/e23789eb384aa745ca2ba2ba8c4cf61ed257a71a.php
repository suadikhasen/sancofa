<?php $__env->startSection('tittle','Sankofa Librarian Home'); ?>
<?php $__env->startSection('content'); ?>
<div class=" col-md-12">
	<div class="card bg-dark text-dark text-center">
		<img src="<?php echo e(asset($Home_Profile->profile)); ?>" class="card-img" alt="sancofa image">
		<div class="card-img-overlay ">
			<h1 class="card-title text-uppercase"><?php echo e($Home_Profile->tittle); ?></h1>
			<p class="card-text"><?php echo e($Home_Profile->message); ?></p>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.8-0/apache2/htdocs/Sankofa/resources/views/home.blade.php ENDPATH**/ ?>