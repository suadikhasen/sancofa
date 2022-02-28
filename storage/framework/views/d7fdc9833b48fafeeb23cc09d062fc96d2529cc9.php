<?php $book_status = app('App\Http\Controllers\Sancofa\Service\BookStatus'); ?>
<?php $amharic = app('App\Http\Controllers\Sancofa\Service\AmharicDate'); ?>
<?php $reserve = app('App\Http\Controllers\Sancofa\Service\ReservedStatus'); ?>

<?php $__env->startSection('tittle','list of all books'); ?>
<?php $__env->startSection('content'); ?>
<?php if(Session::has('success')): ?>
 <div class="alert alert-success bg-success">
 	<?php echo e(Session::get('success')); ?>

 </div>
<?php endif; ?>
<?php if(!empty($books)): ?>
<div class="row">
	<div class="col-md-4">
	 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 " method="get" action="<?php echo e(route('Sancofa.Books.Search')); ?>">
		 	    <?php echo csrf_field(); ?>
		 	    <p>search by name,author,donator,</p>
		    <div class="input-group">

			      <input id="search" type="text" class="form-control  " placeholder="Search by name,,author,catagory" aria-label="Search" aria-describedby="basic-addon2" name="search">
			      <div class="input-group-append">
			        <button class="btn btn-primary" type="submit">
			          <i class="fas fa-search fa-sm"></i>
			        </button>
			      </div>
		    </div>
		    <br>
	    </form>
  </div>

  <div class="col-md-4">
 	<form class="d-none d-sm-inline-block form-inline  ml-md-5  " method="get" action="<?php echo e(route('Sancofa.Books.FindByAccession')); ?>">
	 	    <?php echo csrf_field(); ?>
	 	<p>Search By acc Number</p>
	    <div class="input-group">
		      <input type="text" class="form-control  " placeholder="Search by accession key" aria-label="Search" aria-describedby="basic-addon2" name="id" autofocus value="acc-" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
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
 	<form method="get"  action=" <?php echo e(route('Sancofa.Books.Order')); ?>">
 		<p for="order">order by</p>
 		<div class="input-group form-inline">

 			<select class="form-control" id="order" name="order">
 				<option>by decreasing registration date</option>
 				<option>by increasing registration date</option>
 				<option>by increasing accession number</option>
                <option>by decreasing accession number</option>
 				<option>by book tittle</option>
 				<option>by book author</option>
 				<option>by price</option>
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

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 mt-1 ml-10">
			<table class="table table-bordered table-hover table-responsive">
				<?php if(Route::currentRouteName() == 'Sancofa.Books.AllBooks' || Route::currentRouteName() == 'Sancofa.Books.Order'): ?>
				<span>
					<b>list of books</b>
				</span>
				<span style="float:right;">
					<b>total registered books  <?php echo e(' '.$books->total()); ?> <?php elseif(Route::currentRouteName() == 'Sancofa.Books.Search'): ?> <?php echo e('  '.$books->total()); ?> results found for this search  <?php endif; ?></b>
				</span>
				<thead class="thead-dark">
					<tr>
						<th scope="col">number</th>
						<th scope="col">book tittle</th>
						<th scope="col">book author</th>
						<th scope="col">book id</th>
						<th scope="col">book price</th>
						<th scope="col">catagory</th>
						<th scope="col">book donator</th>
						<th scope="col">reg date</th>
						<th scope="col">borrowing status</th>
						<th scope="col">lost status</th>
						<?php if(Auth::guard('sancofa')->role = 'admin'): ?>
						 <th scope="col">Tools</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php if(Route::currentRouteName() == 'Sancofa.Books.Search' || Route::currentRouteName() == 'Sancofa.Books.AllBooks' || Route::currentRouteName() == 'Sancofa.Books.Order'): ?>
					<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
						  <td><?php echo e((($books->currentPage()-1)*$books->perPage())+$loop->iteration); ?></td>
						  <td><?php echo e($book->book_name); ?></td>
						  <td><?php echo e($book->book_author); ?></td>
						  <td><?php echo e($book->book_id); ?></td>
						  <td><?php echo e($book->price); ?></td>
						  <td><?php echo e($book->catagory); ?></td>
						  <td><?php echo e($book->donator); ?></td>
						  <td><?php echo e($amharic->amharicDateTime($book->created_at)); ?></td>
						  <td><?php if($book_status->borrowedStatus($book->book_id)): ?>
                           <b style="color:red">borrowed</b>
                            <?php if($reserve->ReservedStatus($book->book_id)): ?>
								<p>reserved</p>
								<?php else: ?>
								<p> not reserved</p>
								 <a href="<?php echo e(route('Sancofa.Books.ReservingBooks',['id'=>$book->book_id])); ?>">reserve</a>
								<?php endif; ?>
                           <?php else: ?>
                            <b style="color:green;">not borrowed</b>
                            <?php endif; ?>
						  </td>
						  <td><?php if($book->status): ?>
                              <b style="color:green;">active</b>
                              <?php else: ?>
                              <b style="color:red;">lost</b>
                              <?php endif; ?>
						  </td>
						  <?php if(Auth::guard('sancofa')->role == 'admin'): ?>
						   <td>
                          
                            <a href = "<?php echo e(route('Sancofa.Books.EditBook',['id'=>$book->book_id])); ?>" class = "btn btn-sm btn-primary">Edit</a>
                          </td>
						  <?php endif; ?>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php elseif(Route::currentRouteName() == 'Sancofa.Books.FindByAccession'): ?>

					  <tr>
						  <td>1</td>
						  <td><?php echo e($books->book_name); ?></td>
						  <td><?php echo e($books->book_author); ?></td>
						  <td><?php echo e($books->book_id); ?></td>
						  <td><?php echo e($books->price); ?></td>
						  <td><?php echo e($books->catagory); ?></td>
						  <td><?php echo e($books->donator); ?></td>
						  <td><?php echo e(date('F d,Y',strtotime($books->created_at))); ?></td>
						  <td>
						  	<?php if($book_status->borrowedStatus($books->book_id)): ?>
                           <b style="color:red">borrowed</b>
                           <?php else: ?>
                            <b style="color:green;">not borrowed</b>
                            <?php endif; ?>
						  </td>
						  <td>
						  	<?php if($books->status): ?>
                              <b style="color:green;">active</b>
                            <?php else: ?>
                              <b style="color:red;">lost</b>
                            <?php endif; ?>
						  </td>

						  <?php if(Auth::guard('sancofa')->role == 'admin'): ?>
						   <td>
						   	
                            <a href = "<?php echo e(route('Sancofa.Books.EditBook',['id'=>$books->book_id])); ?>" class = "btn btn-sm btn-primary">Edit</a>
						   	</td>
						  <?php endif; ?>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<?php if(Route::currentRouteName() == 'Sancofa.Books.Search' || Route::currentRouteName() == 'Sancofa.Books.AllBooks' || Route::currentRouteName() == 'Sancofa.Books.Order'): ?>
			<span><?php echo e($books->appends(Request::except('page'))->links()); ?></span><span style="float:right;"><b>total for this page <?php echo e(' '.$books->count()); ?></b></span>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php else: ?>
No registered Books
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/allbooks.blade.php ENDPATH**/ ?>