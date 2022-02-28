<?php $__env->startSection('content'); ?>
<div class="container col-md-4">
	<?php if($errors->any()): ?>
	 <div class="alert alert-danger bg-danger">
	 	<ul>
	 		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	 		 <li><?php echo e($error); ?></li>
	 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	 	</ul>
	 </div>
	<?php endif; ?>

	<?php if(Session::has('success')): ?>
	 <div class="alert alert-success bg-success">
	 	<?php echo e(Session::get('success')); ?>

	 </div>
	<?php endif; ?>

	<?php if(Session::has('error')): ?>
	 <div class="alert alert-danger bg-danger">
	 	<?php echo e(Session::get('error')); ?>

	 </div>
	<?php endif; ?>
	<form method="post" action="<?php echo e(route('Sancofa.Books.ReservedBook',['id'=>$id])); ?>">
		<?php echo csrf_field(); ?>
		<div class="form-group" >
			<label for="sancofa_id">Enter Member Sancofa Id</label>
			<input type="text" name="sancofa_id" id="sancofa_id" class="form-control"  placeholder="sancofa id" autofocus="autofocus" required>
		</div>
		<button class="btn btn-primary" type="submit">Reserve</button>
	</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/reservebookinput.blade.php ENDPATH**/ ?>