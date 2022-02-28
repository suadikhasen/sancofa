@extends('sancofa.extends.main')
@section('tittle','checking borrowing books')
@section('content')
<div class="container">
	@if($errors->any())
	 <div class="alert alert-danger bg-danger">
	 	<ul>
		 @foreach($errors->all() as $error)
		 <li>{{$error}}</li>
		 @endforeach
		</ul>
	</div>
	@endif

	@if(Session::has('already_borrowed'))
	 <div class="alert alert-danger bg-danger">
	 	{{Session::get('already_borrowed')}}
	 </div>
	@endif
	<div class="row">
		<div class="col-md-7">
			@component('sancofa.includes.SancofaCard')
				 @slot('image')
				  {{$user->profile}}
				 @endslot
				 @slot('full_name')
				   {{$user->full_name}}
				 @endslot

				 @slot('department')
				  {{$user->department}}
				 @endslot

				 @slot('univ_id')
				  {{$user->university_id}}
				 @endslot

				 @slot('sancofa_id')
				  {{$user->sancofa_id}}
				 @endslot

				 @slot('activation')
				  @if($user->activation)
				   activated
				   @else
				    not active
				  @endif
				 @endslot
			@endcomponent
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<form method="get" action="{{route('Sancofa.Books.Borrowed',[
				'reciever_id'=>$user->sancofa_id])}}">
				     @csrf
					<label for="book_id">Enter Book Id</label>
					<input type="text" name="book_id" id="book_id"  placeholder="enter book id" class="form-control" required autofocus value="acc-"   onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"><br>
					<button class="btn btn-success" type="submit">Give</button>
				</form>
			</div>
		</div>
	</div>	
</div>
@endsection
