@extends('sancofa.extends.main')
@section('tittle','change password for active members')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			@if(Session::has('changed'))
			 <div class="alert alert-success bg-success">
			 	 {{Session::get('changed')}}
			 </div>
			@endif

			@if($errors->any())
				 <div class="alert alert-danger">
				 	<ul>
				 		@foreach($errors->all() as $error)
				 		 <li>{{$error}}</li>
				 		@endforeach
				 	</ul>
				 </div>
			@endif
			<form method="post" action="{{route('Sancofa.ActiveMembers.PasswordChanged',['id' => $id])}}">
				@csrf
			    <div class="form-group">
	       	  	 	<label for="new_password">new password</label>
	       	  	 	<input type="password" name="new_password" id="new_password" placeholder="new password" required  class="form-control" autofocus>
	       	  	 </div>

	       	  	 <div class="form-group">
	       	  	 	<label for="new_password_confirmation">repeat new password</label>
	       	  	 	<input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="repeat new password" required  class="form-control">
	       	  	 </div>
	       	  	 <button class="btn btn-primary" type="submit">Change</button>
		    </form> 
		</div>
	</div>
    


	
</div>
@endsection