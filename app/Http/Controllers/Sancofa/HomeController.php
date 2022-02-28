<?php

namespace App\Http\Controllers\Sancofa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   /**
    *constructor function used to insert middleware
    *
    *@param no
    */

    public function __construct()
    {

    	$this->middleware('SancofaAuth');
    }

    /**
    * function used to display home
    *
    *@param no
    */

    public function index()
    {
      return view('home');
    }

    public function logout()
    {
      Auth::guard('sancofa')->logout();
      return redirect()->route('Sancofa.Index')->with('logout','Sign Out Successfully');
    }
}
