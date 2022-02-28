<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password Question</title>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body>
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
	<?php if(!empty($questions)): ?>
	<div class="card card-block w-75 mt-2 ml-5">
		<div class="card-header bg-secondary">Forgot Password Question</div>
		<div class="card-body">
			<form method="post" action="<?php echo e(route('Sancofa.CheckForgotPassword')); ?>">
				<?php echo csrf_field(); ?>
			<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="form-group">
               	 <label for="q<?php echo e($question->id); ?>"><?php echo e($question->question); ?></label>
               	 <input type="text" name="q<?php echo e($question->id); ?>" id="q<?php echo e($question->id); ?>" class="form-control"  placeholder="your answer" required autofocus value="<?php echo e(old('q'."$question")); ?>">
               </div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<div class="form-group">
	               	 <label for="sancofa_id">Sancofa Id</label>
	               	 <input type="text" name="sancofa_id" id="sancofa_id" class="form-control" placeholder="your answer" required autofocus value="<?php echo e(old('sancofa_id')); ?>">
	            </div>

	            <div class="form-group">
	               	 <label for="new_password">new password</label>
	               	 <input type="password" name="new_password" id="new_password" class="form-control" placeholder="your answer" required autofocus >
	            </div>

	            <div class="form-group">
	               	 <label for="new_password_confirmation">Repeat new Password</label>
	               	 <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="your answer" required autofocus>
	            </div>
			 <button class="btn btn-primary">Reset</button>
			</form>
		</div>
	</div>
	<?php endif; ?>
 <script type="text/javascript" src="<?php echo e('js/app.js'); ?>"></script> 
</body>
</html><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/forgotpasswordquestion.blade.php ENDPATH**/ ?>