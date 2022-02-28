@extends('sancofa.extends.main')
@section('tittle','Setting')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{route('Sancofa.Setting.Home')}}">Setting</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="btn btn-outline-success mr-3 @if(Route::currentRouteName() == 'Sancofa.Setting.Home') disabled @endif" href="{{route('Sancofa.Setting.Home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="btn btn-outline-success mr-3 @if(Route::currentRouteName() == 'Sancofa.Setting.Charge') disabled @endif" href="{{route('Sancofa.Setting.Charge')}}">Charge</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Book Catagory
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('Sancofa.Setting.AllCatagory')}}">all catagory</a>
          <a class="dropdown-item" href="{{route('Sancofa.Setting.AddCatagory')}}">add catagory</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tools
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <div class="dropdown-header">import and export</div>
          <div class="dropdown-divider">import and export</div>
          <a class="dropdown-item" href="{{route('Sancofa.Setting.Import')}}">Import</a>
          <a class="dropdown-item" href="{{route('Sancofa.Setting.Export')}}">Export</a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-header">Reports</div>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('Sancofa.Setting.GeneralMembersReport')}}">Members</a>
          <a class="dropdown-item" href="{{route('Sancofa.Setting.GeneralBooksReport')}}">Books</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="get" action="{{route('Sancofa.Members.DetailAboutMember')}}">
      <input class="form-control mr-sm-2" type="search" placeholder="Enter Sancofa Id" aria-label="Search" name="sancofa_id">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Search </button>
    </form>
  </div>
</nav>
<div class="container">
	@yield('setting')
</div>
@endsection