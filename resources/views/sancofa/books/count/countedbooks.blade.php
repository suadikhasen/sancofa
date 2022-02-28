@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			@if(count($counted_books) >0)
			 <h2 class="text-dark">{{'counted books for count '.$id}}</h2>
			 <table class="table table-bordered table-hover">
			 	<thead>
			 		<tr>
			 			<th scope="col">#</th>
			 			<th scope="col">book name</th>
			 			<th scope="col">book id</th>
			 		</tr>
			 	</thead>
			 	<tbody>
			 		@foreach($counted_books as $book)
			 		 <tr>
			 		  <td>{{(($counted_books->currentPage()-1)*$counted_books->perPage())+$loop->iteration}}</td>
			 		  <td>{{$book->books->book_name}}</td>
			 		  <td>{{$book->books->book_id}}</td>
			 		</tr>
			 		@endforeach
			 	</tbody>
			 </table>
			 {{$counted_books->links()}}
			@else
			  no counted books
			@endif
		</div>
	</div>
</div>
@endsection