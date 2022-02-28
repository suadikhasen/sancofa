<?php $month_name = app('App\Http\Controllers\Sancofa\Service\Activity'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="col-md-4">
		<?php if(!empty($month)): ?>
		 <ol>
		 	<?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		 	 <li>
		 	 	<a href="<?php echo e(route('Sancofa.Members.AllActivities.Month',['id'=>$id,'year'=>$year,'month'=>$single_month->month])); ?>" class="btn btn-primary btn-block"><?php echo e($month_name->monthName($single_month->month)); ?></a><br>
		 	 </li>
		 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 </ol>
		<?php else: ?>
		<?php endif; ?>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/activity/allactivityinmonth.blade.php ENDPATH**/ ?>