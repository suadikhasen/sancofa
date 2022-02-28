@extends('sancofa.extends.main')
@section('content')
<h2 class="font-italic text-center text-info">{{$year.' Monthly Payment '.$monthly_payment->amount.' Birr  Per Month'}} </h2><br>
<div class="row mb-1">
   
   <div class="col-md-3">
   	 @if(!$monthly_payment->status)
   	 <a href="{{route('Sancofa.Others.AddMembersToPayment',['year'=>$year])}}" class="btn btn-sm btn-primary " >Add Members  To This  Payment</a>
   	 @endif
   </div>

   <div class="col-md-3">
	  	
	  	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="{{route('Sancofa.Others.SearchInMonthlyPayment',['year' => $year])}}">
	 	    @csrf
            <div class="input-group">
              <input type="text" class="form-control  " placeholder="Search by sancofa id" aria-label="Search" aria-describedby="basic-addon2" name="search" autofocus>
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div><br>
       </form>
	</div>
	
	<div class="col-md-3">
	@if(Auth::guard('sancofa')->user()->role == 'admin')
	  @if($monthly_payment->status)
	    <b class="text-success float-right">closed</b>
	  @else
	  <a href="{{route('Sancofa.Others.CloseMonthlyPayment',['year' => $year])}}" class="font-weight-bolder btn btn-success float-right">Close</a>
      @endif
	@endif
	<b class="text-success">Total paid:{{'  '.$total_payment_collected.' Birr'}}</b>
	</div>
	
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
</div>
@if(!empty($list))
<div class="row">
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Full Name</th>
				<th scope="col">Sankofa  Id</th>
				<th scope="col">September</th>
				<th scope="col">October</th>
				<th scope="col">November</th>
				<th scope="col">December</th>
				<th scope="col">January</th>
				<th scope="col">February</th>
				<th scope="col"> March  </th>
				<th scope="col"> April  </th>
				<th scope="col"> May  </th>
				<th scope="col"> June  </th>
				<th scope="col"> July  </th>
				<th scope="col"> August  </th>
			</tr>
		</thead>
		<tbody>
			@foreach($list as $single)
			 <tr>
			 	<td>{{(($list->currentPage()-1)*$list->perPage())+$loop->iteration}}</td>
			 	<td>{{$single->sancofaUser->full_name}}</td>
			 	<td>{{$single->sancofaUser->sancofa_id}}</td>
			 	<td>
			 		@if($single->september)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'september','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->october)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'october','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->november)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'november','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->december)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'december','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->january)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'january','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->february)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'february','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->march)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'march','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->april)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'april','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->may)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'may','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->june)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'june','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->july)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'july','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 	<td>
			 		@if($single->august)
			 		 <b class="text-success">paid</b>
			 		@else
			 		 <small class="text-danger">Not </small><br>
			 		 <a href="{{route('Sancofa.Others.PaidingMonthlyPayment',['id' => $single->id,'month' => 'august','year'=>$year])}}" class="btn btn-sm btn-secondary text-white">Pay</a>
			 		@endif
			 	</td>
			 </tr>
			@endforeach
		</tbody>
	</table>
</div>
@endif
@endsection