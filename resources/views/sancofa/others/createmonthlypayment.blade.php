@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="col-md-6">
		@if(Session::has('fail'))
		 <div class="alert alert-danger bg-danger">
		 	{{Session::get('fail')}}
		 </div>
		@endif

		@if(Session::has('success'))
		 <div class="alert alert-success bg-success">
		 	{{Session::get('success')}}
		 </div>
		@endif
        
        @if($errors->any())
	        <ul class="alert alert-danger bg-danger"> 
	        	@foreach($errors->all() as $error)
	        	  <li>{{$error}}</li>
	        	@endforeach
	        </ul>
        @endif

		<form method="post" action="{{route('Sancofa.Others.MonthlyPaymentCreating')}}">
			@csrf
			<div class="form-group">
				<label for="year">Enter Ethiopian Year</label>
				<input type="number" name="year" id="year" autofocus class="form-control" required >
			</div>
            <div class="form-group">
				<label for="amount">Enter Montly Payment Amount</label>
				<input type="number" name="amount" id="amount" class="form-control" required>
			</div>
			<button type="submit" class="btn btn-primary">create</button>
		</form>
		
	</div>
</div>
@endsection