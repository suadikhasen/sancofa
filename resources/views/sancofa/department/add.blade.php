@extends('sancofa.extends.main')
@section('tittle','add new department')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-5">
			@if($errors->any())
			  <div class="alert alert-danger">
			  @foreach($errors->all() as $error)
			    <div class="alert alert-danger">
			    	{{$error}}
			    </div>
			  @endforeach
			</div>
			@endif

			@if(Session::has('add'))
			 <div class="aler alert-success bg-success">
			 	{{Session::get('add')}}
			 </div>
			@endif
			<form method="post" action="{{route('Sancofa.Department.Added')}}">
				@csrf
				<div class="form-group">
					<label for="name">name of department</label>
					<input type="text" name="name" class="form-control" placeholder="name" required autofocus id="name">
				</div>
				<button class="btn btn-primary" type="submit">add</button>
			</form>
		</div>
	</div>
</div>
@endsection