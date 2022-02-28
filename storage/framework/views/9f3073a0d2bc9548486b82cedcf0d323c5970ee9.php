<?php $__env->startSection('content'); ?>
<h2 class="font-italic text-center text-info"><?php echo e($year.' Monthly Payment '.$monthly_payment->amount.' Birr  Per Month'); ?> </h2><br>
<div class="row mb-1">
   
   <div class="col-md-3">
   	 <?php if(!$monthly_payment->status): ?>
   	 <a href="<?php echo e(route('Sancofa.Others.AddMembersToPayment',['year'=>$year])); ?>" class="btn btn-sm btn-primary " >Add Members  To This  Payment</a>
   	 <?php endif; ?>
   </div>

   <div class="col-md-3">
	  	
	  	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="<?php echo e(route('Sancofa.Others.SearchInMonthlyPayment',['year' => $year])); ?>">
	 	    <?php echo csrf_field(); ?>
            <div class="input-group">
              <input type="text" class="form-control  " placeholder="Search by sancofa id" aria-label="Search" aria-describedby="basic-addon2" name="search" autofocus>
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div><br>
       </form>
	</div>
	
	<div class="col-md-3">
	<?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
	  <?php if($monthly_payment->status): ?>
	    <b class="text-success float-right">closed</b>
	  <?php else: ?>
	  <a href="<?php echo e(route('Sancofa.Others.CloseMonthlyPayment',['year' => $year])); ?>" class="font-weight-bolder btn btn-success float-right">Close</a>
      <?php endif; ?>
	<?php endif; ?>
	<b class="text-success">Total paid:<?php echo e('  '.$total_payment_collected.' Birr'); ?></b>
	</div>
	
<?php if(Session::has('fail')): ?>
		 <div class="alert alert-danger bg-danger">
		 	<?php echo e(Session::get('fail')); ?>

		 </div>
		<?php endif; ?>

		<?php if(Session::has('success')): ?>
		 <div class="alert alert-success bg-success">
		 	<?php echo e(Session::get('success')); ?>

		 </div>
		<?php endif; ?>
        
        <?php if($errors->any()): ?>
	        <ul class="alert alert-danger bg-danger"> 
	        	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	        	  <li><?php echo e($error); ?></li>
	        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </ul>
        <?php endif; ?>	
</div>
<?php if(!empty($list)): ?>
<div class="row">
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Full Name</th>
				<th scope="col">Sankofa  Id</th>
				<th scope="col">September</th>
				<th scope="col">October</th>
				<th scope="col">November</th>
				<th scope="col">December</th>
				<th scope="col">January</th>
				<th scope="col">February</th>
				<th scope="col"> March  </th>
				<th scope="col"> April  </th>
				<th scope="col"> May  </th>
				<th scope="col"> June  </th>
				<th scope="col"> July  </th>
				<th scope="col"> August  </th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 <tr>
			 	<td><?php echo e((($list->currentPage()-1)*$list->perPage())+$loop->iteration); ?></td>
			 	<td><?php echo e($single->sancofaUser->full_name); ?></td>
			 	<td><?php echo e($single->sancofaUser->sancofa_id); ?></td>
			 	<td>
			 		<?php if($single->september): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'september','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->october): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'october','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->november): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'november','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->december): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'december','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->january): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'january','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->february): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'february','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->march): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'march','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->april): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'april','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->may): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'may','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->june): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'june','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->july): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'july','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 	<td>
			 		<?php if($single->august): ?>
			 		 <b class="text-success">paid</b>
			 		<?php else: ?>
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="<?php echo e(route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'august','year'=>$year])); ?>" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		<?php endif; ?>
			 	</td>
			 </tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/others/listofmonthlypayer.blade.php ENDPATH**/ ?>