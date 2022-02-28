@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="col-md-6">
		@if(Session::has('count'))
		  <div class="alert alert-danger">
		  	 {{Session::get('count')}}
		  </div>
		@endif

		@if(Session::has('message'))
		  <div class="alert alert-success bg-success">
		  	 {{Session::get('message')}}
		  </div>
		@endif

		<a class="btn btn-block btn-success mb-3" href="{{route('Sancofa.Books.CountBooks.Create')}}">Create New Book Counting</a>
		@if(isset($count_books))
		  <table class="table table-bordered table-hover table-secondary">
		  	 <thead class="bg-info text-white">
		  	 	<tr>
		  	 		<th scope="col">#</th>
		  	 		<th scope="col">count name</th>
		  	 		<th scope="col"> status</th>
		  	 		<th scope="col">starting date</th>
		  	 		<th scope="col">End Date</th>
		  	 		<th scope="col">Detail</th>
		  	 	</tr>
		  	 </thead>
		  	 <tbody>
		  	 	@foreach($count_books as $single_count)
		  	 	  <tr>
		  	 	  	<td>{{(($count_books->currentPage()-1)*$count_books->perPage()) + $loop->iteration}}</td>
		  	 	  	<td>{{'Count '.$single_count->id}}</td>
		  	 	  	<td>
		  	 	  		@if($single_count->close_status)
                         <b class="text-success">Finished</b>
                        @else
                         <b class="text-danger">Open</b>
		  	 	  		@endif
		  	 	  	</td>
		  	 	  	<td>{{$single_count->created_at}}</td>
		  	 	  	<td>
		  	 	  		@if($single_count->close_status)
                          <p>{{$single_count->created_at}}</p>
                        @else
                         <b class="text-danger">not finished</b>
		  	 	  		@endif
		  	 	  	</td>
                     
		  	 	  	<td>
		  	 	  		<a class="btn btn-primary btn-sm" href="{{route('Sancofa.Books.CountBooks.CountBooksPage',['id'=>$single_count->id])}}">Detail</a>
		  	 	  	</td>
		  	 	  </tr>
		  	 	@endforeach
		  	 </tbody>
		  </table>
		  {{$count_books->links()}}
		@else
		 No Recorded Count
		@endif
	</div>
</div>
@endsection