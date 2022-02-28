<?php $__env->startSection('tittle','add active members'); ?>
<?php $__env->startSection('content'); ?>
 <div class="container">
 	<div class="row">
 		<div class="col-md-6">
 			<?php if($errors->any()): ?>
 			  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 			   <div class="alert alert-danger">
 			   	 <?php echo e($error); ?>

 			   </div>
 			  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 			<?php endif; ?>
 			<form method="get" action="<?php echo e(route('Sancofa.ActiveMembers.Find')); ?>">
 				<?php echo csrf_field(); ?>
 				<div class="form-group form-inline ">
 					<input type="text" name="sancofa_id" id="sancofa_id" class="form-control mr-2" required="required" autofocus="autofocus" placeholder="sancofa id">
 					<button class="btn btn-success" type="submit">find</button>
 				</div>
 			</form>
 		</div>
 	</div>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/super/Documents/projects/Sankofa/resources/views/sancofa/member/checkforactive.blade.php ENDPATH**/ ?>