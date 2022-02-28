<?php $__env->startSection('tittle','adding book'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php if(Session::has('error')): ?>
			  <div class="alert alert-danger bg-danger">
			  	 <?php echo e(Session::get('error')); ?>

			  </div>
			<?php endif; ?>
			<?php if(Session::has('book_added')): ?>
			 <div class="alert alert-success bg-success">
			 	<?php echo e(Session::get('book_added')); ?>

			 </div>
			<?php endif; ?>
			<?php if($errors->any()): ?>
			<div class="alert alert-danger bg-danger">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li>
						<?php echo e($error); ?>

					</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
			<?php endif; ?>
			<div class="card card-block">
				<div class="card-header bg-info"><b>Add New Book</b></div>
				<form method="post" action="<?php echo e(route('Sancofa.Books.Added')); ?>">
					<?php echo csrf_field(); ?>
					<div class="card-body">
						<div class="form-group">
							<label for="name"><b>name of book</b></label>
							<input type="text" name="name" placeholder="name of the book" autofocus="autofocus" required="required" class="form-control" list="name_list">
							<?php if(!empty($unique_name)): ?>
							<datalist id="name_list">
							  <?php $__currentLoopData = $unique_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <option value="<?php echo e($name->book_name); ?>"></option>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</datalist>
							
							<?php endif; ?>
						</div>
						
						<div class="form-group">
							<label for="author"><b>Author</b></label>
							<input type="text" name="author" placeholder="author" required="required" class="form-control" list="author_list">

							<?php if(!empty($unique_author)): ?>
							<datalist id="author_list">
							<?php $__currentLoopData = $unique_author; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($author->book_author); ?>"></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</datalist>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="id"><b>book id</b></label>
							<input type="text" name="id" placeholder="book id"  class="form-control" list="book_id_list" >

							<?php if(!empty($unique_book_id)): ?>
							<datalist id="book_id_list">
							<?php $__currentLoopData = $unique_book_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($id->id); ?>"></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</datalist>
							<?php endif; ?>


						</div>

						<div class="form-group">
							<label for="number"><b>no of copies</b></label>
							<input type="number" name="number" required placeholder="number of copies" class="form-control" value = "1">
						</div>

						<div class="form-group">
							<label for="price"><b>price of the book</b></label>
							<input type="number" name="price" id="price" placeholder="price" required class="form-control">
						</div>

						<div class="form-group">
							<label for="catagory"><b>Catagory</b></label>
							<select name="catagory" id="catagory" class="form-control">
								<?php if(!empty($book_catagory)): ?>
								<?php $__currentLoopData = $book_catagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_catagory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option><?php echo e($single_catagory->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
								
							</select>
						</div>
						<div class="form-group">
							<label for="donate"><b> Donator </b></label>
							<input type="text" name="donate" id="donate" placeholder="book donater" required="required" class="form-control" list="donator_list">

							<?php if(!empty($unique_donator)): ?>
							<datalist id="donator_list">
							<?php $__currentLoopData = $unique_donator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($donator->donator); ?>"></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</datalist>
							<?php endif; ?>
						</div>	
						<button class="btn btn-primary" type="submit">Add</button>
					</div>
					
				</form>
			</div>
		</div>

     <div class = "col-md-3">
    <?php if(Session::has('generated_book')): ?>
      <div class = "container ">
        <h1 class ="bg-dark text-info">Generated Book Id</h1>
        <div class = "bg-info text-white">
          <?php echo e(Session::get('generated_book')); ?>

        </div><br>
        <div class ="bg-warning">dont refresh the page untill you write the id on the book <br> dont forgot adding 'acc-' before the number generated</div>
     </div>
    <?php endif; ?>
  </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/books/add.blade.php ENDPATH**/ ?>