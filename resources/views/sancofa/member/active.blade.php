@extends('sancofa.extends.main')
@section('tittle','list of active members')
@section('content')
<div class="container">
	<div class="col-md-10">
		@if(Session::has('deactive'))
		 <div class="alert alert-success bg-success">
		 	deactivated successfully
		 </div>
		@endif
		<a href="{{route('Sancofa.ActiveMembers.Add')}}">add new active member</a>

		@if(!empty($active_members))
		<span style="float: right">total {{' '.' '. $total}}</span>
		 <table class="table table-bordered table-hover">
		 	<thead class="thead-dark">
		 		<tr>
		 			<td scope="col">number</td>
		 			<td scope="col">full name</td>
		 			<td scope="col">sancofa id</td>
		 			<td scope="col">university id</td>
		 			<td scope="col">department</td>
		 			<td scope="col">tool</td>
		 		</tr>
		 	</thead>
		 	<tbody>
		 		@foreach($active_members as $member)
		 		<tr>
		 		   <td>{{($active_members->currentPage()-1)*$active_members->perPage()+$loop->iteration}}</td>
		 		   <td>{{$member->full_name}}</td>
		 		   <td>{{$member->sancofa_id}}</td>
		 		   <td>{{$member->university_id}}</td>
		 		   <td>{{$member->department}}</td>
		 		   <td>
		 		   	<a href="{{route('Sancofa.ActiveMembers.DeActive',['id' => $member->sancofa_id])}}" class="btn btn-primary btn-sm mb-1">de active</a><br/>
		 		   	<a href="{{route('Sancofa.ActiveMembers.ChangePassword',['id' => $member->sancofa_id])}}" class="btn btn-sm btn-success mb-1">change Password</a><br>
                    <a href="{{route('Sancofa.Members.Activity',['id'=>$member->sancofa_id])}}" class="btn btn-secondary btn-sm">Activity</a><br>
		 		   </td>
		 		</tr>
		 		@endforeach
		 	</tbody>
		 </table>
		 {{$active_members->links()}}
		@else
		 no active members
		@endif
	</div>
</div>
@endsection