@extends('sancofa.extends.setting')
@section('setting')
<div class="container mt-5">
	<ul>
		<li>current amount of fine {{'  '.$fine->amount.'  '}} <a href="{{route('Sancofa.Setting.ChangePayment',['id' => $fine->reason])}}"  class="btn btn-primary btn-sm">change</a></li>
		<li>current amount of registration payment {{'  '.$registration->amount.' '}} <a href="{{route('Sancofa.Setting.ChangePayment',['id' => $registration->reason])}}"  class="btn btn-primary btn-sm">change</a></li>
	</ul>
</div>
@endsection