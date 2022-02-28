@inject('address','App\Http\Controllers\Sancofa\Service\AddressDetector')
@inject('amharic','App\Http\Controllers\Sancofa\Service\AmharicDate')
@inject('blocked','App\Http\Controllers\Sancofa\Service\BlockedStatus')
@extends('sancofa.extends.main')
@section('tittle','list of all members')
@section('content')
<div class="container">
<div class="row">
	 <div class="col-md-4">
	 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="{{route('Sancofa.Members.Search')}}">
		 	    @csrf
		 	<p>search by name and university id</p>
		    <div class="input-group">
			      <input type="text" class="form-control  " placeholder="Search by name and university id" aria-label="Search" aria-describedby="basic-addon2" name="search">
			      <div class="input-group-append">
			        <button class="btn btn-primary" type="submit">
			          <i class="fas fa-search fa-sm"></i>
			        </button>
			      </div>
		    </div>
		    <br>
	    </form>
	 </div>
	 <div class="col-md-3">
	 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="{{route('Sancofa.Members.SearchBySancofaID')}}">
		 	    @csrf
		 	<p>search by sancofa-id</p>
		    <div class="input-group">
			      <input type="text" class="form-control  " placeholder="Search by sancofa id" aria-label="Search" aria-describedby="basic-addon2" name="sancofa_id">
			      <div class="input-group-append">
			        <button class="btn btn-primary" type="submit">
			          <i class="fas fa-search fa-sm"></i>
			        </button>
			      </div>
		    </div>
		    <br>
	    </form>
	 </div>
    <div class="col-md-3">
 	<form method="get"  action=" {{route('Sancofa.Members.Order')}}">
 		<p >order by</p>
 		<div class="input-group form-inline">

 			<select class="form-control" id="order" name="order">
 				<option>by decreasing registration date</option>
 				<option>by increasing registration date</option>
 				<option>by department</option>
                <option>by decreasing sancofa id</option>
                <option>by increasing sancofa id</option>
 			</select>
 			<div class="input-group-append">
		        <button class="btn btn-primary" type="submit">
		          <i class="fas fa-search fa-sm"></i>
		        </button>
		      </div>
 		</div>

 	</form>
 </div>

</div>
 @if(Session::has('success'))
  <div class="alert alert-success bg-success">
  	 {{Session::get('success')}}
  </div>
 @endif

 @if(!empty($sancofa_user))
	 <table class="table table-bordered  table-hover table-responsive">
	 	<span><b>
	 	@if(Route::currentRouteName() == 'Sancofa.Members.Search') {{$total}} result found for this  search 
	   @elseif(Route::currentRouteName() == 'Sancofa.Members.SearchBySancofaID') 
	     {{$total}} result for this search
	   @else 
	   list of registered members</b></span><span style="float: right;">total registered{{"   ".$total}}@endif</span>
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">full name</th>
				<th scope="col">department</th>
				@if(Auth::guard('sancofa')->user()->role == 'admin')
				<th scope="col">Blocked Status</th>
				@endif
				<th scope="col">phone number</th>
				<th scope="col">sancofa id</th>
				<th scope="col">university id</th>
				<th scope="col">reg date</th>
				<th scope="col">Gender</th>
				<th scope="col">Address</th>
				<th scope="col">Photo Status</th>
				<th scope="col">Registration Payment</th>
				<th scope="col">Edit MemberData</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sancofa_user as $single)
			<tr>
				<td>{{(($sancofa_user->currentPage()-1)*$sancofa_user->perPage()) + $loop->iteration}}</td>
				<td>{{$single->full_name}}</td>
				<td>{{$single->department}}</td>
				@if(Auth::guard('sancofa')->user()->role == 'admin')
				 <td>
				 	@if($blocked->checkBlockStatus($single->sancofa_id))
				 	  <p class="text-warning">blocked</p>
				 	  <br>
				 	  <a href="{{route('Sancofa.Members.UnBlock',['id' => $single->sancofa_id])}}">unblock</a>
				 	@else

				 	  <p class="text-success">un blocked</p>
				 	  <br>
				 	  <a href="{{route('Sancofa.Members.Block',['id' => $single->sancofa_id])}}">block</a>

				 	@endif
				 </td>
				@endif
				<td>
					@if(Auth::guard('sancofa')->user()->role == 'admin')
					{{$single->phone_no}}
					@else
					 *************
					@endif
				</td>
				<td>{{$single->sancofa_id}}</td>
				<td>{{$single->university_id}}</td>
				<td>{{$amharic->amharicDateTime($single->created_at)}}</td>
				<td>{{$single->gender}}</td>
				<td>{{$single->address}}<br/>

                 @if($address->trace($single->address))
                  <a href="{{route('Sancofa.Members.AddAddress',['id' => $single->sancofa_id])}}">update</a>
                 @else
                  <a href="{{route('Sancofa.Members.AddAddress',['id' => $single->sancofa_id])}}">add</a>
                 @endif
				</td>
				<td>@if($single->photo_status)
					  <p style="color:green;">accepted</p>
					@else
					<p class="text-success">Not Accepted</p>
					 <a href="{{route('Sancofa.Members.UpdatePhotoStatus',['id' => $single->sancofa_id])}}" style="color:red;">  accept</a>
					@endif
				</td>
				<td>
					@if($single->payment_status)
					 <p style="color:green">paid</p>
					@else
					 <p style="color:red;">unpaid</p>
					 <a href="{{route('Sancofa.Members.UpdatePaymentStatus',['id' => $single->sancofa_id])}}" > Pay</a>
					@endif
				</td>
				<td>
					<a href="{{route('Sancofa.Members.UpdateView',['id'=>$single->sancofa_id])}}" class="btn btn-primary btn-sm mb-1">Edit</a>
					<a href="{{route('Sancofa.Members.BorrowedHistory',['id'=>$single->sancofa_id])}}" class="btn btn-primary btn-sm">Borrowed History</a>


				</td>

			</tr>
			@endforeach
		</tbody>
	 </table>
	{{$sancofa_user->appends(Request::except('page'))->links()}}<span class="ml-5" style="float:right"><b> {{$sancofa_user->count()}} members for this page </b><span>
 @else
  no registered members
 @endif
</div>
@endsection
