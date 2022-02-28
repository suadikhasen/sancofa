<?php $__env->startSection('content'); ?>
<?php if(!empty($borrowed_history)): ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2 class="font-weight-bolder font-italic text-info"><?php echo e($user->full_name.' - Borrowing History'); ?></h2>
			<table class="table  table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Book Name</th>
						<th scope="col">Book Id</th>
						<th scope="col">Return Status</th>
						<th scope="col">Borrowing Date</th>
						<th scope="col">Returning/ed Date</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $borrowed_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  <tr>
					  	<td><?php echo e((($borrowed_history->currentPage()-1)*$borrowed_history->perPage()) + $loop->iteration); ?></td>
					  	<td><?php echo e($history->book->book_name); ?></td>
					  	<td><?php echo e($history->book->book_id); ?></td>
					  	<td>
					  		<?php if($history->approve): ?>
					  		 <b class="text-success">returned</b>
					  		 <?php else: ?>
					  		  <b class="text-danger">Not Returned</b>
					  		<?php endif; ?>
					  	</td>
					  	<td>
					  		<?php echo e($history->giving_date); ?>

					  	</td>
					  	<td><?php echo e($history->returned_date); ?></td>
					  </tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<?php echo e($borrowed_history->links()); ?>

		</div>
	</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/borrowedhistry.blade.php ENDPATH**/ ?>