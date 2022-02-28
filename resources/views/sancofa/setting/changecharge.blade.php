@extends('sancofa.extends.setting')
@section('setting')
<div class="container col-md-5 mt-2">
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
	<form method="get" action="{{route('Sancofa.Setting.ChangedPayment',['id' => $id])}}">
		<div class="form-group">
			<label for="amount">Amount</label>
			<input type="text" name="amount" class="form-control" required autofocus id="amount">
		</div>
		<button class="btn btn-success" type="submit">Change</button>
	</form>
</div>
@endsection