<?php $__env->startSection('setting'); ?>
 <div class="container col-md-6 mt-3">
 	<?php if(Session::has('success')): ?>
 	 <div class="alert alert-success">
 	 	<?php echo e(Session::get('success')); ?>

 	 </div>
 	<?php endif; ?>
 	<?php if(!empty($catagory)): ?>
 	<ol>
 		<?php $__currentLoopData = $catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 		 <li>
 		 	<?php echo e($single->name); ?>

 		 	<a href="<?php echo e(route('Sancofa.Setting.ShowRenameIndex',['id' => $single->id])); ?>">Rename</a>
 		 	<a href="<?php echo e(route('Sancofa.Setting.DeleteCatagory',['id' => $single->id])); ?>">Delete</a>
 		 </li>
 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 	</ol>
 	<?php endif; ?>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/allcatagory.blade.php ENDPATH**/ ?>