@inject('book_status','App\Http\Controllers\Sancofa\Service\BookStatus')
@inject('amharic','App\Http\Controllers\Sancofa\Service\AmharicDate')
@inject('reserve','App\Http\Controllers\Sancofa\Service\ReservedStatus')
@extends('sancofa.extends.main')
@section('tittle','list of all books')
@section('content')
@if(Session::has('success'))
 <div class="alert alert-success bg-success">
 	{{Session::get('success')}}
 </div>
@endif
@if(!empty($books))
<div class="row">
	<div class="col-md-4">
	 	<form class="d-none d-sm-inline-block form-inline  ml-md-5 " method="get" action="{{route('Sancofa.Books.Search')}}">
		 	    @csrf
		 	    <p>search by name,author,donator,</p>
		    <div class="input-group">

			      <input id="search" type="text" class="form-control  " placeholder="Search by name,,author,catagory" aria-label="Search" aria-describedby="basic-addon2" name="search">
			      <div class="input-group-append">
			        <button class="btn btn-primary" type="submit">
			          <i class="fas fa-search fa-sm"></i>
			        </button>
			      </div>
		    </div>
		    <br>
	    </form>
  </div>

  <div class="col-md-4">
 	<form class="d-none d-sm-inline-block form-inline  ml-md-5  " method="get" action="{{route('Sancofa.Books.FindByAccession')}}">
	 	    @csrf
	 	<p>Search By acc Number</p>
	    <div class="input-group">
		      <input type="text" class="form-control  " placeholder="Search by accession key" aria-label="Search" aria-describedby="basic-addon2" name="id" autofocus value="acc-" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
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
 	<form method="get"  action=" {{route('Sancofa.Books.Order')}}">
 		<p for="order">order by</p>
 		<div class="input-group form-inline">

 			<select class="form-control" id="order" name="order">
 				<option>by decreasing registration date</option>
 				<option>by increasing registration date</option>
 				<option>by increasing accession number</option>
                <option>by decreasing accession number</option>
 				<option>by book tittle</option>
 				<option>by book author</option>
 				<option>by price</option>
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

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 mt-1 ml-10">
			<table class="table table-bordered table-hover table-responsive">
				@if(Route::currentRouteName() == 'Sancofa.Books.AllBooks' || Route::currentRouteName() == 'Sancofa.Books.Order')
				<span>
					<b>list of books</b>
				</span>
				<span style="float:right;">
					<b>total registered books  {{' '.$books->total()}} @elseif(Route::currentRouteName() == 'Sancofa.Books.Search') {{'  '.$books->total()}} results found for this search  @endif</b>
				</span>
				<thead class="thead-dark">
					<tr>
						<th scope="col">number</th>
						<th scope="col">book tittle</th>
						<th scope="col">book author</th>
						<th scope="col">book id</th>
						<th scope="col">book price</th>
						<th scope="col">catagory</th>
						<th scope="col">book donator</th>
						<th scope="col">reg date</th>
						<th scope="col">borrowing status</th>
						<th scope="col">lost status</th>
						@if(Auth::guard('sancofa')->role = 'admin')
						 <th scope="col">Tools</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@if(Route::currentRouteName() == 'Sancofa.Books.Search' || Route::currentRouteName() == 'Sancofa.Books.AllBooks' || Route::currentRouteName() == 'Sancofa.Books.Order')
					@foreach($books as $book)
						<tr>
						  <td>{{(($books->currentPage()-1)*$books->perPage())+$loop->iteration}}</td>
						  <td>{{$book->book_name}}</td>
						  <td>{{$book->book_author}}</td>
						  <td>{{$book->book_id}}</td>
						  <td>{{$book->price}}</td>
						  <td>{{$book->catagory}}</td>
						  <td>{{$book->donator}}</td>
						  <td>{{$amharic->amharicDateTime($book->created_at)}}</td>
						  <td>@if($book_status->borrowedStatus($book->book_id))
                           <b style="color:red">borrowed</b>
                            @if($reserve->ReservedStatus($book->book_id))
								<p>reserved</p>
								@else
								<p> not reserved</p>
								 <a href="{{route('Sancofa.Books.ReservingBooks',['id'=>$book->book_id])}}">reserve</a>
								@endif
                           @else
                            <b style="color:green;">not borrowed</b>
                            @endif
						  </td>
						  <td>@if($book->status)
                              <b style="color:green;">active</b>
                              @else
                              <b style="color:red;">lost</b>
                              @endif
						  </td>
						  @if(Auth::guard('sancofa')->role == 'admin')
						   <td>
                          
                            <a href = "{{route('Sancofa.Books.EditBook',['id'=>$book->book_id])}}" class = "btn btn-sm btn-primary">Edit</a>
                          </td>
						  @endif
						</tr>
					@endforeach
					@elseif(Route::currentRouteName() == 'Sancofa.Books.FindByAccession')

					  <tr>
						  <td>1</td>
						  <td>{{$books->book_name}}</td>
						  <td>{{$books->book_author}}</td>
						  <td>{{$books->book_id}}</td>
						  <td>{{$books->price}}</td>
						  <td>{{$books->catagory}}</td>
						  <td>{{$books->donator}}</td>
						  <td>{{date('F d,Y',strtotime($books->created_at))}}</td>
						  <td>
						  	@if($book_status->borrowedStatus($books->book_id))
                           <b style="color:red">borrowed</b>
                           @else
                            <b style="color:green;">not borrowed</b>
                            @endif
						  </td>
						  <td>
						  	@if($books->status)
                              <b style="color:green;">active</b>
                            @else
                              <b style="color:red;">lost</b>
                            @endif
						  </td>

						  @if(Auth::guard('sancofa')->role == 'admin')
						   <td>
						   	
                            <a href = "{{route('Sancofa.Books.EditBook',['id'=>$books->book_id])}}" class = "btn btn-sm btn-primary">Edit</a>
						   	</td>
						  @endif
						</tr>
					@endif
				</tbody>
			</table>
			@if(Route::currentRouteName() == 'Sancofa.Books.Search' || Route::currentRouteName() == 'Sancofa.Books.AllBooks' || Route::currentRouteName() == 'Sancofa.Books.Order')
			<span>{{$books->appends(Request::except('page'))->links()}}</span><span style="float:right;"><b>total for this page {{' '.$books->count()}}</b></span>
			@endif
		</div>
	</div>
</div>
@else
No registered Books
@endif
@endsection
