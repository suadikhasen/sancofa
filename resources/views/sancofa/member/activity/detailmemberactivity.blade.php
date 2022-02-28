@inject('activityService','App\Http\Controllers\Sancofa\Service\Activity')
@inject('month_name','App\Http\Controllers\Sancofa\Service\Activity')
@inject('payment_month','App\Http\Controllers\Sancofa\Service\Activity')
@extends('sancofa.extends.main')
@section('content')
@if(!empty($grouped_activity) && count($grouped_activity) >0)
 @if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.DetailInMonth')
  <h1 >{{$full_name}} Activity  In {{$month_name->monthName($month).'  '.$year}} on Members</h1>
 @else
 <h1 >{{$full_name}} activity for last 30 days on Members</h1>
 @endif
 @foreach($grouped_activity as $activity_date)
   <h4 class="text-dark bg-primary text-md-center">on {{$activityService->actionDate($grouped_activity,$loop->iteration)}}</h4>
   @foreach($activity_date as $activity)
   <b>@if($activityService->activityStatus($activity_date,$loop->iteration) == 'created') Newly Registered Members
   @else
    Edited Members and his/her updated activity
    @endif
 </b>
   <table class="table table-hover table-bordered">
      <thead>
      	<tr>
      		<th scope="col">#</th>
      		<th scope="col">Sancofa Id</th>
      		<th scope="col">Full Name</th>
      		<th scope="col">Action Date</th>
      		@if($activityService->activityStatus($activity_date,$loop->iteration) == 'updated')
      		 <th scope="col">More</th>
      		@endif
      	</tr>
      </thead>
      <tbody>
      	 @foreach($activity as $single_activity)
	      	 <tr>
	           <td>{{$loop->iteration}}</td>
	           <td>{{$single_activity->members->sancofa_id}}</td>
	           <td>{{$single_activity->members->full_name}}</td>
	           <td>{{$single_activity->created_at}}</td>
	           @if($activityService->activityStatus($activity_date,$loop->parent->iteration) == 'updated')
	            <td>
                <a href="#">Detail</a>
              </td>
	           @endif	
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