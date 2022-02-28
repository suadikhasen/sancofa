@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			@if(Session::has('error'))
			 <div class="alert alert-danger bg-danger">
			 	{{Session::get('error')}}
			 </div>
			@endif

			@if(Session::has('success'))
			 <div class="alert alert-success bg-success">
			 	{{Session::get('success')}}
			 </div>
			@endif

			@if($errors->any())
			  <ul class="alert alert-danger bg-danger text-dark">
			  	  @foreach($errors->all() as $error)
			  	    <li>{{$error}}</li>
			  	  @endforeach
			  </ul> 
			@endif
		   <div class="card">
			  <div class="card-header bg-secondary text-white card-block">
			  	 {{'count '.$count->id}}
			  	 @if(!$count->close_status)
			  	   <a class="btn  btn-outline-success text-white float-right" href="{{route('Sancofa.Books.CountBooks.Finish',['id'=>$count->id])}}">Finish</a>
			  	 @endif
			  </div>
			  <div class="card-body">
			  	 <a href="{{route('Sancofa.Books.CountBooks.ListOfCountedBook',['id'=>$count->id])}}" class="btn btn-block btn-success ">Counted Books<span class="badge badge-info">{{$counted_books}}</span></a>
			  	 <a href="{{route('Sancofa.Books.CountBooks.ListOfUnCountedBooks',['id'=>$count->id])}}" class="btn btn-block btn-info ">Un Counted Books<span class="badge badge-danger">{{$un_counted_books}}</span></a>
			  	 <hr>
                 @if(!$count->close_status)
                   <form method="post" action="{{route('Sancofa.Books.CountBooks.Count',['id'=>$count->id])}}">
                   	   @csrf
                   	   <div class="form-group">
                   	   	  <label for="book_id">Enter Book Acc Number</label>
                   	   	  <input type="text" name="book_id" id="book_id" required value="acc-" class="form-control" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                   	   </div>
                   	   <button class="btn btn-primary mb-1" type="submit">count</button>
                   </form>
                 @endif
			  </div>
		   </div>
		</div>
	</div>
</div>
@endsection