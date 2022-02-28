
@extends('sancofa.extends.setting')
@section('setting')
 <div class="container col-md-6 mt-3">
 	@if(Session::has('success'))
 	 <div class="alert alert-success">
 	 	{{Session::get('success')}}
 	 </div>
 	@endif
 	@if(!empty($catagory))
 	<ol>
 		@foreach($catagory as $single)
 		 <li>
 		 	{{$single->name}}
 		 	<a href="{{route('Sancofa.Setting.ShowRenameIndex',['id' => $single->id])}}">Rename</a>
 		 	<a href="{{route('Sancofa.Setting.DeleteCatagory',['id' => $single->id])}}">Delete</a>
 		 </li>
 		@endforeach
 	</ol>
 	@endif
 </div>
@endsection