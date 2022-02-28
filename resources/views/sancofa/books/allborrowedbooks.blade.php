@inject('punishment','App\Http\Controllers\Sancofa\Service\Punishment')
@inject('extend','App\Http\Controllers\Sancofa\Service\Extend')
@inject('address','App\Http\Controllers\Sancofa\Service\AddressDetector')
@inject('amharic','App\Http\Controllers\Sancofa\Service\AmharicDate')
@inject('reserve','App\Http\Controllers\Sancofa\Service\ReservedStatus')
@extends('sancofa.extends.main')
@section('tittle','list of all borrowed')
@section('content')
<div class="container-fluid">
	<div class="row">
	  <div class="col-md-4">
	  	<p>search members  sancofa-id</p>
	  	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="{{route('Sancofa.Borrower.Search')}}">
	 	    @csrf
            <div class="input-group">
              <input type="text" class="form-control  " placeholder="Search by sancofa id" aria-label="Search" aria-describedby="basic-addon2" name="search">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div><br>
       </form>
	  </div>
	  <div class="col-md-4">
		 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 my-2 my-md-0 mw-200 " method="get" action="{{route('Sancofa.Books.SearchByAccessionKey')}}">
			 	    @csrf
			 	<p>Search By acc Number</p>
			    <div class="input-group">
				      <input type="text" class="form-control  " placeholder="Search by name,sancofa id,university id" aria-label="Search" aria-describedby="basic-addon2" name="search" value="acc-">
				      <div class="input-group-append">
				        <button class="btn btn-primary" type="submit">
				          <i class="fas fa-search fa-sm"></i>
				        </button>
				      </div>
			    </div>
			    <br>
		    </form>
	 </div>
	</div>	 
	<div class="row">
		@if(Session::has('success'))
		  <div class="alert alert-success bg-success">
				{{Session::get('success')}}
			</div>
		@endif
		@if(!empty($books))
		<div class=" col-md-12">
			@if(Session::has('return'))
			<div class="alert alert-success bg-success">
				{{Session::get('return')}}
			</div>
			@endif
		    <div>
		    	@if(Route::currentRouteName() == 'Sancofa.Books.AllBorrowedBooks')
		    	<span><b>totall borrowed books:{{$total}}</b></span>
		    	@endif
		    </div>
			<table class="table table-bordered table-hover table-responsive">
				<thead class="badge-primary">
					<tr>
						<th scope="col">number</th>
						<th scope="col">book name</th>
						<th scope="col">book id</th>
						<th scope="col">giver name</th>
						<th scope="col">reciever name</th>
						<th scope="col">reciever id</th>
						<th scope="col">borrowing date</th>
						<th scope="col">returned date</th>
						<th scope="col">reserved status</th>
						<th scope="col">punishment</th>
						<th scope="col">return status</th>
						<th scope="col">borrowing id</th>
						<th scope="col">extend</th>
						<th scope="col">detail about member</th>
					</tr>
				</thead>
				<tbody>
					@foreach($books as $book)
					<tr>
						<td>{{(($books->currentPage()-1)*$books->perPage())+$loop->iteration}}</td>

						<td>{{$book->book->book_name}}</td>
						<td>{{$book->book->book_id}}</td>
						<td>{{$book->giver->full_name}}</td>
						<td>{{$book->reciever->full_name}}</td>
						<td>{{$book->reciever_id}}</td>
						<td>{{$amharic->amharicDateTime($book->giving_date)}}</td>
						<td>{{$amharic->amharicDateTime($book->returned_date)}}</td>
						<td>
						@if($reserve->ReservedStatus($book->book->book_id))
						<b class="text-success text-uppercase">reserved</b>
						@else
						 not reserved
						 <a href="{{route('Sancofa.Books.ReservingBooks',['id'=>$book->book->book_id])}}">reserve</a>
						@endif
					   </td>
						<td>

							<b class="@if($punishment->calculatePanishment($book->returned_date)) == 0) text-danger @else text-success @endif">{{$punishment->calculatePanishment($book->returned_date)}} Birr</b>
						</td>
						<td>
							@if($punishment->checkPunishment($book->returned_date))
							<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#s{{$book->id}}">
                               return
                            </button>
							<!-- Modal -->
							<div class="modal fade" id="s{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-scrollable" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalScrollableTitle">returning book</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							          if the book is returned with paid punishment select <strong>withPunishment Button</strong><br>
							          if the book is returned with out Punishment select 
							          <strong>withOutPunishmentButton</strong>

							      </div>
							      <div class="modal-footer">
							        <a  class="btn btn-secondary" href="{{route('Sancofa.Books.ReturnBookWithOutPunishment',['id'=>$book->id])}}">with out punishment</a>
							        <a  class="btn btn-primary" href="{{route('Sancofa.Books.ReturnWithPunishMent',['id'=>$book->id])}}">with punishment</a>
							      </div>
							    </div>
							  </div>
							</div>
							@else
							<a href="{{route('Sancofa.Books.ReturnBookWithNoPunishment',['id'=>$book->id])}}" class="btn btn-sm btn-success">return</a>
							@endif
						</td>
						<td>{{$book->id}}</td>
						<td>
						@if($extend->checkExtend($book->giving_date,$book->returned_date))
						  <a href="{{route('Sancofa.Books.Extend',['id'=>$book->id])}}" class="btn btn-info btn-sm">Extend</a>
						@else
						 <small class="text-warning">can not be extended</small>
						@endif
						</td>
						<td>
							<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#d{{$book->id}}">
		                               detail
		                    </button>
			        <div class="modal fade" id="d{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-scrollable" role="document">
						    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Of Borrower</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							    <div class="modal-body">
								    @if($book->reciever->photo_status)
										<p >Photo Status :<b style="color:green;">accepted</b></p>
										@else
										<p>
											Photo Status :<b style="color:red;">un accepted</b>
										 <a href="{{route('Sancofa.Members.UpdatePhotoStatus',['id' => $book->reciever->sancofa_id])}}" >  accept</a>
										</p>
								   @endif
								@if($book->reciever->payment_status)
								 <p>registration payment:<b style="color:green">paid</b></p>
								@else
								 <p >registration payment :<b style="color:red;">Unpaid</b>
								 <a href="{{route('Sancofa.Members.UpdatePaymentStatus',['id' => $book->reciever->sancofa_id])}}" > Pay</a>
								</p>
								@endif
			                    <p>Address:{{$book->reciever->address.'  '}}
								@if($address->trace($book->reciever->address))
									
					                  <a href="{{route('Sancofa.Members.AddAddress',['id' => $book->reciever->sancofa_id])}}">update</a>
					                 @else
					                  <a href="{{route('Sancofa.Members.AddAddress',['id' => $book->reciever->sancofa_id])}}">add</a> 
				                @endif
							    </p>  
							    <p class="text-info">Phone Number:
							    	@if(Auth::guard('sancofa')->user()->role == 'admin')
							    	{{$book->reciever->phone_no}}
							    	@else
							    	 ***********
							    	@endif
							    </p>
							    <a href="{{route('Sancofa.Members.BorrowedHistory',['id'=>$book->reciever_id])}}" class="btn btn-primary btn-block">Click To See Borrowing History<a>
							    </div>
							    
					       </div>
					  </div>
			        </div>
				</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{$books->links()}}
		@endif
	</div>
</div>
@endsection
