<?php $__env->startSection('content'); ?>
<?php if(!empty($years) && count($years) >0): ?>
<ol>
	<?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li><a href="<?php echo e(route('Sancofa.Others.MonthlyPaymentYear',['year'=>$year->year])); ?>" class="btn btn-success" target="_blank"><?php echo e($year->year); ?></a></li><br>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php endif; ?>
<?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
<a class="btn btn-primary btn-block" href="<?php echo e(route('Sancofa.Others.CreateMonthlyPayment')); ?>">
Create New Monthly Payment
</a>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/super/Documents/projects/Sankofa/resources/views/sancofa/others/monthlypaymentindex.blade.php ENDPATH**/ ?>