<?php $__env->startSection('setting'); ?>
<div class="container col-md-4 mt-2">
	<a href="<?php echo e(route('Sancofa.Setting.BookExportLink')); ?>" class="btn btn-block btn-primary">books</a>
	<a href="<?php echo e(route('Sancofa.Setting.MemberExportLink')); ?>" class="btn btn-block btn-success">members</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/export.blade.php ENDPATH**/ ?>