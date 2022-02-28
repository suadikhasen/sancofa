@extends('sancofa.extends.main')
@section('content')
@if(!empty($borrowed_history))
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2 class="font-weight-bolder font-italic text-info">{{$user->full_name.' - Borrowing History'}}</h2>
			<table class="table  table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Book Name</th>
						<th scope="col">Book Id</th>
						<th scope="col">Return Status</th>
						<th scope="col">Borrowing Date</th>
						<th scope="col">Returning/ed Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach($borrowed_history as $history)
					  <tr>
					  	<td>{{(($borrowed_history->currentPage()-1)*$borrowed_history->perPage()) + $loop->iteration}}</td>
					  	<td>{{$history->book->book_name}}</td>
					  	<td>{{$history->book->book_id}}</td>
					  	<td>
					  		@if($history->approve)
					  		 <b class="text-success">returned</b>
					  		 @else
					  		  <b class="text-danger">Not Returned</b>
					  		@endif
					  	</td>
					  	<td>
					  		{{$history->giving_date}}
					  	</td>
					  	<td>{{$history->returned_date}}</td>
					  </tr>
					@endforeach
				</tbody>
			</table>
			{{$borrowed_history->links()}}
		</div>
	</div>
</div>
@endif
@endsection