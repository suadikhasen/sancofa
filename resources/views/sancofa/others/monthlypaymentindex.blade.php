@extends('sancofa.extends.main')
@section('content')
@if(!empty($years) && count($years) >0)
<ol>
	@foreach($years as $year)
	<li><a href="{{route('Sancofa.Others.MonthlyPaymentYear',['year'=>$year->year])}}" class="btn btn-success" target="_blank">{{$year->year}}</a></li><br>
	@endforeach
</ol>
@endif
@if(Auth::guard('sancofa')->user()->role == 'admin')
<a class="btn btn-primary btn-block" href="{{route('Sancofa.Others.CreateMonthlyPayment')}}">
Create New Monthly Payment
</a>
@endif
@endsection
