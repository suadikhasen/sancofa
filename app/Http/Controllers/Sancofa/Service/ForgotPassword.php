<?php
namespace App\Http\Controllers\Sancofa\Service;
use App\Sancofa\ForgotPasswordAnswer;
/**
 * 
 */
class ForgotPassword 
{
	
	public function check($id)
	{
       $check = ForgotPasswordAnswer::where('sancofa_id',$id)->exists();

       if ($check) 
       {
       	 
       	 return true;

       }
       else {
       	 return false;
       }
	}
}