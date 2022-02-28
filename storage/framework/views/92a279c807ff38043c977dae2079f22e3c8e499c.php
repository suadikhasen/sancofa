<?php $return = app('App\Http\Controllers\Sancofa\Service\BookReturnStatus'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<?php if(Session::has('success')): ?>
	 <div class="alert alert-success bg-success"><?php echo e(Session::get('success')); ?></div>
	<?php endif; ?>
	<?php if(isset($all_reserved_books)): ?>
	  <table class="table table-hover table-bordered table-responsive">
	  	 <thead>
	  	 	<tr>
	  	 		<th scope="col">number</th>
	  	 		<th scope="col">book name</th>
	  	 		<th scope="col">book id</th>
	  	 		<th scope="col">book reserver</th>
	  	 		<th scope="col">reserver sancofa id</th>
	  	 		<th scope="col">address</th>
	  	 		<th scope="col">phone number</th>
	  	 		<th scope="col">book return status</th>
	  	 		<th scope="col">notification status</th>
	  	 	</tr>
	  	 </thead>
	  	 <tbody>
	  	 	<?php $__currentLoopData = $all_reserved_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserved): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  	 	 <tr>
	  	 	 	<td><?php echo e((($all_reserved_books->currentPage()-1)*$all_reserved_books->perPage())+$loop->iteration); ?></td>
	  	 	 	<td><?php echo e($reserved->book->book_name); ?></td>
	  	 	 	<td><?php echo e($reserved->book->book_id); ?></td>
	  	 	 	<td><?php echo e($reserved->member->full_name); ?></td>
	  	 	 	<td><?php echo e($reserved->member->sancofa_id); ?></td>
	  	 	 	<td><?php echo e($reserved->member->address); ?></td>
	  	 	 	<td>
	  	 	 		<?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
	  	 	 		<?php echo e($reserved->member->phone_no); ?>

	  	 	 		<?php else: ?>
	  	 	 		 *********
	  	 	 		<?php endif; ?>
	  	 	 	</td>
	  	 	 	<td>
	  	 	 		<?php if($return->check($reserved->book->book_id)): ?>
	  	 	 		 <p class="text-success">Book Returned</p>
	  	 	 		<?php else: ?>
	  	 	 		 <p class="text-warning">Book Not Returned</p>
	  	 	 		<?php endif; ?>
	  	 	 	</td>
	  	 	 	<td><a href="<?php echo e(route('Sancofa.Books.ReserveNotify',['id'=>$reserved->id])); ?>" class="btn btn-sm btn-primary">notify</a></td>
	  	 	 </tr>
	  	 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  	 </tbody>
	  </table>
	  <?php echo e($all_reserved_books->links()); ?>

	<?php else: ?>
	no reserved books
	<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/allreservedbooks.blade.php ENDPATH**/ ?>