<?php $__env->startSection('tittle','Adding New Member'); ?>
<?php $__env->startSection('content'); ?>
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
    		<?php echo e(Session::get('registration').' '.Session::get('approve_key')); ?>

    	</div>
    	<?php endif; ?>
       <div class="card card-block">
          <div class="card-header bg-success">
            <h3>Add New Member</h3>
          </div>
          <div class="card-body">
            <form method="post" action="<?php echo e(route('Sancofa.Members.Added')); ?>">
            	<?php echo csrf_field(); ?>

             <div class="form-group">
             	<label for="sancofa_id"><b>Sancofa Id</b></label>
             	<input type="text" name="sancofa_id" id="sancofa_id" placeholder="sancofa id" required="required" class="form-control" value="<?php if(!empty($next_id)): ?><?php echo e($next_id); ?> <?php endif; ?>">
             </div>
              <div class="form-group">
                <label for="full_name"><b>Full Name</b></label>
                <input type="text" name="full_name" id="full_name" placeholder="full name" required="required" autofocus="autofocus" class="form-control" value="<?php echo e(old('full_name')); ?>">
              </div>

              <div class="form-group">
                <label for="phone_no"><b>Phone Number</b></label>
                <input type="string" name="phone_no" id="phone_no" placeholder="phone number" class="form-control" required="required" value="<?php echo e(old('phone_no')); ?>">
              </div>
              <div class="form-group">
                <label for="univ_id"><b>university id</b></label>
                <input type="text" name="univ_id" id="univ_id" placeholder="university id" class="form-control" required="required" value="<?php echo e(old('univ_id')); ?>">
              </div>
             

             <div class="form-group">
             	<label for="dept"><b>Department</b></label>
             	<select class="form-control" id="dept" name="dept">
             		<option>Anesthesia</option>
             		<option>Environmental and Occupational Health and Safety  (Enva)</option>
             		<option>Health Informatics (HI)</option>
                <option>Health Officer (HO)</option>
                <option>Biomedical and Laboratory Sciences (Lab)</option>
                <option>Midwifery</option>
                <option>Medicine</option>
                <option>Nursing</option>
                <option>Optometry</option>
                <option>Physiotherapy (PT)</option>
                <option>Pharmacy</option>
                <option>Psychiatry</option>
                <option>Staff</option>
                <option>Others</option>
             	</select>
             </div>
             
             <div class="form-group">
              <label for="gender"><b>gender</b></label>
              <select class="form-control" name="gender" id="gender">
                <option>M</option>
                <option>F</option>
              </select>
             </div>
              <div class="form-group">
                <label for="address"><b>Address</b></label>
                <input type="string" name="address" id="address" placeholder="address of the user (optional)" class="form-control"  value="<?php echo e(old('address')); ?>">
              </div>
              <div class="form-group">
                <label for="photo"><b>photo status</b></label>
                <select class="form-control" name="photo" id="photo">
                  <option>yes</option>
                  <option>no</option>
                </select>
              </div>
              <div class="form-group">
                <label for="payment"><b>registration payment</b></label>
                <select class="form-control" name="payment" id="payment">
                  <option>yes</option>
                  <option>no</option>
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Add</button>
            </form>
          </div>
       </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/super/Documents/projects/Sankofa/resources/views/sancofa/member/add.blade.php ENDPATH**/ ?>