<?php
namespace App\Http\controllers\Sancofa\service;
use Illuminate\Support\Carbon;
use Andegna\DateTime;
use Andegna\DateTimeFactory;
/**
 * 
 */
class AmharicDate 
{
	
	public function amharicDateTime($date)
	{  
       $date                  = Carbon::create($date);
       $amharic_date          = new DateTime($date);
       $formated_amharic_date = $amharic_date->format('F j ቀን Y E');
       return $formated_amharic_date;
	}

	public function  amharicDateTimeStamp($date)
	{
		$amharic_date = DateTimeFactory::fromTimestamp($date);
		$amharic_year = $amharic_date->getYear();
		return $amharic_year;
    }

	public  function amharicYearFromDateTime($date){
	    
	   $date = Carbon::create($date);
	   $amharic_date = new DateTime($date);
	   $amharic_year = $amharic_date->getYear();
			
	    return $amharic_year;
	   

	}

	public function monthly_Payment_Creating_Year_Checking($year)
	{   
		$date         = Carbon::now();
		$amharic_date = new DateTime($date);
		$amharic_year = $amharic_date->getYear();
        
		if ($year < $amharic_year) {
			
			return false;
		}

		return true;
	}

  

	


}
