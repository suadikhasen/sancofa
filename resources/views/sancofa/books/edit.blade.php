@extends('sancofa.extends.main')
@section('tittle','adding book')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			@if(Session::has('error'))
			  <div class="alert alert-danger bg-danger">
			  	 {{Session::get('error')}}
			  </div>
			@endif
			@if(Session::has('book_added'))
			 <div class="alert alert-success bg-success">
			 	{{Session::get('book_added')}}
			 </div>
			@endif
			@if($errors->any())
			<div class="alert alert-danger bg-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>
						{{$error}}
					</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="card card-block">
				<div class="card-header bg-info"><b>Edit Book</b></div>
				<form method="post" action="{{route('Sancofa.Books.Update',['id'=>$book_info->book_id])}}">
					@csrf
					<div class="card-body">
                      
                      <div class="form-group">
							<label for="id"><b>book id</b></label>
							<input type="text" name="id" placeholder="book id"  class="form-control" list="book_id_list" value="{{$book_info->book_id}}" disabled>

							@if(!empty($unique_book_id))
							<datalist id="book_id_list">
							@foreach($unique_book_id as $id)
                             <option value="{{$id->id}}"></option>
							@endforeach
							</datalist>
							@endif

					</div>
                    
                        
						<div class="form-group">
							<label for="name"><b>name of book</b></label>
							<input type="text" name="name" placeholder="name of the book" autofocus="autofocus" required="required" class="form-control" list="name_list" value = "{{$book_info->book_name}}">
							@if(!empty($unique_name))
							<datalist id="name_list">
							  @foreach($unique_name as $name)
							  <option value="{{$name->book_name}}"></option>
							  @endforeach
							</datalist>
							
							@endif
						</div>
						
						<div class="form-group">
							<label for="author"><b>Author</b></label>
							<input type="text" name="author" placeholder="author" required="required" class="form-control" value = "{{$book_info->book_author}}" list="author_list">

							@if(!empty($unique_author))
							<datalist id="author_list">
							@foreach($unique_author as $author)
                             <option value="{{$author->book_author}}"></option>
							@endforeach
							</datalist>
							@endif
						</div>

						<div class="form-group">
							<label for="price"><b>price of the book</b></label>
							<input type="number" name="price" id="price" placeholder="price" required class="form-control" value = "{{$book_info->price}}">
						</div>

						<div class="form-group">
							<label for="catagory"><b>Catagory</b></label>
							<select name="catagory" id="catagory" class="form-control">
								@if(!empty($book_catagory))
								@foreach($book_catagory as $single_catagory)
								<option>{{$single_catagory->name}}</option>
								@endforeach
								@endif
								
							</select>
						</div>

						<div class="form-group">
							<label for="donate"><b> Donator </b></label>
							<input type="text" name="donate" id="donate" placeholder="book donater" required="required" class="form-control" list="donator_list" value = "{{$book_info->donator}}">

							@if(!empty($unique_donator))
							<datalist id="donator_list">
							@foreach($unique_donator as $donator)
                             <option value="{{$donator->donator}}"></option>
							@endforeach
							</datalist>
							@endif
						</div>	
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
