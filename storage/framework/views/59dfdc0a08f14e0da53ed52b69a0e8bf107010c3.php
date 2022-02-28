<?php $__env->startSection('tittle','change password for active members'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php if(Session::has('changed')): ?>
			 <div class="alert alert-success bg-success">
			 	 <?php echo e(Session::get('changed')); ?>

			 </div>
			<?php endif; ?>

			<?php if($errors->any()): ?>
				 <div class="alert alert-danger">
				 	<ul>
				 		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 		 <li><?php echo e($error); ?></li>
				 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 	</ul>
				 </div>
			<?php endif; ?>
			<form method="post" action="<?php echo e(route('Sancofa.ActiveMembers.PasswordChanged',['id' => $id])); ?>">
				<?php echo csrf_field(); ?>
			    <div class="form-group">
	       	  	 	<label for="new_password">new password</label>
	       	  	 	<input type="password" name="new_password" id="new_password" placeholder="new password" required  class="form-control" autofocus>
	       	  	 </div>

	       	  	 <div class="form-group">
	       	  	 	<label for="new_password_confirmation">repeat new password</label>
	       	  	 	<input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="repeat new password" required  class="form-control">
	       	  	 </div>
	       	  	 <button class="btn btn-primary" type="submit">Change</button>
		    </form> 
		</div>
	</div>
    


	
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/changepasswordforactive.blade.php ENDPATH**/ ?>