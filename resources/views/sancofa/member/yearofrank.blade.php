@extends('sancofa.extends.main')
@section('tittle','List Of Years For Rank')
@section('content')
<div class="container">
	@if(!empty($rank))
	 <ul>
	 	@foreach($rank as $year)
	 	<li><a href="{{route('Sancofa.ListOfRank',['id' => $year->year])}}">{{$year->year}}</a></li>
	 	@endforeach
	 </ul>
	 @else
	 no rank now
	@endif
</div>
@endsection