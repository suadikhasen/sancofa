<?php

namespace App\Http\Controllers\Sancofa\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Sancofa\SancofaUser;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
     public function showProfile()
    {
       $user = Auth::guard('sancofa')->user();
       return view('sancofa.member.memberinfo',['user' => $user]);
    }

    public function changePassword(Request $request)
    {
    	
    	$request->validate([
          
          'current_password' => 'required',
          'new_password' => 'required|min:5|confirmed',

    	]);

    	$user = Auth::guard('sancofa')->user();
    	if (!(Hash::check($request->current_password, $user->password))) {
    		
    		return back()->with('password_error','please type correct current password');
    	}

    	SancofaUser::findOrFail($user->sancofa_id)->update([
         
          'password' => Hash::make($request->new_password),

    	]);



    	return back()->with('password_changed','password changed successfully');

    }

    public function  uploadProfilePicture(Request $request)
    {
         $request->validate([
           'profile_picture'   =>  'required|image:jpeg, png, bmp, gif,svg',
         ]);

         $path = $request->file('profile_picture')->store('image','public');

         SancofaUser::find(Auth::guard('sancofa')->user()->sancofa_id)->update([
             
            'profile' => '/storage/'.$path,

         ]);

         return back()->with('password_changed','file uploaded successfully');
    }
}
