@extends('sancofa.extends.main')
@section('content')
<div class="container mt-4">
	@if(!empty($unique_year))
	<ol>
		@foreach($unique_year as $year)
		  <li class="mb-2">
		  	<a href="{{route('Sancofa.Books.BookRank',['year'=>$year->year])}}" class="btn btn-success">{{$year->year}}</a>
		  </li>
		@endforeach
	</ol>
	@else
	  book rank not start
	@endif
</div>
@endsection
