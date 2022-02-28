@inject('punishment','App\Http\Controllers\Sancofa\Service\Punishment')
@extends('sancofa.extends.main')
@section('tittle','list of punished members')
@section('content')
@if(!empty($panished_members))
 <div class="container">
 	@if(Session::has('paid'))
 	 <div class="alert alert-success bg-success">
 	 	{{Session::get('paid')}}
 	 </div>
 	@endif
 	<table class="table table-bordered table-hover">
 		<thead>
 			<tr>
 				<th scope="col">number</th>
 				<th scope="col">full name</th>
 				<th scope="col">sancofa id</th>
 				<th scope="col">amount</th>
 				<th scope="col">pay</th>

 			</tr>
 		</thead>
 		<tbody>
 			@foreach($panished_members as $member)
 			  <tr>
 			  	<td>{{($panished_members->currentPage()-1)*$panished_members->perPage()+$loop->iteration}}</td>
 			  	<td>{{$member->book_members->reciever->full_name}}</td>
 			  	<td>{{$member->book_members->reciever->sancofa_id}}</td>
 			  	<td>{{$member->punishment}} Birr</td>
 			  	<td><a href="{{route('Sancofa.Punishment.Pay',['b_id'=>$member->borrower_id,'p_id'=>$member->id])}}">pay</a></td>
 			  </tr>
 			@endforeach
 		</tbody>
 	</table>
 	{{$panished_members->links()}}
 </div>
@else
no panished member who return the book
@endif
@endsection