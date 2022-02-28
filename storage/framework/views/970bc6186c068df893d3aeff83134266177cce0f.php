<?php $__env->startSection('tittle','Updating  Member Data'); ?>
<?php $__env->startSection('content'); ?>
<?php if(!empty($user)): ?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
    	<?php if($errors->any()): ?>
    	<div class="alert alert-danger bg-danger">
    	<ul>
	    	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    	 <li><?php echo e($error); ?></li>
	    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </ul>
    	</div>
    	<?php endif; ?>
    	<?php if(Session::has('registration')): ?>
    	<div class="alert alert-success bg-success">
    		<?php echo e(Session::get('registration')); ?>

    	</div>
    	<?php endif; ?>
       <div class="card card-block">
          <div class="card-header bg-success">
            <h3>Edit Member Data</h3>
          </div>
          <div class="card-body">
            <form method="post" action="<?php echo e(route('Sancofa.Members.Update',['id'=>$user->sancofa_id])); ?>">
            	<?php echo csrf_field(); ?>
              <div class="form-group">
                <label for="full_name"><b>Full Name</b></label>
                <input type="text" name="full_name" id="full_name" placeholder="full name" required="required" autofocus="autofocus" class="form-control" value="<?php echo e($user->full_name); ?>">
              </div>

              <div class="form-group">
                <label for="phone_no"><b>Phone Number</b></label>
                <input type="string" name="phone_no" id="phone_no" placeholder="phone number" class="form-control" required="required" value="<?php echo e($user->phone_no); ?>">
              </div>
              <div class="form-group">
                <label for="univ_id"><b>University Id</b></label>
                <input type="text" name="univ_id" id="univ_id" placeholder="university id" class="form-control" required="required" value="<?php echo e($user->university_id); ?>" >
              </div>
             <div class="form-group">
             	<label for="sancofa_id"><b>Sancofa Id</b></label>
             	<input type="text" name="sancofa_id" id="sancofa_id" placeholder="sancofa id" required="required" class="form-control" value="<?php echo e($user->sancofa_id); ?>" disabled>
             </div>
             <div class="form-group">
             	<label for="dept"><b>Department</b></label>
             	<select class="form-control" id="dept" name="dept" >


                <option <?php if($user->department == "Anesthesia"): ?> selected <?php endif; ?>>Anesthesia</option>
                <option <?php if($user->department == "Environmental and Occupational Health and Safety  (Enva)"): ?> selected <?php endif; ?>>Environmental and Occupational Health and Safety  (Enva)</option>
                <option <?php if($user->department == "Health Informatics (HI)"): ?> selected <?php endif; ?>>Health Informatics (HI)</option>
                <option <?php if($user->department == "Health Officer (HO)"): ?> selected <?php endif; ?>>Health Officer (HO)</option>
                <option <?php if($user->department == "Biomedical and Laboratory Sciences (Lab)"): ?> selected <?php endif; ?>>Biomedical and Laboratory Sciences (Lab)</option>
                <option <?php if($user->department == "Midwifery"): ?> selected <?php endif; ?>>Midwifery</option>
                <option <?php if($user->department == "Medicine"): ?> selected <?php endif; ?>>Medicine</option>
                <option <?php if($user->department == "Nursing"): ?> selected <?php endif; ?>>Nursing</option>
                <option <?php if($user->department == "Optometry"): ?> selected <?php endif; ?>>Optometry</option>
                <option <?php if($user->department == "Physiotherapy (PT)"): ?> selected <?php endif; ?>>Physiotherapy (PT)</option>
                <option <?php if($user->department == "Pharmacy"): ?> selected <?php endif; ?>>Pharmacy</option>
                <option <?php if($user->department == "Psychiatry"): ?> selected <?php endif; ?>>Psychiatry</option>
                <option <?php if($user->department == "Staff"): ?> selected <?php endif; ?>>Staff</option>
                <option <?php if($user->department == "Others"): ?> selected <?php endif; ?>>Others</option>


                

             	</select>
             </div>

             <div class="form-group">
              <label for="gender"><b>Gender</b></label>
              <select class="form-control" name="gender" id="gender">
                <option <?php if($user->gender == "M"): ?> selected <?php endif; ?>>M</option>
                <option <?php if($user->gender == "F"): ?> selected <?php endif; ?>>F</option>
              </select>
             </div>
              <div class="form-group">
                <label for="address"><b>Address</b></label>
                <input type="string" name="address" id="address" placeholder="address of the user (optional)" class="form-control"  value="<?php echo e($user->address); ?>">
              </div>
              <div class="form-group">
                <label for="photo"><b>Photo Status</b></label>
                <select class="form-control" name="photo" id="photo">
                  <option <?php if($user->photo_status): ?> selected <?php endif; ?>>yes</option>
                  <option <?php if(!($user->photo_status)): ?> selected <?php endif; ?>>no</option>
                </select>
              </div>
              <div class="form-group">
                <label for="payment"><b>Registration Payment</b></label>
                <select class="form-control" name="payment" id="payment">
                  <option <?php if($user->payment_status): ?> selected <?php endif; ?>>yes</option>
                  <option <?php if(!($user->payment_status)): ?> selected <?php endif; ?>>no</option>
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
       </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/updatemember.blade.php ENDPATH**/ ?>