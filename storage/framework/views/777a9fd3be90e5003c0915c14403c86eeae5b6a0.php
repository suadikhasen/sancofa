<?php $__env->startSection('setting'); ?>
<div class="container col-md-6 mt-3">
	<?php if(Session::has('success')): ?>
	  <div class="alert alert-success bg-success">
	  	  <?php echo e(Session::get('success')); ?>

	  </div>
	<?php endif; ?>

	<?php if($errors->any()): ?>
	 <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  <div class="alert alert-danger bg-danger">
	  	 <?php echo e($error); ?>

	  </div>
	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	<form method="post"  action="<?php echo e(route('Sancofa.Setting.CatagoryAdded')); ?>">
		<?php echo csrf_field(); ?>
		<div class="form-group">
			<label for="catagory"></label>
			<input type="text" name="catagory" class="form-control" required="required" autofocus="autofocus" placeholder="please insert caagory name" id="catagory">
		</div>
		<button class="btn btn-primary" type="submit">Add</button>
	</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/addcatagory.blade.php ENDPATH**/ ?>