@extends('sancofa.extends.main')
@section('content')
<div class="container col-md-4">
	@if($errors->any())
	 <div class="alert alert-danger bg-danger">
	 	<ul>
	 		@foreach($errors->all() as $error)
	 		 <li>{{$error}}</li>
	 		@endforeach
	 	</ul>
	 </div>
	@endif

	@if(Session::has('success'))
	 <div class="alert alert-success bg-success">
	 	{{Session::get('success')}}
	 </div>
	@endif

	@if(Session::has('error'))
	 <div class="alert alert-danger bg-danger">
	 	{{Session::get('error')}}
	 </div>
	@endif
	<form method="post" action="{{route('Sancofa.Books.ReservedBook',['id'=>$id])}}">
		@csrf
		<div class="form-group" >
			<label for="sancofa_id">Enter Member Sancofa Id</label>
			<input type="text" name="sancofa_id" id="sancofa_id" class="form-control"  placeholder="sancofa id" autofocus="autofocus" required>
		</div>
		<button class="btn btn-primary" type="submit">Reserve</button>
	</form>
</div>
@endsection