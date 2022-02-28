<?php

namespace App\Http\Controllers\Sancofa\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
       $this->middleware('SancofaGuest');
    }



    public function login()
    {
        return view('welcome');
    }

    public function authenticate(Request $request)
    {
       $request->validate([
        'sancofa_id'       =>   'required',
        'password'         =>   'required'

       ]);

       if (Auth::guard('sancofa')->attempt([
        'sancofa_id' => $request->sancofa_id,
        'password'   => $request->password,
       ])) {
       	  return redirect()->route('Sancofa.Home');
       }

       return back()->with('invalid_id_password','please enter correct id and password');

    }

    
}
