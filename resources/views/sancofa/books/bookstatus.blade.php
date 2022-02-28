@inject('amharic','App\Http\Controllers\Sancofa\Service\AmharicDate')
@extends('sancofa.extends.main')
@section('tittle','all book status')
@section('content')
<div class="container">
	@if(!empty($books))
	<b class="">total process {{$total}}</b>
	<table class="table table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th scope="col">number</th>
				<th scope="col">book tittle</th>
				<th scope="col">book id</th>
				<th scope="col">giver name</th>
				<th scope="col">reciever name</th>
				<th scope="col">giving date</th>
				<th scope="col">returning/ed date</th>
				<th scope="col">borrowing id</th>
			</tr>
		</thead>
		<tbody>
			@foreach($books as $book)
				 <tr class="@if($book->approve && $book->punishment) bg-success text-white @endif @if(!($book->approve)) bg-warning @endif @if($book->approve && !($book->punishment)) bg-danger text-white @endif">
				 	<td>{{(($books->currentPage()-1)*$books->perPage())+$loop->iteration}}</td>
				 	<td>{{$book->book->book_name}}</td>
				 	<td>{{$book->book->book_id}}</td>
				 	<td>{{$book->giver->full_name}}</td>
				 	<td>{{$book->reciever->full_name}}</td>
				 	<td>{{$amharic->amharicDateTime($book->giving_date)}}</td>
				 	<td>{{$amharic->amharicDateTime($book->returned_date)}}</td>
				 	<td>{{$book->id}}</td>
				 </tr>
			@endforeach
		</tbody>
	</table>
	{{$books->links()}}
	@endif
</div>
@endsection