<?php $__env->startSection('tittle','checking borrowing books'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<?php if($errors->any()): ?>
	 <div class="alert alert-danger bg-danger">
	 	<ul>
		 <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		 <li><?php echo e($error); ?></li>
		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<?php endif; ?>

	<?php if(Session::has('already_borrowed')): ?>
	 <div class="alert alert-danger bg-danger">
	 	<?php echo e(Session::get('already_borrowed')); ?>

	 </div>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-7">
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

		<div class="col-md-4">
			<div class="form-group">
				<form method="get" action="<?php echo e(route('Sancofa.Books.Borrowed',[
				'reciever_id'=>$user->sancofa_id])); ?>">
				     <?php echo csrf_field(); ?>
					<label for="book_id">Enter Book Id</label>
					<input type="text" name="book_id" id="book_id"  placeholder="enter book id" class="form-control" required autofocus value="acc-"   onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"><br>
					<button class="btn btn-success" type="submit">Give</button>
				</form>
			</div>
		</div>
	</div>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/super/Documents/projects/Sankofa/resources/views/sancofa/books/borrowings2.blade.php ENDPATH**/ ?>