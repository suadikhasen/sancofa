@extends('sancofa.extends.setting')
@section('setting')
<div class="container col-md-4 mt-2">
	<a href="{{route('Sancofa.Setting.ImportBooks')}}" class="btn btn-block btn-primary">books</a>
	<a href="{{route('Sancofa.Setting.ImportMembers')}}" class="btn btn-block btn-success">members</a>
</div>
@endsection