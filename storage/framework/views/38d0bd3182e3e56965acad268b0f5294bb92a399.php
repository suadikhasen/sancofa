<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php if(Session::has('error')): ?>
			 <div class="alert alert-danger bg-danger">
			 	<?php echo e(Session::get('error')); ?>

			 </div>
			<?php endif; ?>

			<?php if(Session::has('success')): ?>
			 <div class="alert alert-success bg-success">
			 	<?php echo e(Session::get('success')); ?>

			 </div>
			<?php endif; ?>

			<?php if($errors->any()): ?>
			  <ul class="alert alert-danger bg-danger text-dark">
			  	  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  	    <li><?php echo e($error); ?></li>
			  	  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  </ul> 
			<?php endif; ?>
		   <div class="card">
			  <div class="card-header bg-secondary text-white card-block">
			  	 <?php echo e('count '.$count->id); ?>

			  	 <?php if(!$count->close_status): ?>
			  	   <a class="btn  btn-outline-success text-white float-right" href="<?php echo e(route('Sancofa.Books.CountBooks.Finish',['id'=>$count->id])); ?>">Finish</a>
			  	 <?php endif; ?>
			  </div>
			  <div class="card-body">
			  	 <a href="<?php echo e(route('Sancofa.Books.CountBooks.ListOfCountedBook',['id'=>$count->id])); ?>" class="btn btn-block btn-success ">Counted Books<span class="badge badge-info"><?php echo e($counted_books); ?></span></a>
			  	 <a href="<?php echo e(route('Sancofa.Books.CountBooks.ListOfUnCountedBooks',['id'=>$count->id])); ?>" class="btn btn-block btn-info ">Un Counted Books<span class="badge badge-danger"><?php echo e($un_counted_books); ?></span></a>
			  	 <hr>
                 <?php if(!$count->close_status): ?>
                   <form method="post" action="<?php echo e(route('Sancofa.Books.CountBooks.Count',['id'=>$count->id])); ?>">
                   	   <?php echo csrf_field(); ?>
                   	   <div class="form-group">
                   	   	  <label for="book_id">Enter Book Acc Number</label>
                   	   	  <input type="text" name="book_id" id="book_id" required value="acc-" class="form-control" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                   	   </div>
                   	   <button class="btn btn-primary mb-1" type="submit">count</button>
                   </form>
                 <?php endif; ?>
			  </div>
		   </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/count/countpage.blade.php ENDPATH**/ ?>