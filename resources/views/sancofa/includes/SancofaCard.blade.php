<div class="card" style="width:30rem;">
	<div class="card-header bg-info">
		<h3> Sancofa's Member Info</h3>
	</div>
	<div class="card-body card-block ">
		<div class="card-img card-img-top mb-3">
			<img src="{{asset($image)}}" width="50rem;" height="50rem">
		</div>
		<p><b>full name:</b><span>{{$full_name}}</span></p>
		<p><b>department:</b><span>{{$department}}</span></p>
		<p><b>university id:</b><span>{{$univ_id}}</span></p>
		<p><b>sancofa id:</b><span>{{$sancofa_id}}</span></p>
		<b>activation:{{$activation}}</b>
	</div>
</div>