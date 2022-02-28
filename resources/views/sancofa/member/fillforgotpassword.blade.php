@extends('sancofa.extends.main')
@section('content')
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
		<div class="card-header bg-success">Forgot Password Question</div>
			 <div class="card-body">
				<form method="post" action="{{route('Sancofa.Profile.SaveForgotPasswordQuestion')}}">
					@csrf
				@foreach($questions as $question)
	               <div class="form-group">
	               	 <label for="q{{$question->id}}">{{$question->question}}</label>
	               	 <input type="text" name="q{{$question->id}}" id="q{{$question->id}}" class="form-control"  placeholder="your answer" required autofocus value = @if(isset($answers)) "{{$answers[$loop->iteration-1]->answer}}" @endif >
	               </div>
				@endforeach
				 <button class="btn btn-primary">Save</button>
				</form>
			</div>
    </div>
	@endif
@endsection