@extends('sancofa.extends.main')
@section('tittle','borrowing book')
@section('content')
@if(Session::has('check'))
<div class="col-md-5 alert alert-danger bg-danger">
	{{Session::get('check')}}
</div>
@endif
@if($errors->any())
<div class="alert alert-danger bg-danger col-md-4">
<ul>
@foreach($errors->all() as $error)
 <li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif
<form method="get" action="{{route('Sancofa.Books.CheckBorrowing')}}">
	@csrf
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="sancofa_id">please insert sancofa id</label>
				<input type="text" name="sancofa_id" id="sancofa_id" placeholder="sancofa id" autofocus required  class="form-control" value="{{old('sancofa_id')}}"><br>
				<button class="btn btn-success" type="submit">check</button>
		   </div>
		</div>
	</div>
</form>
@endsection