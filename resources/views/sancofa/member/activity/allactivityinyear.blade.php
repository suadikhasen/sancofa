@extends('sancofa.extends.main')
@section('content')
<div class="container">
	<div class="col-md-4">
		@if(!empty($year))
		 <ol>
		 	@foreach($year as $single_year)
		 	 <li><a href="{{route('Sancofa.Members.AllActivities.Year',['id'=>$id,'year'=>$single_year->year])}}" class="btn btn-primary btn-block">{{$single_year->year}}</a><br></li>
		 	@endforeach
		 </ol>
		@else
		@endif
	</div>
</div>
@endsection