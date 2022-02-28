@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="bg-danger col-md-4">
		<p class="text-white">please sure you are leaving admin account
         and sure the member is active member
		</p>
	</div>
	@if($errors->any())
	 <div class="alert alert-danger">
	 @foreach($errors->all() as $error)
	    <li>{{$error}}</li>
	 @endforeach
	</div>
	@endif
	@if(Session::has('error'))
	 <div class="alert alert-danger bg-danger">
	 	{{Session::get('error')}}
	 </div>
	@endif
	<form method="post" action="{{route('Sancofa.Profile.AdminTransferring')}}">
		<div class="form-group col-md-4">
			@csrf
			<label for="sancofa_id">sancofa id</label>
			<input type="text" name="sancofa_id" id="sancofa_id" placeholder="sancofa id" required autofocus class="form-control">
		</div>
		<button class="btn btn-primary btn-sm" type="submit">Transfer</button>
	</form>
</div>
@endsection