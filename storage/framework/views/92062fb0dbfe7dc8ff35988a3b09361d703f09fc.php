<?php $__env->startSection('tittle','borrowing book'); ?>
<?php $__env->startSection('content'); ?>
<?php if(Session::has('check')): ?>
<div class="col-md-5 alert alert-danger bg-danger">
	<?php echo e(Session::get('check')); ?>

</div>
<?php endif; ?>
<?php if($errors->any()): ?>
<div class="alert alert-danger bg-danger col-md-4">
<ul>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
<?php endif; ?>
<form method="get" action="<?php echo e(route('Sancofa.Books.CheckBorrowing')); ?>">
	<?php echo csrf_field(); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="sancofa_id">please insert sancofa id</label>
				<input type="text" name="sancofa_id" id="sancofa_id" placeholder="sancofa id" autofocus required  class="form-control" value="<?php echo e(old('sancofa_id')); ?>"><br>
				<button class="btn btn-success" type="submit">check</button>
		   </div>
		</div>
	</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/borrowings1.blade.php ENDPATH**/ ?>