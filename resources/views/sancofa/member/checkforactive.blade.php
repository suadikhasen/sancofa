@extends('sancofa.extends.main')
@section('tittle','add active members')
@section('content')
 <div class="container">
 	<div class="row">
 		<div class="col-md-6">
 			@if($errors->any())
 			  @foreach($errors->all() as $error)
 			   <div class="alert alert-danger">
 			   	 {{$error}}
 			   </div>
 			  @endforeach
 			@endif
 			<form method="get" action="{{route('Sancofa.ActiveMembers.Find')}}">
 				@csrf
 				<div class="form-group form-inline ">
 					<input type="text" name="sancofa_id" id="sancofa_id" class="form-control mr-2" required="required" autofocus="autofocus" placeholder="sancofa id">
 					<button class="btn btn-success" type="submit">find</button>
 				</div>
 			</form>
 		</div>
 	</div>
 </div>
@endsection