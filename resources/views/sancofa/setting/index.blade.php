@extends('sancofa.extends.setting')
@section('setting')
<div class="container my-5">
 	<div class="row">
	 	<div class="col-md-5 ">
	 	   @if(isset($Home_Profile))		
			<div class="card bg-dark text-white">
				<img src="{{asset($Home_Profile->profile)}}" class="card-img" alt="sancofa image">
				<div class="card-img-overlay">
					<h1 class="card-title">{{$Home_Profile->tittle}}</h1>
					<p class="card-text">{{$Home_Profile->message}}</p>
				</div>
			</div>
			@endif
        </div>

        <div class="col-md-5">
        	<a href="{{route('Sancofa.Setting.AddProfile')}}" class="btn btn-block btn-primary">Change</a>
        	<a href="{{route('Sancofa.Setting.OldHomeProfile')}}" class="btn btn-block btn-success">Old Profiles</a>
        </div>
    </div> 	
</div>
@endsection