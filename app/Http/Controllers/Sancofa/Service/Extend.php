<?php
namespace App\Http\Controllers\Sancofa\Service;
use Illuminate\Support\Carbon;

/**
 * 
 */
class Extend  
{
	
	public function checkExtend($start_date,$end_date)
	{ 
              
              $start_date = Carbon::create($start_date);
              $end_date   = Carbon::create($end_date); 
              $difference_in_dates = $start_date->diffInDays($end_date);
              $now                 =  Carbon::now();
              $year                =  $now->year;
              $month               =  $now->month;
              $day                 =  $now->day;

              $now_date   = Carbon::create($year,$month,$day);
              $difference = $now_date->diffInDays($end_date,false);
              if ($difference_in_dates >5) {
              	   return false;
              }
              else if ($difference < 0) 
              {
              	 return false;
              }else{
              	 return true;
              }
      }
	
}