@extends('sancofa.extends.main')
@section('content')
 <div class="container">
 @if(!empty($updates) and count($updates) > 0)
 	@foreach($updates as $update)
 	<hr class="bg-primary">
 	 <b>
 	 @if($loop->iteration == 1) Updated Value @else 
      Old Value
 	 @endif
 	</b>
 	<hr class="bg-primary">
 	<br>
 	@foreach($update as $key => $value)
 	 {{$key . ' : '.$value}}<br>
 	@endforeach
 	
 	@endforeach
 @else
  no editted 
 @endif
 </div>
@endsection