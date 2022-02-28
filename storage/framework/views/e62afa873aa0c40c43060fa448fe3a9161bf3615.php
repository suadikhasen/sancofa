<?php $amharic = app('App\Http\Controllers\Sancofa\Service\AmharicDate'); ?>

<?php $__env->startSection('tittle','all book status'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<?php if(!empty($books)): ?>
	<b class="">total process <?php echo e($total); ?></b>
	<table class="table table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th scope="col">number</th>
				<th scope="col">book tittle</th>
				<th scope="col">book id</th>
				<th scope="col">giver name</th>
				<th scope="col">reciever name</th>
				<th scope="col">giving date</th>
				<th scope="col">returning/ed date</th>
				<th scope="col">borrowing id</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 <tr class="<?php if($book->approve && $book->punishment): ?> bg-success text-white <?php endif; ?> <?php if(!($book->approve)): ?> bg-warning <?php endif; ?> <?php if($book->approve && !($book->punishment)): ?> bg-danger text-white <?php endif; ?>">
				 	<td><?php echo e((($books->currentPage()-1)*$books->perPage())+$loop->iteration); ?></td>
				 	<td><?php echo e($book->book->book_name); ?></td>
				 	<td><?php echo e($book->book->book_id); ?></td>
				 	<td><?php echo e($book->giver->full_name); ?></td>
				 	<td><?php echo e($book->reciever->full_name); ?></td>
				 	<td><?php echo e($amharic->amharicDateTime($book->giving_date)); ?></td>
				 	<td><?php echo e($amharic->amharicDateTime($book->returned_date)); ?></td>
				 	<td><?php echo e($book->id); ?></td>
				 </tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<?php echo e($books->links()); ?>

	<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/bookstatus.blade.php ENDPATH**/ ?>