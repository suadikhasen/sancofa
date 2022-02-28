<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password Question</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>
<body>
	@if($errors->any())
	 <div class="alert alert-danger bg-danger">
	 	<ul>
	 		@foreach($errors->all() as $error)
	 		  <li>{{$error}}</li>
	 		@endforeach
	 	</ul>
	 </div>
	@endif

	@if(Session::has('success'))
	 <div class="alert alert-success bg-success">
	 	{{Session::get('success')}}
	 </div>
	@endif

	@if(Session::has('error'))
	 <div class="alert alert-danger bg-danger">
	 	{{Session::get('error')}}
	 </div>
	@endif
	@if(!empty($questions))
	<div class="card card-block w-75 mt-2 ml-5">
		<div class="card-header bg-secondary">Forgot Password Question</div>
		<div class="card-body">
			<form method="post" action="{{route('Sancofa.CheckForgotPassword')}}">
				@csrf
			@foreach($questions as $question)
               <div class="form-group">
               	 <label for="q{{$question->id}}">{{$question->question}}</label>
               	 <input type="text" name="q{{$question->id}}" id="q{{$question->id}}" class="form-control"  placeholder="your answer" required autofocus value="{{old('q'."$question")}}">
               </div>
			@endforeach
				<div class="form-group">
	               	 <label for="sancofa_id">Sancofa Id</label>
	               	 <input type="text" name="sancofa_id" id="sancofa_id" class="form-control" placeholder="your answer" required autofocus value="{{old('sancofa_id')}}">
	            </div>

	            <div class="form-group">
	               	 <label for="new_password">new password</label>
	               	 <input type="password" name="new_password" id="new_password" class="form-control" placeholder="your answer" required autofocus >
	            </div>

	            <div class="form-group">
	               	 <label for="new_password_confirmation">Repeat new Password</label>
	               	 <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="your answer" required autofocus>
	            </div>
			 <button class="btn btn-primary">Reset</button>
			</form>
		</div>
	</div>
	@endif
 <script type="text/javascript" src="{{'js/app.js'}}"></script> 
</body>
</html>