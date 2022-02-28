<?php $__env->startSection('tittle','List Of Years For Rank'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<?php if(!empty($rank)): ?>
	 <ul>
	 	<?php $__currentLoopData = $rank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	 	<li><a href="<?php echo e(route('Sancofa.ListOfRank',['id' => $year->year])); ?>"><?php echo e($year->year); ?></a></li>
	 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	 </ul>
	 <?php else: ?>
	 no rank now
	<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/yearofrank.blade.php ENDPATH**/ ?>