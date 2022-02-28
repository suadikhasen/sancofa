<?php $punishment = app('App\Http\Controllers\Sancofa\Service\Punishment'); ?>

<?php $__env->startSection('tittle','list of punished members'); ?>
<?php $__env->startSection('content'); ?>
<?php if(!empty($panished_members)): ?>
 <div class="container">
 	<?php if(Session::has('paid')): ?>
 	 <div class="alert alert-success bg-success">
 	 	<?php echo e(Session::get('paid')); ?>

 	 </div>
 	<?php endif; ?>
 	<table class="table table-bordered table-hover">
 		<thead>
 			<tr>
 				<th scope="col">number</th>
 				<th scope="col">full name</th>
 				<th scope="col">sancofa id</th>
 				<th scope="col">amount</th>
 				<th scope="col">pay</th>

 			</tr>
 		</thead>
 		<tbody>
 			<?php $__currentLoopData = $panished_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 			  <tr>
 			  	<td><?php echo e(($panished_members->currentPage()-1)*$panished_members->perPage()+$loop->iteration); ?></td>
 			  	<td><?php echo e($member->book_members->reciever->full_name); ?></td>
 			  	<td><?php echo e($member->book_members->reciever->sancofa_id); ?></td>
 			  	<td><?php echo e($member->punishment); ?> Birr</td>
 			  	<td><a href="<?php echo e(route('Sancofa.Punishment.Pay',['b_id'=>$member->borrower_id,'p_id'=>$member->id])); ?>">pay</a></td>
 			  </tr>
 			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 		</tbody>
 	</table>
 	<?php echo e($panished_members->links()); ?>

 </div>
<?php else: ?>
no panished member who return the book
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/punishment/index.blade.php ENDPATH**/ ?>