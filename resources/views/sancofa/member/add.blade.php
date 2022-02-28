@extends('sancofa.extends.main')
@section('tittle','Adding New Member')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
    	@if($errors->any())
    	<div class="alert alert-danger bg-danger">
    	<ul>
	    	@foreach($errors->all() as $error)
	    	 <li>{{$error}}</li>
	    	@endforeach
	    </ul>
    	</div>
    	@endif
    	@if(Session::has('registration'))
    	<div class="alert alert-success bg-success">
    		{{Session::get('registration').' '.Session::get('approve_key')}}
    	</div>
    	@endif
       <div class="card card-block">
          <div class="card-header bg-success">
            <h3>Add New Member</h3>
          </div>
          <div class="card-body">
            <form method="post" action="{{route('Sancofa.Members.Added')}}">
            	@csrf

             <div class="form-group">
             	<label for="sancofa_id"><b>Sancofa Id</b></label>
             	<input type="text" name="sancofa_id" id="sancofa_id" placeholder="sancofa id" required="required" class="form-control" value="@if(!empty($next_id)){{$next_id}} @endif">
             </div>
              <div class="form-group">
                <label for="full_name"><b>Full Name</b></label>
                <input type="text" name="full_name" id="full_name" placeholder="full name" required="required" autofocus="autofocus" class="form-control" value="{{old('full_name')}}">
              </div>

              <div class="form-group">
                <label for="phone_no"><b>Phone Number</b></label>
                <input type="string" name="phone_no" id="phone_no" placeholder="phone number" class="form-control" required="required" value="{{old('phone_no')}}">
              </div>
              <div class="form-group">
                <label for="univ_id"><b>university id</b></label>
                <input type="text" name="univ_id" id="univ_id" placeholder="university id" class="form-control" required="required" value="{{old('univ_id')}}">
              </div>
             

             <div class="form-group">
             	<label for="dept"><b>Department</b></label>
             	<select class="form-control" id="dept" name="dept">
             		<option>Anesthesia</option>
             		<option>Environmental and Occupational Health and Safety  (Enva)</option>
             		<option>Health Informatics (HI)</option>
                <option>Health Officer (HO)</option>
                <option>Biomedical and Laboratory Sciences (Lab)</option>
                <option>Midwifery</option>
                <option>Medicine</option>
                <option>Nursing</option>
                <option>Optometry</option>
                <option>Physiotherapy (PT)</option>
                <option>Pharmacy</option>
                <option>Psychiatry</option>
                <option>Staff</option>
                <option>Others</option>
             	</select>
             </div>
             
             <div class="form-group">
              <label for="gender"><b>gender</b></label>
              <select class="form-control" name="gender" id="gender">
                <option>M</option>
                <option>F</option>
              </select>
             </div>
              <div class="form-group">
                <label for="address"><b>Address</b></label>
                <input type="string" name="address" id="address" placeholder="address of the user (optional)" class="form-control"  value="{{old('address')}}">
              </div>
              <div class="form-group">
                <label for="photo"><b>photo status</b></label>
                <select class="form-control" name="photo" id="photo">
                  <option>yes</option>
                  <option>no</option>
                </select>
              </div>
              <div class="form-group">
                <label for="payment"><b>registration payment</b></label>
                <select class="form-control" name="payment" id="payment">
                  <option>yes</option>
                  <option>no</option>
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Add</button>
            </form>
          </div>
       </div>
    </div>
  </div>
</div>
@endsection
