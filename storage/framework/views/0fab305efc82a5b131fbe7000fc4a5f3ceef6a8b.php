<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php if(count($un_counted_books) >0): ?>
			 <div>
			 	<h2 class="text-dark"><?php echo e('Un Counted Books For Count '.$id); ?></h2>
			 	<b class="text-success float-right">total <?php echo e($total); ?></b>
			 </div>
			 <table class="table table-bordered table-hover">
			 	<thead>
			 		<tr>
			 			<th scope="col">#</th>
			 			<th scope="col">book name</th>
			 			<th scope="col">book id</th>
			 			<th scope="col">book author</th>
			 			<th scope="col">status</th>
			 			<th scope="col">Make Lost</th>
			 		</tr>
			 	</thead>
			 	<tbody>
			 		<?php $__currentLoopData = $un_counted_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 		 <tr>
			 		  <td><?php echo e((($un_counted_books->currentPage()-1)*$un_counted_books->perPage())+$loop->iteration); ?></td>
			 		  <td><?php echo e($book->book_name); ?></td>
			 		  <td><?php echo e($book->book_id); ?></td>
			 		  <td><?php echo e($book->book_author); ?></td>
			 		  <td>
			 		  	<?php if($book->status): ?>
                           <b style="color:green;">active</b>
                        <?php else: ?>
                           <b style="color:red;">lost</b>
                        <?php endif; ?>
					  </td>
	                  <td>
					   	<a href="<?php echo e(route('Sancofa.Books.CountBooks.MakeLost',['id'=> $book->book_id,'count' => $id])); ?>" class="btn btn-danger btn-sm mb-2 <?php if(!$book->status): ?>

					   	 disabled <?php endif; ?> ">make lost</a><br>
					  </td>
			 		</tr>
			 		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			 	</tbody>
			 </table>
			 <?php echo e($un_counted_books->links()); ?>

			<?php else: ?>
			  No Un Counted Books
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/count/uncountedbooks.blade.php ENDPATH**/ ?>