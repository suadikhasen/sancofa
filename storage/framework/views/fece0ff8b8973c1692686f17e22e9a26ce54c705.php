<?php $address = app('App\Http\Controllers\Sancofa\Service\AddressDetector'); ?>
<?php $amharic = app('App\Http\Controllers\Sancofa\Service\AmharicDate'); ?>
<?php $blocked = app('App\Http\Controllers\Sancofa\Service\BlockedStatus'); ?>

<?php $__env->startSection('tittle','list of all members'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
	 <div class="col-md-4">
	 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="<?php echo e(route('Sancofa.Members.Search')); ?>">
		 	    <?php echo csrf_field(); ?>
		 	<p>search by name and university id</p>
		    <div class="input-group">
			      <input type="text" class="form-control  " placeholder="Search by name and university id" aria-label="Search" aria-describedby="basic-addon2" name="search">
			      <div class="input-group-append">
			        <button class="btn btn-primary" type="submit">
			          <i class="fas fa-search fa-sm"></i>
			        </button>
			      </div>
		    </div>
		    <br>
	    </form>
	 </div>
	 <div class="col-md-3">
	 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="<?php echo e(route('Sancofa.Members.SearchBySancofaID')); ?>">
		 	    <?php echo csrf_field(); ?>
		 	<p>search by sancofa-id</p>
		    <div class="input-group">
			      <input type="text" class="form-control  " placeholder="Search by sancofa id" aria-label="Search" aria-describedby="basic-addon2" name="sancofa_id">
			      <div class="input-group-append">
			        <button class="btn btn-primary" type="submit">
			          <i class="fas fa-search fa-sm"></i>
			        </button>
			      </div>
		    </div>
		    <br>
	    </form>
	 </div>
    <div class="col-md-3">
 	<form method="get"  action=" <?php echo e(route('Sancofa.Members.Order')); ?>">
 		<p >order by</p>
 		<div class="input-group form-inline">

 			<select class="form-control" id="order" name="order">
 				<option>by decreasing registration date</option>
 				<option>by increasing registration date</option>
 				<option>by department</option>
                <option>by decreasing sancofa id</option>
                <option>by increasing sancofa id</option>
 			</select>
 			<div class="input-group-append">
		        <button class="btn btn-primary" type="submit">
		          <i class="fas fa-search fa-sm"></i>
		        </button>
		      </div>
 		</div>

 	</form>
 </div>

</div>
 <?php if(Session::has('success')): ?>
  <div class="alert alert-success bg-success">
  	 <?php echo e(Session::get('success')); ?>

  </div>
 <?php endif; ?>

 <?php if(!empty($sancofa_user)): ?>
	 <table class="table table-bordered  table-hover table-responsive">
	 	<span><b>
	 	<?php if(Route::currentRouteName() == 'Sancofa.Members.Search'): ?> <?php echo e($total); ?> result found for this  search 
	   <?php elseif(Route::currentRouteName() == 'Sancofa.Members.SearchBySancofaID'): ?> 
	     <?php echo e($total); ?> result for this search
	   <?php else: ?> 
	   list of registered members</b></span><span style="float: right;">total registered<?php echo e("   ".$total); ?><?php endif; ?></span>
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">full name</th>
				<th scope="col">department</th>
				<?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
				<th scope="col">Blocked Status</th>
				<?php endif; ?>
				<th scope="col">phone number</th>
				<th scope="col">sancofa id</th>
				<th scope="col">university id</th>
				<th scope="col">reg date</th>
				<th scope="col">Gender</th>
				<th scope="col">Address</th>
				<th scope="col">Photo Status</th>
				<th scope="col">Registration Payment</th>
				<th scope="col">Edit MemberData</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $sancofa_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e((($sancofa_user->currentPage()-1)*$sancofa_user->perPage()) + $loop->iteration); ?></td>
				<td><?php echo e($single->full_name); ?></td>
				<td><?php echo e($single->department); ?></td>
				<?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
				 <td>
				 	<?php if($blocked->checkBlockStatus($single->sancofa_id)): ?>
				 	  <p class="text-warning">blocked</p>
				 	  <br>
				 	  <a href="<?php echo e(route('Sancofa.Members.UnBlock',['id' => $single->sancofa_id])); ?>">unblock</a>
				 	<?php else: ?>

				 	  <p class="text-success">un blocked</p>
				 	  <br>
				 	  <a href="<?php echo e(route('Sancofa.Members.Block',['id' => $single->sancofa_id])); ?>">block</a>

				 	<?php endif; ?>
				 </td>
				<?php endif; ?>
				<td>
					<?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
					<?php echo e($single->phone_no); ?>

					<?php else: ?>
					 *************
					<?php endif; ?>
				</td>
				<td><?php echo e($single->sancofa_id); ?></td>
				<td><?php echo e($single->university_id); ?></td>
				<td><?php echo e($amharic->amharicDateTime($single->created_at)); ?></td>
				<td><?php echo e($single->gender); ?></td>
				<td><?php echo e($single->address); ?><br/>

                 <?php if($address->trace($single->address)): ?>
                  <a href="<?php echo e(route('Sancofa.Members.AddAddress',['id' => $single->sancofa_id])); ?>">update</a>
                 <?php else: ?>
                  <a href="<?php echo e(route('Sancofa.Members.AddAddress',['id' => $single->sancofa_id])); ?>">add</a>
                 <?php endif; ?>
				</td>
				<td><?php if($single->photo_status): ?>
					  <p style="color:green;">accepted</p>
					<?php else: ?>
					<p class="text-success">Not Accepted</p>
					 <a href="<?php echo e(route('Sancofa.Members.UpdatePhotoStatus',['id' => $single->sancofa_id])); ?>" style="color:red;">  accept</a>
					<?php endif; ?>
				</td>
				<td>
					<?php if($single->payment_status): ?>
					 <p style="color:green">paid</p>
					<?php else: ?>
					 <p style="color:red;">unpaid</p>
					 <a href="<?php echo e(route('Sancofa.Members.UpdatePaymentStatus',['id' => $single->sancofa_id])); ?>" > Pay</a>
					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo e(route('Sancofa.Members.UpdateView',['id'=>$single->sancofa_id])); ?>" class="btn btn-primary btn-sm mb-1">Edit</a>
					<a href="<?php echo e(route('Sancofa.Members.BorrowedHistory',['id'=>$single->sancofa_id])); ?>" class="btn btn-primary btn-sm">Borrowed History</a>


				</td>

			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	 </table>
	<?php echo e($sancofa_user->appends(Request::except('page'))->links()); ?><span class="ml-5" style="float:right"><b> <?php echo e($sancofa_user->count()); ?> members for this page </b><span>
 <?php else: ?>
  no registered members
 <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/allmembers.blade.php ENDPATH**/ ?>