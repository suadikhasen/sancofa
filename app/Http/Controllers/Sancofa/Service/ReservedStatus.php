<?php
namespace App\Http\Controllers\Sancofa\Service;
use App\Sancofa\ReservedBook;

/**
 * 
 */
class ReservedStatus 
{
	
	public function ReservedStatus($book_id)
	{
		$check = ReservedBook::where('book_id',$book_id)->where('reserved',false)->exists();
		if ($check) {
			
			return true;

		}else{

			return false;

		}
	}

	public function memberStatus($user_id)
	{
		$check = ReservedBook::where('user_id',$user_id)->where('reserved',false)->exists();
		if ($check) {
			
			return true;

		}else{

			return false;

		}
	}
}