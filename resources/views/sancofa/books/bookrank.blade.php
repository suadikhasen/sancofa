@extends('sancofa.extends.main')
@section('content')
@if(!empty($ranked_books && count($ranked_books)))
 <div class="row">
 	<div class="col-md-4">
 		<h2>{{$year}} book rank</h2>
 		<table class="table table-bordered  table-hover">
 			<thead>
 				<tr>
 					<th scope="col">#</th>
 					<th scope="col">Book Tittle</th>
 					<th scope="col">Number Of Reading</th>
 				</tr>
 			</thead>
 			<tbody>
 				@foreach($ranked_books as $book)
 				 <tr>
 				 	<td>{{(($ranked_books->currentPage()-1)*$ranked_books->perPage())+$loop->iteration}}</td>
 				 	<td>{{$book->book_name}}</td>
 				 	<td>{{$book->no_reading}}</td>
 				 </tr>
 				@endforeach
 			</tbody>
 		</table>
 		{{$ranked_books->links()}}
 	</div>

 </div>
@endif
@endsection