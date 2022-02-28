<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="col-md-6">
		<?php if(Session::has('fail')): ?>
		 <div class="alert alert-danger bg-danger">
		 	<?php echo e(Session::get('fail')); ?>

		 </div>
		<?php endif; ?>

		<?php if(Session::has('success')): ?>
		 <div class="alert alert-success bg-success">
		 	<?php echo e(Session::get('success')); ?>

		 </div>
		<?php endif; ?>
        
        <?php if($errors->any()): ?>
	        <ul class="alert alert-danger bg-danger"> 
	        	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	        	  <li><?php echo e($error); ?></li>
	        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </ul>
        <?php endif; ?>

		<form method="post" action="<?php echo e(route('Sancofa.Others.MonthlyPaymentCreating')); ?>">
			<?php echo csrf_field(); ?>
			<div class="form-group">
				<label for="year">Enter Ethiopian Year</label>
				<input type="number" name="year" id="year" autofocus class="form-control" required >
			</div>
            <div class="form-group">
				<label for="amount">Enter Montly Payment Amount</label>
				<input type="number" name="amount" id="amount" class="form-control" required>
			</div>
			<button type="submit" class="btn btn-primary">create</button>
		</form>
		
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/others/createmonthlypayment.blade.php ENDPATH**/ ?>