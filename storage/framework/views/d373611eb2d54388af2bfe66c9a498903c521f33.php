<?php $activityService = app('App\Http\Controllers\Sancofa\Service\Activity'); ?>
<?php $month_name = app('App\Http\Controllers\Sancofa\Service\Activity'); ?>

<?php $__env->startSection('content'); ?>
<?php if(!empty($grouped_activity) && count($grouped_activity) >0): ?>
 <?php if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.DetailInMonth'): ?>
  <h1 ><?php echo e($full_name); ?> Activity  In <?php echo e($month_name->monthName($month).'  '.$year); ?> on books</h1>
 <?php else: ?>
 <h1 ><?php echo e($full_name); ?> activity for last five days on books</h1>
 <?php endif; ?>
 <?php $__currentLoopData = $grouped_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity_date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <h4 class="text-dark bg-primary text-md-center">on <?php echo e($activityService->actionDate($grouped_activity,$loop->iteration)); ?></h4>
   <?php $__currentLoopData = $activity_date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <b class="text-success">
      <?php if($activityService->activityStatus($activity_date,$loop->iteration) == 'created'): ?>
       New Registered Books by <?php echo e($full_name); ?>

      <?php else: ?>
        Books Edited By <?php echo e($full_name); ?>

      <?php endif; ?>
   </b>
   <table class="table table-hover table-bordered">
      <thead>
      	<tr>
      		<th scope="col">#</th>
      		<th scope="col">book_id</th>
      		<th scope="col">book_name</th>
      		<th scope="col">Action Date</th>
      		<?php if($activityService->activityStatus($activity_date,$loop->iteration) == 'updated'): ?>
      		 <th scope="col">More</th>
      		<?php endif; ?>
      	</tr>
      </thead>
      <tbody>
      	 <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	      	 <tr>
	           <td><?php echo e($loop->iteration); ?></td>
	           <td><?php echo e($single_activity->books->book_id); ?></td>
	           <td><?php echo e($single_activity->books->book_name); ?></td>
	           <td><?php echo e($single_activity->created_at); ?></td>
	           <?php if($activityService->activityStatus($activity_date,$loop->parent->iteration) == 'updated'): ?>
	            <td><a href="<?php echo e(route('Sancofa.Members.DetailOnUpdates',['id'=>$single_activity->id])); ?>">Detail</a></td>
	           <?php endif; ?>	
	         </tr>
      	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
   </table>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
no activity
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/activity/detailbookactivity.blade.php ENDPATH**/ ?>