<?php

namespace App\Http\Controllers\Sancofa\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\SancofaUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminTransferController extends Controller
{   

	private $new_admin;
    public function transfer(Request $request)
    {  
       
       
       $request->validate([
         'sancofa_id' => 'required|exists:sancofa_user,sancofa_id'
       ]);

       $this->new_admin = $request->sancofa_id;

       if (!(SancofaUser::findOrFail($this->new_admin)->role)) {
       	   
       	   return back()->with('error','not active member');
       }

       
       

       DB::transaction(function () {
           
           SancofaUser::findOrFail($this->new_admin)->update([
            
             'role' => 'admin',
 
           ]);

           SancofaUser::findOrFail(Auth::guard('sancofa')->user()->sancofa_id)->update([
            
             'role' => 'member',
           ]);
       });

       return redirect()->route('Sancofa.Profile.Show')->with('active','transfered successfully you are now only active member');
    }
}
