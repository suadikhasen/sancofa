<?php $__env->startSection('setting'); ?>
<div class="container mt-5">
	<ul>
		<li>current amount of fine <?php echo e('  '.$fine->amount.'  '); ?> <a href="<?php echo e(route('Sancofa.Setting.ChangePayment',['id' => $fine->reason])); ?>"  class="btn btn-primary btn-sm">change</a></li>
		<li>current amount of registration payment <?php echo e('  '.$registration->amount.' '); ?> <a href="<?php echo e(route('Sancofa.Setting.ChangePayment',['id' => $registration->reason])); ?>"  class="btn btn-primary btn-sm">change</a></li>
	</ul>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/charge.blade.php ENDPATH**/ ?>