@extends('sancofa.extends.setting')
@section('setting')
 <div class="container">
 	<div class="col-md-6 mt-3">
	 	<div class="card" style="width:30rem;">
			<div class="card-header bg-info">
				<h3> Sancofa's Member Info</h3>
			</div>
			<div class="card-body card-block ">
				<div class="card-img card-img-top mb-3">
					<img src="{{asset($sancofa_user->profile)}}" width="50rem;" height="50rem">
				</div>
				<p><b>full name:</b><span>{{$sancofa_user->full_name}}</span></p>
				<p><b>department:</b><span>{{$sancofa_user->department}}</span></p>
				<p><b>university id:</b><span>{{$sancofa_user->university_id}}</span></p>
				<p><b>sancofa id:</b><span>{{$sancofa_user->sancofa_id}}</span></p>
				<b>activation:
                  @if($sancofa_user->activation)
                    active member
                  @else
                   not active
                  @endif

				</b>
			</div>
	    </div>
  </div>
</div>
@endsection