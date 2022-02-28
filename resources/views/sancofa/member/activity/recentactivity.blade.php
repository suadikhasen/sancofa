@extends('sancofa.extends.main')
@inject('month_name','App\Http\Controllers\Sancofa\Service\Activity')
@section('content')
@if(!empty($last_activity) && count($last_activity) > 0)
 <div class="container">
 	<div class="row">
 		<div class="col-md-4 mt-5">
 			<div class="text-info font-weight-bold font-italic mb-1">
            @if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.Month')
              {{$full_name}} Activities On {{$month_name->monthName($month).'  '.$year}}
            @else
             {{$full_name}} Last 30 Days Activities
            @endif
 			</div>
		 	<table class="table table-hover table-bordered table-responsive">
		 		<thead class="alert-success">
		 			<tr>
		 				<th scope="col">#</th>
		 				<th scope="col">On</th>
		 				<th scope="col">Number Of Activities</th>
		 				<th scope="col">Tools</th>
		 			</tr>
		 		</thead>
		 		<tbody>
		 			@foreach($last_activity as $activity)
		 			 <tr>
		 			 	<td>{{$loop->iteration}}</td>
		 			 	<td>{{$activity->log_name}}</td>
		 			 	<td>{{$activity->total}}</td>
		 			 	<td><a href="
		 			 		@if(Route::currentRouteName() == 'Sancofa.Members.AllActivities.Month')
		 			 		 {{route('Sancofa.Members.AllActivities.DetailInMonth',[
		 			 		 'id'=>$id,
		 			 		 'year'=>$year,
		 			 		 'month'=>$month,
		 			 		 'log_name'=>$activity->log_name,
		 			 		 ])}}
		 			 		@else
		 			 		{{route('Sancofa.Members.DetailRecentActiviyty',['id'=>$id,'log_name'=>$activity->log_name])}}
		 			 		@endif
		 			 		">Detail</a></td>
		 			 </tr>
		 			@endforeach
		 		</tbody>
		 	</table>
		 	<a class="btn btn-primary text-white" href="{{route('Sancofa.Members.AllActivities.index',['id'=>$id])}}">See All Activities</a>
	 	</div>
 	</div>
 </div>
@endif
@endsection