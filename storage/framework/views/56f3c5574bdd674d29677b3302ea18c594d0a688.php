<?php $__env->startSection('setting'); ?>
<div class="container">
	<?php if(Session::has('success')): ?>
		 <div class="alert alert-success bg-success">
		 	<?php echo e(Session::get('success')); ?>

		 </div>
	<?php endif; ?>
	<div class="row my-4">
		<div class="col-md-5">
			<form method="post" action="<?php echo e(route('Sancofa.Setting.ChangeProfile')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>
				<div class="form-group">
					<label for="tittle"><b>Tittle</b></label>
					<textarea type="text" name="tittle" id="tittle" class="form-control" required autofocus cols="5"> </textarea> 
				</div>

				<div class="form-group">
					<label for="message"><b>small text message</b></label>
					<textarea id="message" name="message" class="form-control" required autofocus cols="5"></textarea>
				</div>

				<div class="form-group">
					<label for="profile"><b>Profile Image</b></label>
					<input type="file" name="profile" class="form-control-file" required id="profile">
				</div>
				<button class="btn btn-primary btn-block" type="submit">Add</button>
			</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/addprofile.blade.php ENDPATH**/ ?>