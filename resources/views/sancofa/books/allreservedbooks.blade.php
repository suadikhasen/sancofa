@inject('return','App\Http\Controllers\Sancofa\Service\BookReturnStatus')
@extends('sancofa.extends.main')
@section('content')
<div class="container-fluid">
	@if(Session::has('success'))
	 <div class="alert alert-success bg-success">{{Session::get('success')}}</div>
	@endif
	@if(isset($all_reserved_books))
	  <table class="table table-hover table-bordered table-responsive">
	  	 <thead>
	  	 	<tr>
	  	 		<th scope="col">number</th>
	  	 		<th scope="col">book name</th>
	  	 		<th scope="col">book id</th>
	  	 		<th scope="col">book reserver</th>
	  	 		<th scope="col">reserver sancofa id</th>
	  	 		<th scope="col">address</th>
	  	 		<th scope="col">phone number</th>
	  	 		<th scope="col">book return status</th>
	  	 		<th scope="col">notification status</th>
	  	 	</tr>
	  	 </thead>
	  	 <tbody>
	  	 	@foreach($all_reserved_books as $reserved)
	  	 	 <tr>
	  	 	 	<td>{{(($all_reserved_books->currentPage()-1)*$all_reserved_books->perPage())+$loop->iteration}}</td>
	  	 	 	<td>{{$reserved->book->book_name}}</td>
	  	 	 	<td>{{$reserved->book->book_id}}</td>
	  	 	 	<td>{{$reserved->member->full_name}}</td>
	  	 	 	<td>{{$reserved->member->sancofa_id}}</td>
	  	 	 	<td>{{$reserved->member->address}}</td>
	  	 	 	<td>
	  	 	 		@if(Auth::guard('sancofa')->user()->role == 'admin')
	  	 	 		{{$reserved->member->phone_no}}
	  	 	 		@else
	  	 	 		 *********
	  	 	 		@endif
	  	 	 	</td>
	  	 	 	<td>
	  	 	 		@if($return->check($reserved->book->book_id))
	  	 	 		 <p class="text-success">Book Returned</p>
	  	 	 		@else
	  	 	 		 <p class="text-warning">Book Not Returned</p>
	  	 	 		@endif
	  	 	 	</td>
	  	 	 	<td><a href="{{route('Sancofa.Books.ReserveNotify',['id'=>$reserved->id])}}" class="btn btn-sm btn-primary">notify</a></td>
	  	 	 </tr>
	  	 	@endforeach
	  	 </tbody>
	  </table>
	  {{$all_reserved_books->links()}}
	@else
	no reserved books
	@endif
</div>
@endsection