<?php $__env->startSection('tittle','list of active members'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="col-md-10">
		<?php if(Session::has('deactive')): ?>
		 <div class="alert alert-success bg-success">
		 	deactivated successfully
		 </div>
		<?php endif; ?>
		<a href="<?php echo e(route('Sancofa.ActiveMembers.Add')); ?>">add new active member</a>

		<?php if(!empty($active_members)): ?>
		<span style="float: right">total <?php echo e(' '.' '. $total); ?></span>
		 <table class="table table-bordered table-hover">
		 	<thead class="thead-dark">
		 		<tr>
		 			<td scope="col">number</td>
		 			<td scope="col">full name</td>
		 			<td scope="col">sancofa id</td>
		 			<td scope="col">university id</td>
		 			<td scope="col">department</td>
		 			<td scope="col">tool</td>
		 		</tr>
		 	</thead>
		 	<tbody>
		 		<?php $__currentLoopData = $active_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		 		<tr>
		 		   <td><?php echo e(($active_members->currentPage()-1)*$active_members->perPage()+$loop->iteration); ?></td>
		 		   <td><?php echo e($member->full_name); ?></td>
		 		   <td><?php echo e($member->sancofa_id); ?></td>
		 		   <td><?php echo e($member->university_id); ?></td>
		 		   <td><?php echo e($member->department); ?></td>
		 		   <td>
		 		   	<a href="<?php echo e(route('Sancofa.ActiveMembers.DeActive',['id' => $member->sancofa_id])); ?>" class="btn btn-primary btn-sm mb-1">de active</a><br/>
		 		   	<a href="<?php echo e(route('Sancofa.ActiveMembers.ChangePassword',['id' => $member->sancofa_id])); ?>" class="btn btn-sm btn-success mb-1">change Password</a><br>
                    <a href="<?php echo e(route('Sancofa.Members.Activity',['id'=>$member->sancofa_id])); ?>" class="btn btn-secondary btn-sm">Activity</a><br>
		 		   </td>
		 		</tr>
		 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 	</tbody>
		 </table>
		 <?php echo e($active_members->links()); ?>

		<?php else: ?>
		 no active members
		<?php endif; ?>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/super/Documents/projects/Sankofa/resources/views/sancofa/member/active.blade.php ENDPATH**/ ?>