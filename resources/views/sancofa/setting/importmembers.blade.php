@extends('sancofa.extends.setting')
@section('setting')
<div class="container col-md-5 mt-4">
	@if(Session::has('success'))
	 <div class="alert alert-success bg-success">
	 	{{Session::get('success')}}
	 </div>
	@endif
	@if($errors->any())
	  <div class="alert alert-danger bg-danger">
	  	 <ul>
	  	 	@foreach($errors->all() as $error)
	  	 	  <li>{{$error}}</li>
	  	 	@endforeach
	  	 </ul>
	  </div>
	@endif

	@if(Session::has('error'))
	 <div class="alert alert-danger bg-danger">
	 	{{Session::get('error')}}
	 </div>
	@endif
	<form  method="post" action="{{route('Sancofa.Setting.MemberImporting')}}" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label id="member">upload csv file</label>
			<input type="file" name="member" id="member" class="form-control-file" placeholder="upload" required>
		</div>
		<button class="btn btn-primary" type="submit">Upload</button>
	</form>
</div>
@endsection