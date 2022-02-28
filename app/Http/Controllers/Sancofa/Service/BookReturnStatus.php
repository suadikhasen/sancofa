<?php
namespace App\Http\Controllers\Sancofa\Service;
use App\Sancofa\BookMembers;

/**
 * 
 */
class BookReturnStatus 
{
	
	public function check($id)
	{
        $check = BookMembers::where([
        	['book_id','=',$id],
        	['approve','=',false],

        ])->exists();

        if($check)
        {
        	return false;

        }else{
        	return true;
        }

	}
}