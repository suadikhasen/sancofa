<?php $month_name = app('App\Http\Controllers\Sancofa\Service\Activity'); ?>
<?php $__env->startSection('content'); ?>
<?php if(!empty($last_activity) && count($last_activity) > 0): ?>
 <div class="container">
 	<div class="row">
 		<div class="col-md-4 mt-5">
 			<div class="text-info font-weight-bold font-italic mb-1">
            <?php if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.Month'): ?>
              <?php echo e($full_name); ?> Activities On <?php echo e($month_name->monthName($month).'  '.$year); ?>

            <?php else: ?>
             <?php echo e($full_name); ?> Last 30 Days Activities
            <?php endif; ?>
 			</div>
		 	<table class="table table-hover table-bordered table-responsive">
		 		<thead class="alert-success">
		 			<tr>
		 				<th scope="col">#</th>
		 				<th scope="col">On</th>
		 				<th scope="col">Number Of Activities</th>
		 				<th scope="col">Tools</th>
		 			</tr>
		 		</thead>
		 		<tbody>
		 			<?php $__currentLoopData = $last_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		 			 <tr>
		 			 	<td><?php echo e($loop->iteration); ?></td>
		 			 	<td><?php echo e($activity->log_name); ?></td>
		 			 	<td><?php echo e($activity->total); ?></td>
		 			 	<td><a href="
		 			 		<?php if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.Month'): ?>
		 			 		 <?php echo e(route('Sancofa.Members.AllActivities.DetailInMonth',[
		 			 		 'id'=>$id,
		 			 		 'year'=>$year,
		 			 		 'month'=>$month,
		 			 		 'log_name'=>$activity->log_name,
		 			 		 ])); ?>

		 			 		<?php else: ?>
		 			 		<?php echo e(route('Sancofa.Members.DetailRecentActiviyty',['id'=>$id,'log_name'=>$activity->log_name])); ?>

		 			 		<?php endif; ?>
		 			 		">Detail</a></td>
		 			 </tr>
		 			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 		</tbody>
		 	</table>
		 	<a class="btn btn-primary text-white" href="<?php echo e(route('Sancofa.Members.AllActivities.index',['id'=>$id])); ?>">See All Activities</a>
	 	</div>
 	</div>
 </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/activity/recentactivity.blade.php ENDPATH**/ ?>