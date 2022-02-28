<?php
namespace App\Http\Controllers\Sancofa\Service;
use App\Sancofa\BlockedUser;
/**
 * 
 */
class BlockedStatus  
{
	
	public function checkBlockStatus($id)
	{
       $check = BlockedUser::where('member_sancofa_id',$id)->exists();
       if ($check) {
       	  
       	  return true;
       }else{
       	 return false;
       }
	}
}