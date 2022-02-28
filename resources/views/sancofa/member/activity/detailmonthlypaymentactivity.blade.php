@inject('activityService','App\Http\Controllers\Sancofa\Service\Activity')
@inject('month_name','App\Http\Controllers\Sancofa\Service\Activity')
@inject('payment_month','App\Http\Controllers\Sancofa\Service\Activity')
@extends('sancofa.extends.main')
@section('content')
@if(!empty($grouped_activity) && count($grouped_activity) > 0)
 @if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.DetailInMonth')
  <h1 >{{$full_name}} Activity  In {{$month_name->monthName($month).'  '.$year}} on Monthly Payment</h1>
 @else
 <h1 >{{$full_name}} activity for last 30 days on Monthly Payment</h1>
 @endif
 @foreach($grouped_activity as $activity_date)
 <h4 class="text-dark bg-primary text-md-center">on {{$activityService->actionDate($grouped_activity,$loop->iteration)}}</h4>
 @foreach($activity_date as $activity)
   <b class="text-success">
   	@if($activityService->activityStatus($activity_date,$loop->iteration) == 'created') 
      Members Added To The Payment by {{$full_name}}
    @else
      <p>Members Who Pay Monthly Payment by {{$full_name}}</p>
      <small>Notice:<small class="text-info">every monthly payment is considered as one activity</small></small>
    @endif
 </b>
 <table class="table table-bordered table-hover">
 	<thead>
      	<tr>
      		<th scope="col">#</th>
      		<th scope="col">Sancofa Id</th>
      		<th scope="col">Full Name</th>
      		<th scope="col">Payment Name</th>
      		@if($activityService->activityStatus($activity_date,$loop->iteration) == 'updated')
      		 <th scope="col">Payment Month</th>
      		@endif
      		<th scope="col">Action Date</th>
      		
      	</tr>
      </thead>
      <tbody>
      	 @foreach($activity as $single_activity)
	      	 <tr>
	           <td>{{$loop->iteration}}</td>
	           <td>{{$single_activity->monthlyPayment->sancofaUser->sancofa_id}}</td>
	           <td>{{$single_activity->monthlyPayment->sancofaUser->full_name}}</td>
	           <td>{{$single_activity->monthlyPayment->year.' Monthly Payment'}}</td> 
	           @if($activityService->activityStatus($activity_date,$loop->parent->iteration) == 'updated')
	             <td>
                  {{$payment_month->paymentMonth($single_activity->id)}}
                </td>
      		   @endif
	           <td>{{$single_activity->created_at}}</td>
	           

	         </tr>
      	 @endforeach
      </tbody>
 </table>
 @endforeach
 @endforeach
@else 
 no activity
@endif
@endsection