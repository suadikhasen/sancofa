<?php $__env->startSection('tittle','list of rank of readers'); ?>
<?php $__env->startSection('content'); ?>
<div class="row mb-2 bg-secondary justify-content-between">
	<div class="col-md-5 mt-5">
		<a href="<?php echo e(route('Sancofa.FemaleRank',['year'=>$year])); ?>" class="btn btn-primary btn-block">Click For Female</a>
	</div>
	<div class="col-md-5 mt-2">
		<form method="get"  action=" <?php echo e(route('Sancofa.RankOfDepartment',['year'=>$year])); ?>">
	 		<p class="text-white">select below to rank  by department </p>
	 		<div class="input-group form-inline">
	 			<select class="form-control" id="department" name="department">
			 		<option>Health Informatics (HI)</option>
	             	<option>Medicine</option>
	             	<option>Anesthesia</option>
	                <option>Pharmacy</option>
	                <option>Psychiatry</option>
	                <option>Optometry</option>
	                <option>Biomedical and Laboratory Sciences (Lab)</option>
	                <option>Environmental and Occupational Health and Safety  (Enva)</option>
	                <option>Staff</option>
	                <option>Health Officer (HO)</option>
	                <option>Physiotherapy (PT)</option>
	                <option>Nursing</option>
	                <option>Midwifery</option>
	                <option>Others</option>
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
<?php if(!empty($list_of_rank)): ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col">Rank</td>
						<th scope="col">full Name</td>
						<th scope="col">sancofa id</td>
						<th scope="col">univ id</td>
						<th scope="col">gender</th>
						<th scope="col">department</td>
						<th scope="col">number of reading</td>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $list_of_rank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 <tr>
					 	<td><?php echo e(($list_of_rank->currentPage()-1)*$list_of_rank->perPage()+$loop->iteration); ?></td>
					 	<td><?php echo e($rank->SancofaUser->full_name); ?></td>
					 	<td><?php echo e($rank->SancofaUser->sancofa_id); ?></td>
					 	<td><?php echo e($rank->SancofaUser->university_id); ?></td>
					 	<td><?php echo e($rank->SancofaUser->gender); ?></td>
					 	<td><?php echo e($rank->SancofaUser->department); ?></td>
					 	<td><?php echo e($rank->no_reading); ?></td>
					 </tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<?php echo e($list_of_rank->links()); ?>

		</div>
	</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/member/listofrank.blade.php ENDPATH**/ ?>