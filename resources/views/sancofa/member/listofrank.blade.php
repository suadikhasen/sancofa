@extends('sancofa.extends.main')
@section('tittle','list of rank of readers')
@section('content')
<div class="row mb-2 bg-secondary justify-content-between">
	<div class="col-md-5 mt-5">
		<a href="{{route('Sancofa.FemaleRank',['year'=>$year])}}" class="btn btn-primary btn-block">Click For Female</a>
	</div>
	<div class="col-md-5 mt-2">
		<form method="get"  action=" {{route('Sancofa.RankOfDepartment',['year'=>$year])}}">
	 		<p class="text-white">select below to rank  by department </p>
	 		<div class="input-group form-inline">
	 			<select class="form-control" id="department" name="department">
			 		<option>Health Informatics (HI)</option>
	             	<option>Medicine</option>
	             	<option>Anesthesia</option>
	                <option>Pharmacy</option>
	                <option>Psychiatry</option>
	                <option>Optometry</option>
	                <option>Biomedical and Laboratory Sciences (Lab)</option>
	                <option>Environmental and Occupational Health and Safety  (Enva)</option>
	                <option>Staff</option>
	                <option>Health Officer (HO)</option>
	                <option>Physiotherapy (PT)</option>
	                <option>Nursing</option>
	                <option>Midwifery</option>
	                <option>Others</option>
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
@if(!empty($list_of_rank))
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col">Rank</td>
						<th scope="col">full Name</td>
						<th scope="col">sancofa id</td>
						<th scope="col">univ id</td>
						<th scope="col">gender</th>
						<th scope="col">department</td>
						<th scope="col">number of reading</td>
					</tr>
				</thead>
				<tbody>
					@foreach($list_of_rank as $rank)
					 <tr>
					 	<td>{{($list_of_rank->currentPage()-1)*$list_of_rank->perPage()+$loop->iteration}}</td>
					 	<td>{{$rank->SancofaUser->full_name}}</td>
					 	<td>{{$rank->SancofaUser->sancofa_id}}</td>
					 	<td>{{$rank->SancofaUser->university_id}}</td>
					 	<td>{{$rank->SancofaUser->gender}}</td>
					 	<td>{{$rank->SancofaUser->department}}</td>
					 	<td>{{$rank->no_reading}}</td>
					 </tr>
					@endforeach
				</tbody>
			</table>
			{{$list_of_rank->links()}}
		</div>
	</div>
</div>
@endif
@endsection
