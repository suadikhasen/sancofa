@inject('activityService','App\Http\Controllers\Sancofa\Service\Activity')
@inject('return','App\Http\Controllers\Sancofa\Service\BookReturnStatus')
@inject('month_name','App\Http\Controllers\Sancofa\Service\Activity')
@extends('sancofa.extends.main')
@section('content')
@if(!empty($grouped_activity) && count($grouped_activity) >0)
 @if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.DetailInMonth')
  <h1 >{{$full_name}} Activity  In {{$month_name->monthName($month).'  '.$year}} on Books And Members</h1>
 @else
 <h1 >{{$full_name}} activity for last 30 days on books and members</h1>
 @endif
 @foreach($grouped_activity as $activity_date)
   <h4 class="text-dark bg-primary text-md-center">on {{$activityService->actionDate($grouped_activity,$loop->iteration)}}</h4>
   @foreach($activity_date as $activity)
   <b>@if($activityService->activityStatus($activity_date,$loop->iteration) == 'created')books borrowed by {{$full_name}} @else Other Activities @endif</b>
   <table class="table table-hover table-bordered">
      <thead>
      	<tr>
      		<th scope="col">#</th>
      		<th scope="col">book_id</th>
      		<th scope="col">book_name</th>
      		<th scope="col">Reciever Id</th>
            <th scope="col">Reciever Name</th>
            <th scope="col">Return Status</th>
            <th scope="col">Action Date</th>
            @if($activityService->activityStatus($activity_date,$loop->iteration) == 'updated') <th>More</th> @endif
      	</tr>
      </thead>
      <tbody>
      	 @foreach($activity as $single_activity)
	      	 <tr>
	           <td>{{$loop->iteration}}</td>
	           <td>{{$single_activity->book_with_book_and_members->book_id}}</td>
	           <td>{{$single_activity->book_with_book_and_members->book_name}}</td>
              <td>{{$single_activity->member_with_book_and_members->sancofa_id}}</td>
              <td>{{$single_activity->member_with_book_and_members->full_name}}</td>
              <td>
                 @if($return->check($single_activity->book_with_book_and_members->book_id))
                  <p class="text-success">returned</p>
                 @else
                 <p class="text-danger">not returned</p>
                 @endif
              </td>
	           <td>{{$single_activity->created_at}}</td>
             @if($activityService->activityStatus($activity_date,$loop->parent->iteration) == 'updated')
             <td>
              <a href="{{route('Sancofa.Members.DetailOnUpdates',['id'=>$single_activity->id])}}">Detail</a>
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
