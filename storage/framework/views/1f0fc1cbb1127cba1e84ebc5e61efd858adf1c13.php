<?php $__env->startSection('setting'); ?>
 <div class="container my-4">
 	<a href="<?php echo e(route('Sancofa.Setting.DownloadAllMembers')); ?>" class="btn btn-block btn-primary">All Members</a>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/memberexport.blade.php ENDPATH**/ ?>