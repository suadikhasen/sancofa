<?php $punishment = app('App\Http\Controllers\Sancofa\Service\Punishment'); ?>
<?php $extend = app('App\Http\Controllers\Sancofa\Service\Extend'); ?>
<?php $address = app('App\Http\Controllers\Sancofa\Service\AddressDetector'); ?>
<?php $amharic = app('App\Http\Controllers\Sancofa\Service\AmharicDate'); ?>
<?php $reserve = app('App\Http\Controllers\Sancofa\Service\ReservedStatus'); ?>

<?php $__env->startSection('tittle','list of all borrowed'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
	  <div class="col-md-4">
	  	<p>search members  sancofa-id</p>
	  	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="<?php echo e(route('Sancofa.Borrower.Search')); ?>">
	 	    <?php echo csrf_field(); ?>
            <div class="input-group">
              <input type="text" class="form-control  " placeholder="Search by sancofa id" aria-label="Search" aria-describedby="basic-addon2" name="search">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div><br>
       </form>
	  </div>
	  <div class="col-md-4">
		 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="<?php echo e(route('Sancofa.Books.SearchByAccessionKey')); ?>">
			 	    <?php echo csrf_field(); ?>
			 	<p>Search By acc Number</p>
			    <div class="input-group">
				      <input type="text" class="form-control  " placeholder="Search by name,sancofa id,university id" aria-label="Search" aria-describedby="basic-addon2" name="search" value="acc-">
				      <div class="input-group-append">
				        <button class="btn btn-primary" type="submit">
				          <i class="fas fa-search fa-sm"></i>
				        </button>
				      </div>
			    </div>
			    <br>
		    </form>
	 </div>
	</div>	 
	<div class="row">
		<?php if(Session::has('success')): ?>
		  <div class="alert alert-success bg-success">
				<?php echo e(Session::get('success')); ?>

			</div>
		<?php endif; ?>
		<?php if(!empty($books)): ?>
		<div class=" col-md-12">
			<?php if(Session::has('return')): ?>
			<div class="alert alert-success bg-success">
				<?php echo e(Session::get('return')); ?>

			</div>
			<?php endif; ?>
		    <div>
		    	<?php if(Route::currentRouteName() == 'Sancofa.Books.AllBorrowedBooks'): ?>
		    	<span><b>totall borrowed books:<?php echo e($total); ?></b></span>
		    	<?php endif; ?>
		    </div>
			<table class="table table-bordered table-hover table-responsive">
				<thead class="badge-primary">
					<tr>
						<th scope="col">number</th>
						<th scope="col">book name</th>
						<th scope="col">book id</th>
						<th scope="col">giver name</th>
						<th scope="col">reciever name</th>
						<th scope="col">reciever id</th>
						<th scope="col">borrowing date</th>
						<th scope="col">returned date</th>
						<th scope="col">reserved status</th>
						<th scope="col">punishment</th>
						<th scope="col">return status</th>
						<th scope="col">borrowing id</th>
						<th scope="col">extend</th>
						<th scope="col">detail about member</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e((($books->currentPage()-1)*$books->perPage())+$loop->iteration); ?></td>

						<td><?php echo e($book->book->book_name); ?></td>
						<td><?php echo e($book->book->book_id); ?></td>
						<td><?php echo e($book->giver->full_name); ?></td>
						<td><?php echo e($book->reciever->full_name); ?></td>
						<td><?php echo e($book->reciever_id); ?></td>
						<td><?php echo e($amharic->amharicDateTime($book->giving_date)); ?></td>
						<td><?php echo e($amharic->amharicDateTime($book->returned_date)); ?></td>
						<td>
						<?php if($reserve->ReservedStatus($book->book->book_id)): ?>
						<b class="text-success text-uppercase">reserved</b>
						<?php else: ?>
						 not reserved
						 <a href="<?php echo e(route('Sancofa.Books.ReservingBooks',['id'=>$book->book->book_id])); ?>">reserve</a>
						<?php endif; ?>
					   </td>
						<td>

							<b class="<?php if($punishment->calculatePanishment($book->returned_date)): ?> == 0) text-danger <?php else: ?> text-success <?php endif; ?>"><?php echo e($punishment->calculatePanishment($book->returned_date)); ?> Birr</b>
						</td>
						<td>
							<?php if($punishment->checkPunishment($book->returned_date)): ?>
							<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#s<?php echo e($book->id); ?>">
                               return
                            </button>
							<!-- Modal -->
							<div class="modal fade" id="s<?php echo e($book->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-scrollable" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalScrollableTitle">returning book</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							          if the book is returned with paid punishment select <strong>withPunishment Button</strong><br>
							          if the book is returned with out Punishment select 
							          <strong>withOutPunishmentButton</strong>

							      </div>
							      <div class="modal-footer">
							        <a  class="btn btn-secondary" href="<?php echo e(route('Sancofa.Books.ReturnBookWithOutPunishment',['id'=>$book->id])); ?>">with out punishment</a>
							        <a  class="btn btn-primary" href="<?php echo e(route('Sancofa.Books.ReturnWithPunishMent',['id'=>$book->id])); ?>">with punishment</a>
							      </div>
							    </div>
							  </div>
							</div>
							<?php else: ?>
							<a href="<?php echo e(route('Sancofa.Books.ReturnBookWithNoPunishment',['id'=>$book->id])); ?>" class="btn btn-sm btn-success">return</a>
							<?php endif; ?>
						</td>
						<td><?php echo e($book->id); ?></td>
						<td>
						<?php if($extend->checkExtend($book->giving_date,$book->returned_date)): ?>
						  <a href="<?php echo e(route('Sancofa.Books.Extend',['id'=>$book->id])); ?>" class="btn btn-info btn-sm">Extend</a>
						<?php else: ?>
						 <small class="text-warning">can not be extended</small>
						<?php endif; ?>
						</td>
						<td>
							<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#d<?php echo e($book->id); ?>">
		                               detail
		                    </button>
			        <div class="modal fade" id="d<?php echo e($book->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-scrollable" role="document">
						    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Of Borrower</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							    <div class="modal-body">
								    <?php if($book->reciever->photo_status): ?>
										<p >Photo Status :<b style="color:green;">accepted</b></p>
										<?php else: ?>
										<p>
											Photo Status :<b style="color:red;">un accepted</b>
										 <a href="<?php echo e(route('Sancofa.Members.UpdatePhotoStatus',['id' => $book->reciever->sancofa_id])); ?>" >  accept</a>
										</p>
								   <?php endif; ?>
								<?php if($book->reciever->payment_status): ?>
								 <p>registration payment:<b style="color:green">paid</b></p>
								<?php else: ?>
								 <p >registration payment :<b style="color:red;">Unpaid</b>
								 <a href="<?php echo e(route('Sancofa.Members.UpdatePaymentStatus',['id' => $book->reciever->sancofa_id])); ?>" > Pay</a>
								</p>
								<?php endif; ?>
			                    <p>Address:<?php echo e($book->reciever->address.'  '); ?>

								<?php if($address->trace($book->reciever->address)): ?>
									
					                  <a href="<?php echo e(route('Sancofa.Members.AddAddress',['id' => $book->reciever->sancofa_id])); ?>">update</a>
					                 <?php else: ?>
					                  <a href="<?php echo e(route('Sancofa.Members.AddAddress',['id' => $book->reciever->sancofa_id])); ?>">add</a> 
				                <?php endif; ?>
							    </p>  
							    <p class="text-info">Phone Number:
							    	<?php if(Auth::guard('sancofa')->user()->role == 'admin'): ?>
							    	<?php echo e($book->reciever->phone_no); ?>

							    	<?php else: ?>
							    	 ***********
							    	<?php endif; ?>
							    </p>
							    <a href="<?php echo e(route('Sancofa.Members.BorrowedHistory',['id'=>$book->reciever_id])); ?>" class="btn btn-primary btn-block">Click To See Borrowing History<a>
							    </div>
							    
					       </div>
					  </div>
			        </div>
				</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
		<?php echo e($books->links()); ?>

		<?php endif; ?>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/allborrowedbooks.blade.php ENDPATH**/ ?>