<?php $__env->startSection('content'); ?>
<?php if(!empty($ranked_books && count($ranked_books))): ?>
 <div class="row">
 	<div class="col-md-4">
 		<h2><?php echo e($year); ?> book rank</h2>
 		<table class="table table-bordered  table-hover">
 			<thead>
 				<tr>
 					<th scope="col">#</th>
 					<th scope="col">Book Tittle</th>
 					<th scope="col">Number Of Reading</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php $__currentLoopData = $ranked_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 				 <tr>
 				 	<td><?php echo e((($ranked_books->currentPage()-1)*$ranked_books->perPage())+$loop->iteration); ?></td>
 				 	<td><?php echo e($book->book_name); ?></td>
 				 	<td><?php echo e($book->no_reading); ?></td>
 				 </tr>
 				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 			</tbody>
 		</table>
 		<?php echo e($ranked_books->links()); ?>

 	</div>

 </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/bookrank.blade.php ENDPATH**/ ?>