@extends('sancofa.extends.main')
@section('tittle','adding address')
@section('content')
 <div class="container">
 	<div class="row">
 		<div class="col-md-6">
 			@if(Session::has('address'))
 			 <div class="alert alert-success">
 			 	{{Session::get('address')}}
 			 </div>
 			@endif

 			<form method="post" action="{{route('Sancofa.Members.SubmitAddress',['id' => $id])}}">
 				@csrf
 				<div class="form-group">
 					<label for="address">address</label>
 					<input type="text" name="address" placeholder="address" required="required" class="form-control" autofocus value="ch-  dorm-" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
 				</div>
 				<button class="btn btn-primary" type="submit">Save</button>
 			</form>
 		</div>
 	</div>
 </div>
@endsection