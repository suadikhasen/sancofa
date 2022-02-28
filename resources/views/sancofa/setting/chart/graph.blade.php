@extends('sancofa.extends.setting')
@section('setting')
<div class="container">
	{!! $chart->container() !!}
	{!! $chart->script() !!}
</div>
@endsection