<!DOCTYPE html>
<html>
<head>
    <title>Sankofa</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>
<body>

<div class="container" style="margin-top: 80px;margin-left: 250px">
    <div class="row">
        <div class="col-md-6">

            @if(Session::has('invalid_id_password'))
              <div class="alert alert-danger bg-danger ">
                  <b>{{Session::get('invalid_id_password')}}</b>
              </div>
            @endif

            @if(Session::has('logout'))
             <div class="alert alert-success bg-success">
                 {{Session::get('logout')}}
             </div>
            @endif
            <div class="card w-75 ">
                <h3 class="card-header bg-primary">
                    Sankofa Login
                </h3>
                <div class="card-body card-block">
                    <form method="post" action="{{route('Sancofa.LogIn')}}">
                        @csrf
                        <div class="container">
                            <div class="form-group">
                                <label for="id" class="text-dark "><b>Sankofa Id</b></label>
                                <input type="text" name="sancofa_id" id="id" class="form-control" placeholder="enter your sankofa id" required="required" autofocus="autofocus">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark"><b>Password</b></label>
                                <input type="password" name="password" required="required" placeholder="enter your sankofa password" class="form-control">
                            </div>
                        <button class="btn btn-primary" type="submit" onclick="window.alert('Are You Sure You Set Date And Time Properly In Gregorian Calandar ???')">LogIn</button>
                        </div>
                  </form>
                </div>
                <div class="card-footer"><a href="{{route('Sancofa.ForgotPassword')}}" class="card-link float-right">forgot password</a></div>
            </div>
        </div>
        <div class="col-md-4">
             <div class="bg-warning alert font-italic font-weight-bolder text-dark" id="time_notification" name = "time_notification" >Please Set Date And Time in Gregorian Calendar Before LogIn To The System</div>


        </div>
    </div>
</div>

<script type="text/javascript" src="{{'js/app.js'}}"></script>
</body>
</html>
