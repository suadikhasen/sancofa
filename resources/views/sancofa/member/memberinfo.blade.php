@inject('forgotpassword','App\Http\Controllers\Sancofa\Service\ForgotPassword')
@extends('sancofa.extends.main')
@section('tittle')
   @if(Route::currentRouteName() == 'Sancofa.Profile.Show')
    profile
   
   @elseif(Route::currentRouteName() == 'Sancofa.Profile.ChangePassword')
     Changing Password 
   @elseif(Route::currentRouteName() == 'Sancofa.ActiveMembers.Find')
     member Activation   
   @elseif(Route::currentRouteName() == 'Sancofa.Profile.ChangeProfilePicture')
    Changing Profile Picture
   @endif



@endsection
@section('content')
@if($errors->any())
 <div class="alert alert-danger bg-danger">
 	<ul>
 		@foreach($errors->all() as $error)
 		  <li>{{$error}}</li>
 		@endforeach
 	</ul>
 </div>
@endif
@if(Session::has('active'))
<div class="alert alert-success bg-success">
	{{Session::get('active')}}
</div>
@endif

@if(Session::has('password_changed'))
<div class="alert alert-success bg-success">
	{{Session::get('password_changed')}}
</div>
@endif

@if(Session::has('password_error'))
 <div class="alert alert-danger bg-danger">
 	{{Session::get('password_error')}}
 </div>
@endif
@if(!empty($user))
<div class="row">
	<div class="col-md-6">
		@component('sancofa.includes.SancofaCard')
				 @slot('image')
				  {{$user->profile}}
				 @endslot
				 @slot('full_name')
				   {{$user->full_name}}
				 @endslot

				 @slot('department')
				  {{$user->department}}
				 @endslot

				 @slot('univ_id')
				  {{$user->university_id}}
				 @endslot

				 @slot('sancofa_id')
				  {{$user->sancofa_id}}
				 @endslot
				 @slot('activation')
				  @if($user->activation)
				   activated
				   @else
				    not active
				  @endif

				 @endslot
		@endcomponent
	</div>
	<div class="col-md-5">
	@if(Route::currentRouteName() == 'Sancofa.ActiveMembers.Find' && !($user->activation))
       
       	  <form method="post" action="{{route('Sancofa.ActiveMembers.Active',['id'=>$user->sancofa_id])}}">
       	  	@csrf
       	  	 <div class="form-group">
       	  	 	<label for="password">password:</label>
       	  	 	<input type="password" name="password" required="required" placeholder="password" autofocus="autofocus" id="password" class="form-control">
       	  	 </div>

       	  	 <div class="form-group">
       	  	 	<label for="re_password">repeat password</label>
       	  	 	<input type="password" name="password_confirmation" id="re_password" placeholder="repeat password" required  class="form-control">
       	  	 </div>
       	  	 <button class="btn btn-primary" type="submit">active</button>
       	  </form>
       
    @endif

    @if(Route::currentRouteName() == 'Sancofa.Profile.Show')
      
      	 <a href="{{route('Sancofa.Profile.ChangePassword')}}" class="btn btn-block btn-success">change password</a>
      	 <a href="{{route('Sancofa.Profile.ChangeProfilePicture')}}" class="btn btn-block btn-primary">change profile Picture</a>
         @if($forgotpassword->check(Auth::guard('sancofa')->user()->sancofa_id))
          <a href="{{route('Sancofa.Profile.UpdatePasswordQuestion')}}" class="btn btn-block btn-success">Update Password Question</a>
         @else
            <a href="{{route('Sancofa.Profile.FillPasswordQuestion')}}" class="btn btn-block btn-danger">please Fill Password Question</a>
         @endif
         @if(Auth::guard('sancofa')->user()->role == 'admin')
            <a href="{{route('Sancofa.Profile.TransferAdminAccount')}}">transfer admin account</a>
         @endif
    @endif

    @if(Route::currentRouteName() == 'Sancofa.Profile.ChangeProfilePicture')
       <form method="post" action="{{route('Sancofa.Profile.UploadProfilePicture')}}" enctype="multipart/form-data">
       	@csrf
       	 <div class="form-group">
       	 	<label for="profile_picture">Profile Picture</label>
       	 	<input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
       	 </div>
       	 <button class="btn btn-secondary" type="submit">Upload</button>
       </form>
    @endif

    @if(Route::currentRouteName() == 'Sancofa.Profile.ChangePassword')
       <form method="post" action="{{route('Sancofa.Profile.PasswordChanged')}}">
       	  	@csrf
       	  	 <div class="form-group">
       	  	 	<label for="current_password">current password:</label>
       	  	 	<input type="password" name="current_password" required="required" placeholder="current password" autofocus="autofocus" id="current_password" class="form-control">
       	  	 </div>

       	  	 <div class="form-group">
       	  	 	<label for="new_password">new password</label>
       	  	 	<input type="password" name="new_password" id="new_password" placeholder="new password" required  class="form-control">
       	  	 </div>

       	  	 <div class="form-group">
       	  	 	<label for="new_password_confirmation">repeat new password</label>
       	  	 	<input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="repeat new password" required  class="form-control">
       	  	 </div>
       	  	 <button class="btn btn-primary" type="submit">Change</button>
       	</form>
    @endif
 </div>
</div>
@endif
   
@endsection