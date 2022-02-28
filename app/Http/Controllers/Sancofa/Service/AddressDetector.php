<?php
namespace App\Http\Controllers\Sancofa\Service;

/**
 * 
 */
class AddressDetector 
{
	
	public function trace($address)
	{
		if ($address == 'unknown') {
			
			return false;
		}

		return true;

	}
}