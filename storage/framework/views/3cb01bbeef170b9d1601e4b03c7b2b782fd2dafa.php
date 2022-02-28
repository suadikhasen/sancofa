<?php $__env->startSection('setting'); ?>
<?php if(Session::has('success')): ?>
 <div class="alert alert-success bg-success">
 	<?php echo e(Session::get('success')); ?>

 </div>
<?php endif; ?>
<?php if(isset($home_profile)): ?>
<div class="container">
	<div class="row my-2">
		<?php $__currentLoopData = $home_profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $home): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  <div class="col-md-5 mr-2">
			<div class="card bg-dark text-dark">
				<img src="<?php echo e(asset($home->profile)); ?>" class="card-img" alt="sancofa image">
				<div class="card-img-overlay">
					<h1 class="card-title"><?php echo e($home->tittle); ?></h1>
					<p class="card-text"><?php echo e($home->message); ?></p>
				</div>
			</div>
			<a href="<?php echo e(route('Sancofa.Setting.Repost',['id' => $home->id])); ?>" class="btn btn-success mt-1 mb-1">Repost</a>
         </div>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>
<?php else: ?>
 no old post
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/oldhomeprofile.blade.php ENDPATH**/ ?>