@extends('sancofa.extends.setting')
@section('setting')
@if(Session::has('success'))
 <div class="alert alert-success bg-success">
 	{{Session::get('success')}}
 </div>
@endif
@if(isset($home_profile))
<div class="container">
	<div class="row my-2">
		@foreach($home_profile as $home)
		  <div class="col-md-5 mr-2">
			<div class="card bg-dark text-dark">
				<img src="{{asset($home->profile)}}" class="card-img" alt="sancofa image">
				<div class="card-img-overlay">
					<h1 class="card-title">{{$home->tittle}}</h1>
					<p class="card-text">{{$home->message}}</p>
				</div>
			</div>
			<a href="{{route('Sancofa.Setting.Repost',['id' => $home->id])}}" class="btn btn-success mt-1 mb-1">Repost</a>
         </div>

		@endforeach
	</div>
</div>
@else
 no old post
@endif
@endsection