@extends('sancofa.extends.main')
@section('tittle','Updating  Member Data')
@section('content')
@if(!empty($user))
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
    		{{Session::get('registration')}}
    	</div>
    	@endif
       <div class="card card-block">
          <div class="card-header bg-success">
            <h3>Edit Member Data</h3>
          </div>
          <div class="card-body">
            <form method="post" action="{{route('Sancofa.Members.Update',['id'=>$user->sancofa_id])}}">
            	@csrf
              <div class="form-group">
                <label for="full_name"><b>Full Name</b></label>
                <input type="text" name="full_name" id="full_name" placeholder="full name" required="required" autofocus="autofocus" class="form-control" value="{{$user->full_name}}">
              </div>

              <div class="form-group">
                <label for="phone_no"><b>Phone Number</b></label>
                <input type="string" name="phone_no" id="phone_no" placeholder="phone number" class="form-control" required="required" value="{{$user->phone_no}}">
              </div>
              <div class="form-group">
                <label for="univ_id"><b>University Id</b></label>
                <input type="text" name="univ_id" id="univ_id" placeholder="university id" class="form-control" required="required" value="{{$user->university_id}}" >
              </div>
             <div class="form-group">
             	<label for="sancofa_id"><b>Sancofa Id</b></label>
             	<input type="text" name="sancofa_id" id="sancofa_id" placeholder="sancofa id" required="required" class="form-control" value="{{$user->sancofa_id}}" disabled>
             </div>
             <div class="form-group">
             	<label for="dept"><b>Department</b></label>
             	<select class="form-control" id="dept" name="dept" >


                <option @if($user->department == "Anesthesia") selected @endif>Anesthesia</option>
                <option @if($user->department == "Environmental and Occupational Health and Safety  (Enva)") selected @endif>Environmental and Occupational Health and Safety  (Enva)</option>
                <option @if($user->department == "Health Informatics (HI)") selected @endif>Health Informatics (HI)</option>
                <option @if($user->department == "Health Officer (HO)") selected @endif>Health Officer (HO)</option>
                <option @if($user->department == "Biomedical and Laboratory Sciences (Lab)") selected @endif>Biomedical and Laboratory Sciences (Lab)</option>
                <option @if($user->department == "Midwifery") selected @endif>Midwifery</option>
                <option @if($user->department == "Medicine") selected @endif>Medicine</option>
                <option @if($user->department == "Nursing") selected @endif>Nursing</option>
                <option @if($user->department == "Optometry") selected @endif>Optometry</option>
                <option @if($user->department == "Physiotherapy (PT)") selected @endif>Physiotherapy (PT)</option>
                <option @if($user->department == "Pharmacy") selected @endif>Pharmacy</option>
                <option @if($user->department == "Psychiatry") selected @endif>Psychiatry</option>
                <option @if($user->department == "Staff") selected @endif>Staff</option>
                <option @if($user->department == "Others") selected @endif>Others</option>


                

             	</select>
             </div>

             <div class="form-group">
              <label for="gender"><b>Gender</b></label>
              <select class="form-control" name="gender" id="gender">
                <option @if($user->gender == "M") selected @endif>M</option>
                <option @if($user->gender == "F") selected @endif>F</option>
              </select>
             </div>
              <div class="form-group">
                <label for="address"><b>Address</b></label>
                <input type="string" name="address" id="address" placeholder="address of the user (optional)" class="form-control"  value="{{$user->address}}">
              </div>
              <div class="form-group">
                <label for="photo"><b>Photo Status</b></label>
                <select class="form-control" name="photo" id="photo">
                  <option @if($user->photo_status) selected @endif>yes</option>
                  <option @if(!($user->photo_status)) selected @endif>no</option>
                </select>
              </div>
              <div class="form-group">
                <label for="payment"><b>Registration Payment</b></label>
                <select class="form-control" name="payment" id="payment">
                  <option @if($user->payment_status) selected @endif>yes</option>
                  <option @if(!($user->payment_status)) selected @endif>no</option>
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
       </div>
    </div>
  </div>
</div>
@endif
@endsection
