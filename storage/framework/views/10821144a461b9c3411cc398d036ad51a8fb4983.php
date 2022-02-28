<?php $amharic = app('App\Http\Controllers\Sancofa\Service\AmharicDate'); ?>

<?php $__env->startSection('tittle','borrowed information'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="card text-white bg-dark ml-5">
				<div class="card-header text-dark badge-primary">
					borrowed information
				</div>
				<div class="card-body">
					<p>reciever name : <?php echo e($borrower->reciever->full_name); ?></p>

					<p>giver name : <?php echo e($borrower->giver->full_name); ?></p>
					<p>book tittle : <?php echo e($borrower->book->book_name); ?></p>
					<p>book id : <?php echo e($borrower->book->book_id); ?></p>
					<p>borrowing date : <?php echo e($amharic->amharicDateTime($borrower->giving_date)); ?></p>
					<p>returned date : <?php echo e($amharic->amharicDateTime($borrower->returned_date)); ?></p>
					<p>borrowing id:<?php echo e($borrower->id); ?></p>
				</div>
			</div>
		</div>
	</div>
	<br>
	<a class="btn btn-success btn-block text-md-center font-weight-bold" href="<?php echo e(route('Sancofa.Books.Borrowing')); ?>">Return to Lend Page</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/super/Documents/projects/Sankofa/resources/views/sancofa/books/borrowedinfo.blade.php ENDPATH**/ ?>