@extends('sancofa.extends.main')
@section('content')
<div class="container mt-2">
	@if(Session::has('success'))
 	 <div class="alert alert-success">
 	 	{{Session::get('success')}}
 	 </div>
 	@endif
	<form method="post" action="{{route('Sancofa.Setting.RenameCatagory',['id' => $id])}}" class="col-md-5">
		@csrf
		<div class="form-group ">
			<input type="text" name="rename" class="form-control" placeholder="enter catagory name" required="required" autofocus>
		</div>
		<button type="submit" class="btn btn-primary">Rename</button>
	</form>
</div>
@endsection