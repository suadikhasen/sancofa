<?php $__env->startSection('content'); ?>
 <div class=" mt-3 col-md-4">
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
	<form method="post" action="<?php echo e(route('Sancofa.Others.MemberAddingToMonthlyPayment',['year' => $year])); ?>">
		<?php echo csrf_field(); ?>
		<div class="form-group">
			<label for="sancofa_id"><b>Enter Sancofa Id</b></label>
			<input type="text" name="sancofa_id" placeholder="enter sancofa id " class="form-control" required autofocus>
			
		</div>
		<button type="submit" class="btn btn-primary">Add</button>
	</form>

 </div>
 <a href="<?php echo e(route('Sancofa.Others.MonthlyPaymentYear',['year' => $year])); ?>" class="btn btn-success btn-block mt-3">Return To Payment Page</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/others/addmemberstopayment.blade.php ENDPATH**/ ?>