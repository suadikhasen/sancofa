<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php if(count($counted_books) >0): ?>
			 <h2 class="text-dark"><?php echo e('counted books for count '.$id); ?></h2>
			 <table class="table table-bordered table-hover">
			 	<thead>
			 		<tr>
			 			<th scope="col">#</th>
			 			<th scope="col">book name</th>
			 			<th scope="col">book id</th>
			 		</tr>
			 	</thead>
			 	<tbody>
			 		<?php $__currentLoopData = $counted_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 		 <tr>
			 		  <td><?php echo e((($counted_books->currentPage()-1)*$counted_books->perPage())+$loop->iteration); ?></td>
			 		  <td><?php echo e($book->books->book_name); ?></td>
			 		  <td><?php echo e($book->books->book_id); ?></td>
			 		</tr>
			 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			 	</tbody>
			 </table>
			 <?php echo e($counted_books->links()); ?>

			<?php else: ?>
			  no counted books
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/count/countedbooks.blade.php ENDPATH**/ ?>