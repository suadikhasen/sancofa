@inject('activityService','App\Http\Controllers\Sancofa\Service\Activity')
@extends('sancofa.extends.main')
@section('content')
@if(!empty($grouped_activity) && count($grouped_activity) >0)
 <h1 >{{$full_name}} activity for last five days on Reserving Books</h1>
 @foreach($grouped_activity as $activity_date)
   <h4 class="text-dark bg-primary text-md-center">on {{$activityService->actionDate($grouped_activity,$loop->iteration)}}</h4>
   @foreach($activity_date as $activity)
   <b>@if($activityService->activityStatus($activity_date,$loop->iteration) == 'created') New Reserved Books
   @else
     Notified Books After Reservation 
    @endif
 </b>
   <table class="table table-hover table-bordered">
      <thead>
      	<tr>
      		<th scope="col">#</th>
      		<th scope="col">Book Id</th>
      		<th scope="col">Book Name</th>
            <th scope="col">Reserver Name</th>
            <th scope="col">Reserver id</th>
      		<th scope="col">Action Date</th>
      	</tr>
      </thead>
      <tbody>
      	 @foreach($activity as $single_activity)
	      	 <tr>
	           <td>{{$loop->iteration}}</td>
	           <td>{{$single_activity->ReservedBooks->book->book_id}}</td>
	           <td>{{$single_activity->ReservedBooks->book->book_name}}</td>
              <td>{{$single_activity->ReservedBooks->member->full_name}}</td>
              <td>{{$single_activity->ReservedBooks->member->sancofa_id}}</td>
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