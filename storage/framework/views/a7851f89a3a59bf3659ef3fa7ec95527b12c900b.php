<?php $__env->startSection('tittle','adding address'); ?>
<?php $__env->startSection('content'); ?>
 <div class="container">
 	<div class="row">
 		<div class="col-md-6">
 			<?php if(Session::has('address')): ?>
 			 <div class="alert alert-success">
 			 	<?php echo e(Session::get('address')); ?>

 			 </div>
 			<?php endif; ?>

 			<form method="post" action="<?php echo e(route('Sancofa.Members.SubmitAddress',['id' => $id])); ?>">
 				<?php echo csrf_field(); ?>
 				<div class="form-group">
 					<label for="address">address</label>
 					<input type="text" name="address" placeholder="address" required="required" class="form-control" autofocus value="ch-  dorm-" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
 				</div>
 				<button class="btn btn-primary" type="submit">Save</button>
 			</form>
 		</div>
 	</div>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/address.blade.php ENDPATH**/ ?>