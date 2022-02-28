@extends('sancofa.extends.main')
@section('content')
 <div class=" mt-3 col-md-4">
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
	<form method="post" action="{{route('Sancofa.Others.MemberAddingToMonthlyPayment',['year' => $year])}}">
		@csrf
		<div class="form-group">
			<label for="sancofa_id"><b>Enter Sancofa Id</b></label>
			<input type="text" name="sancofa_id" placeholder="enter sancofa id " class="form-control" required autofocus>
			
		</div>
		<button type="submit" class="btn btn-primary">Add</button>
	</form>

 </div>
 <a href="{{route('Sancofa.Others.MonthlyPaymentYear',['year' => $year])}}" class="btn btn-success btn-block mt-3">Return To Payment Page</a>
@endsection