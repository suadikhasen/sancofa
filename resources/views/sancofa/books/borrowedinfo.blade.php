@inject('amharic','App\Http\Controllers\Sancofa\Service\AmharicDate')
@extends('sancofa.extends.main')
@section('tittle','borrowed information')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="card text-white bg-dark ml-5">
				<div class="card-header text-dark badge-primary">
					borrowed information
				</div>
				<div class="card-body">
					<p>reciever name : {{$borrower->reciever->full_name}}</p>

					<p>giver name : {{$borrower->giver->full_name}}</p>
					<p>book tittle : {{$borrower->book->book_name}}</p>
					<p>book id : {{$borrower->book->book_id}}</p>
					<p>borrowing date : {{$amharic->amharicDateTime($borrower->giving_date)}}</p>
					<p>returned date : {{$amharic->amharicDateTime($borrower->returned_date)}}</p>
					<p>borrowing id:{{$borrower->id}}</p>
				</div>
			</div>
		</div>
	</div>
	<br>
	<a class="btn btn-success btn-block text-md-center font-weight-bold" href="{{route('Sancofa.Books.Borrowing')}}">Return to Lend Page</a>
</div>
@endsection