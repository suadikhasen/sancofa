<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="col-md-4">
		<?php if(!empty($year)): ?>
		 <ol>
		 	<?php $__currentLoopData = $year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		 	 <li><a href="<?php echo e(route('Sancofa.Members.AllActivities.Year',['id'=>$id,'year'=>$single_year->year])); ?>" class="btn btn-primary btn-block"><?php echo e($single_year->year); ?></a><br></li>
		 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 </ol>
		<?php else: ?>
		<?php endif; ?>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/activity/allactivityinyear.blade.php ENDPATH**/ ?>