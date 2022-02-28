<?php $__env->startSection('content'); ?>
<div class="container mt-4">
	<?php if(!empty($unique_year)): ?>
	<ol>
		<?php $__currentLoopData = $unique_year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  <li class="mb-2">
		  	<a href="<?php echo e(route('Sancofa.Books.BookRank',['year'=>$year->year])); ?>" class="btn btn-success"><?php echo e($year->year); ?></a>
		  </li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ol>
	<?php else: ?>
	  book rank not start
	<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/bookrankyear.blade.php ENDPATH**/ ?>