@extends('sancofa.extends.main')
@section('tittle','list of department')
@section('content')
<a href="{{route('Sancofa.Department.Add')}}">Add New DepartMent</a>
@if(isset($department))
<div class="container">
	<ol>
		@foreach($department as $single)
		   <li>$single->name</li>
		@endforeach
	</ol>
</div>
@endif
@endsection