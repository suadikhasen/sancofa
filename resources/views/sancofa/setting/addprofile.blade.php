@extends('sancofa.extends.setting')
@section('setting')
<div class="container">
	@if(Session::has('success'))
		 <div class="alert alert-success bg-success">
		 	{{Session::get('success')}}
		 </div>
	@endif
	<div class="row my-4">
		<div class="col-md-5">
			<form method="post" action="{{route('Sancofa.Setting.ChangeProfile')}}" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="tittle"><b>Tittle</b></label>
					<textarea type="text" name="tittle" id="tittle" class="form-control" required autofocus cols="5"> </textarea> 
				</div>

				<div class="form-group">
					<label for="message"><b>small text message</b></label>
					<textarea id="message" name="message" class="form-control" required autofocus cols="5"></textarea>
				</div>

				<div class="form-group">
					<label for="profile"><b>Profile Image</b></label>
					<input type="file" name="profile" class="form-control-file" required id="profile">
				</div>
				<button class="btn btn-primary btn-block" type="submit">Add</button>
			</form>
		</div>
	</div>
</div>
@endsection