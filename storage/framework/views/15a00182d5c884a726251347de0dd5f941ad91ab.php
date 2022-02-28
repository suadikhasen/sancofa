<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="col-md-6">
		<?php if(Session::has('count')): ?>
		  <div class="alert alert-danger">
		  	 <?php echo e(Session::get('count')); ?>

		  </div>
		<?php endif; ?>

		<?php if(Session::has('message')): ?>
		  <div class="alert alert-success bg-success">
		  	 <?php echo e(Session::get('message')); ?>

		  </div>
		<?php endif; ?>

		<a class="btn btn-block btn-success mb-3" href="<?php echo e(route('Sancofa.Books.CountBooks.Create')); ?>">Create New Book Counting</a>
		<?php if(isset($count_books)): ?>
		  <table class="table table-bordered table-hover table-secondary">
		  	 <thead class="bg-info text-white">
		  	 	<tr>
		  	 		<th scope="col">#</th>
		  	 		<th scope="col">count name</th>
		  	 		<th scope="col"> status</th>
		  	 		<th scope="col">starting date</th>
		  	 		<th scope="col">End Date</th>
		  	 		<th scope="col">Detail</th>
		  	 	</tr>
		  	 </thead>
		  	 <tbody>
		  	 	<?php $__currentLoopData = $count_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  	 	  <tr>
		  	 	  	<td><?php echo e((($count_books->currentPage()-1)*$count_books->perPage()) + $loop->iteration); ?></td>
		  	 	  	<td><?php echo e('Count '.$single_count->id); ?></td>
		  	 	  	<td>
		  	 	  		<?php if($single_count->close_status): ?>
                         <b class="text-success">Finished</b>
                        <?php else: ?>
                         <b class="text-danger">Open</b>
		  	 	  		<?php endif; ?>
		  	 	  	</td>
		  	 	  	<td><?php echo e($single_count->created_at); ?></td>
		  	 	  	<td>
		  	 	  		<?php if($single_count->close_status): ?>
                          <p><?php echo e($single_count->created_at); ?></p>
                        <?php else: ?>
                         <b class="text-danger">not finished</b>
		  	 	  		<?php endif; ?>
		  	 	  	</td>
                     
		  	 	  	<td>
		  	 	  		<a class="btn btn-primary btn-sm" href="<?php echo e(route('Sancofa.Books.CountBooks.CountBooksPage',['id'=>$single_count->id])); ?>">Detail</a>
		  	 	  	</td>
		  	 	  </tr>
		  	 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  	 </tbody>
		  </table>
		  <?php echo e($count_books->links()); ?>

		<?php else: ?>
		 No Recorded Count
		<?php endif; ?>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/count/index.blade.php ENDPATH**/ ?>