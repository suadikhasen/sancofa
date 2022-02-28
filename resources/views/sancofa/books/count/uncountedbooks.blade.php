@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			@if(count($un_counted_books) >0)
			 <div>
			 	<h2 class="text-dark">{{'Un Counted Books For Count '.$id}}</h2>
			 	<b class="text-success float-right">total {{$total}}</b>
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
			 		@foreach($un_counted_books as $book)
			 		 <tr>
			 		  <td>{{(($un_counted_books->currentPage()-1)*$un_counted_books->perPage())+$loop->iteration}}</td>
			 		  <td>{{$book->book_name}}</td>
			 		  <td>{{$book->book_id}}</td>
			 		  <td>{{$book->book_author}}</td>
			 		  <td>
			 		  	@if($book->status)
                           <b style="color:green;">active</b>
                        @else
                           <b style="color:red;">lost</b>
                        @endif
					  </td>
	                  <td>
					   	<a href="{{route('Sancofa.Books.CountBooks.MakeLost',['id'=> $book->book_id,'count' => $id])}}" class="btn btn-danger btn-sm mb-2 @if(!$book->status)

					   	 disabled @endif ">make lost</a><br>
					  </td>
			 		</tr>
			 		@endforeach
			 	</tbody>
			 </table>
			 {{$un_counted_books->links()}}
			@else
			  No Un Counted Books
			@endif
		</div>
	</div>
</div>
@endsection