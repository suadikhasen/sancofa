<?php $forgotpassword = app('App\Http\Controllers\Sancofa\Service\ForgotPassword'); ?>

<?php $__env->startSection('tittle'); ?>
   <?php if(Route::currentRouteName() == 'Sancofa.Profile.Show'): ?>
    profile
   
   <?php elseif(Route::currentRouteName() == 'Sancofa.Profile.ChangePassword'): ?>
     Changing Password 
   <?php elseif(Route::currentRouteName() == 'Sancofa.ActiveMembers.Find'): ?>
     member Activation   
   <?php elseif(Route::currentRouteName() == 'Sancofa.Profile.ChangeProfilePicture'): ?>
    Changing Profile Picture
   <?php endif; ?>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
 <div class="alert alert-danger bg-danger">
 	<ul>
 		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 		  <li><?php echo e($error); ?></li>
 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 	</ul>
 </div>
<?php endif; ?>
<?php if(Session::has('active')): ?>
<div class="alert alert-success bg-success">
	<?php echo e(Session::get('active')); ?>

</div>
<?php endif; ?>

<?php if(Session::has('password_changed')): ?>
<div class="alert alert-success bg-success">
	<?php echo e(Session::get('password_changed')); ?>

</div>
<?php endif; ?>

<?php if(Session::has('password_error')): ?>
 <div class="alert alert-danger bg-danger">
 	<?php echo e(Session::get('password_error')); ?>

 </div>
<?php endif; ?>
<?php if(!empty($user)): ?>
<div class="row">
	<div class="col-md-6">
		<?php $__env->startComponent('sancofa.includes.SancofaCard'); ?>
				 <?php $__env->slot('image'); ?>
				  <?php echo e($user->profile); ?>

				 <?php $__env->endSlot(); ?>
				 <?php $__env->slot('full_name'); ?>
				   <?php echo e($user->full_name); ?>

				 <?php $__env->endSlot(); ?>

				 <?php $__env->slot('department'); ?>
				  <?php echo e($user->department); ?>

				 <?php $__env->endSlot(); ?>

				 <?php $__env->slot('univ_id'); ?>
				  <?php echo e($user->university_id); ?>

				 <?php $__env->endSlot(); ?>

				 <?php $__env->slot('sancofa_id'); ?>
				  <?php echo e($user->sancofa_id); ?>

				 <?php $__env->endSlot(); ?>
				 <?php $__env->slot('activation'); ?>
				  <?php if($user->activation): ?>
				   activated
				   <?php else: ?>
				    not active
				  <?php endif; ?>

				 <?php $__env->endSlot(); ?>
		<?php if (isset($__componentOriginal98e432532134969f517987a37240ac637c9835b0)): ?>
<?php $component = $__componentOriginal98e432532134969f517987a37240ac637c9835b0; ?>
<?php unset($__componentOriginal98e432532134969f517987a37240ac637c9835b0); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
	</div>
	<div class="col-md-5">
	<?php if(Route::currentRouteName() == 'Sancofa.ActiveMembers.Find' && !($user->activation)): ?>
       
       	  <form method="post" action="<?php echo e(route('Sancofa.ActiveMembers.Active',['id'=>$user->sancofa_id])); ?>">
       	  	<?php echo csrf_field(); ?>
       	  	 <div class="form-group">
       	  	 	<label for="password">password:</label>
       	  	 	<input type="password" name="password" required="required" placeholder="password" autofocus="autofocus" id="password" class="form-control">
       	  	 </div>

       	  	 <div class="form-group">
       	  	 	<label for="re_password">repeat password</label>
       	  	 	<input type="password" name="password_confirmation" id="re_password" placeholder="repeat password" required  class="form-control">
       	  	 </div>
       	  	 <button class="btn btn-primary" type="submit">active</button>
       	  </form>
       
    <?php endif; ?>

    <?php if(Route::currentRouteName() == 'Sancofa.Profile.Show'): ?>
      
      	 <a href="<?php echo e(route('Sancofa.Profile.ChangePassword')); ?>" class="btn btn-block btn-success">change password</a>
      	 <a href="<?php echo e(route('Sancofa.Profile.ChangeProfilePicture')); ?>" class="btn btn-block btn-primary">change profile Picture</a>
         <?php if($forgotpassword->check(Auth::guard('sancofa')->user()->sancofa_id)): ?>
          <a href="<?php echo e(route('Sancofa.Profile.UpdatePasswordQuestion')); ?>" class="btn btn-block btn-success">Update Password Question</a>
         <?php else: ?>
            <a href="<?php echo e(route('Sancofa.Profile.FillPasswordQuestion')); ?>" class="btn btn-block btn-danger">please Fill Password Question</a>
         <?php endif; ?>
         <?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
            <a href="<?php echo e(route('Sancofa.Profile.TransferAdminAccount')); ?>">transfer admin account</a>
         <?php endif; ?>
    <?php endif; ?>

    <?php if(Route::currentRouteName() == 'Sancofa.Profile.ChangeProfilePicture'): ?>
       <form method="post" action="<?php echo e(route('Sancofa.Profile.UploadProfilePicture')); ?>" enctype="multipart/form-data">
       	<?php echo csrf_field(); ?>
       	 <div class="form-group">
       	 	<label for="profile_picture">Profile Picture</label>
       	 	<input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
       	 </div>
       	 <button class="btn btn-secondary" type="submit">Upload</button>
       </form>
    <?php endif; ?>

    <?php if(Route::currentRouteName() == 'Sancofa.Profile.ChangePassword'): ?>
       <form method="post" action="<?php echo e(route('Sancofa.Profile.PasswordChanged')); ?>">
       	  	<?php echo csrf_field(); ?>
       	  	 <div class="form-group">
       	  	 	<label for="current_password">current password:</label>
       	  	 	<input type="password" name="current_password" required="required" placeholder="current password" autofocus="autofocus" id="current_password" class="form-control">
       	  	 </div>

       	  	 <div class="form-group">
       	  	 	<label for="new_password">new password</label>
       	  	 	<input type="password" name="new_password" id="new_password" placeholder="new password" required  class="form-control">
       	  	 </div>

       	  	 <div class="form-group">
       	  	 	<label for="new_password_confirmation">repeat new password</label>
       	  	 	<input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="repeat new password" required  class="form-control">
       	  	 </div>
       	  	 <button class="btn btn-primary" type="submit">Change</button>
       	</form>
    <?php endif; ?>
 </div>
</div>
<?php endif; ?>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/super/Documents/projects/Sankofa/resources/views/sancofa/member/memberinfo.blade.php ENDPATH**/ ?>