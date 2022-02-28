@extends('sancofa.extends.main')
@section('tittle','Sankofa Librarian Home')
@section('content')
<div class=" col-md-12">
	<div class="card bg-dark text-dark text-center">
		<img src="{{asset($Home_Profile->profile)}}" class="card-img" alt="sancofa image">
		<div class="card-img-overlay ">
			<h1 class="card-title text-uppercase">{{$Home_Profile->tittle}}</h1>
			<p class="card-text">{{$Home_Profile->message}}</p>
		</div>
	</div>
</div>
@endsection