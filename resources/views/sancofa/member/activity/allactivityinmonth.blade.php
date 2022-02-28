@inject('month_name','App\Http\Controllers\Sancofa\Service\Activity')
@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="col-md-4">
		@if(!empty($month))
		 <ol>
		 	@foreach($month as $single_month)
		 	 <li>
		 	 	<a href="{{route('Sancofa.Members.AllActivities.Month',['id'=>$id,'year'=>$year,'month'=>$single_month->month])}}" class="btn btn-primary btn-block">{{$month_name->monthName($single_month->month)}}</a><br>
		 	 </li>
		 	@endforeach
		 </ol>
		@else
		@endif
	</div>
</div>
@endsection