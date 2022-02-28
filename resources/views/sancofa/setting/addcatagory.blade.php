@extends('sancofa.extends.setting')
@section('setting')
<div class="container col-md-6 mt-3">
	@if(Session::has('success'))
	  <div class="alert alert-success bg-success">
	  	  {{Session::get('success')}}
	  </div>
	@endif

	@if($errors->any())
	 @foreach($errors->all() as $error)
	  <div class="alert alert-danger bg-danger">
	  	 {{$error}}
	  </div>
	 @endforeach
	@endif
	<form method="post"  action="{{route('Sancofa.Setting.CatagoryAdded')}}">
		@csrf
		<div class="form-group">
			<label for="catagory"></label>
			<input type="text" name="catagory" class="form-control" required="required" autofocus="autofocus" placeholder="please insert caagory name" id="catagory">
		</div>
		<button class="btn btn-primary" type="submit">Add</button>
	</form>
</div>
@endsection