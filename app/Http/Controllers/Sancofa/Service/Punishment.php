<?php
namespace App\Http\Controllers\Sancofa\Service;
use Illuminate\Support\Carbon;
use App\Sancofa\Payment;


class Punishment 
{ 

	/**
	 *calculate punishment for unreturned books
	 *
	 *
	 */
	
	public function calculatePanishment($date)
	{
        $now   = Carbon::now();
        $rate  = Payment::find('fine')->amount;

        $now_year  = $now->year;
        $now_month = $now->month;
        $now_day   = $now->day;

        $date      = Carbon::create($date);

        $returned_year   =  $date->year;
        $returned_month  =  $date->month;
        $returned_day    =  $date->day;


        $now_date = Carbon::create($now_year,$now_month,$now_day);
        $returned_date = Carbon::create($returned_year,$returned_month,$returned_day);

        $difference = $now_date->diffInDays($returned_date,false);

        if ($difference < 0) {

        	return abs($difference)*$rate;
        }

        return 0;
	}

	public function checkPunishment($end_date)
	{
          $now        =  Carbon::now();

          $now_year   =  $now->year;
          $now_month  =  $now->month;
          $now_day    =  $now->day;

          $end_date   = Carbon::create($end_date);

          $returned_year   =  $end_date->year;
          $returned_month  =  $end_date->month;
          $returned_day    =  $end_date->day;

          $returned_date = Carbon::create($returned_year,$returned_month,$returned_day);
          $now_date   =  Carbon::create($now_year,$now_month,$now_day);

          $difference =  $returned_date->diffInDays($now_date,false);

          if ($difference >0) {
          	  return true;
          }

          return false;
	}

	/*
	 *calculate panishment for returned books
	 *
	 *
	 */

	public function calculatePanishmentForReturnedBooks($start_date,$end_date)
	{
         $start_date  = Carbon::create($start_date);
         $end_date    = Carbon::create($end_date);

         $punishment  = $start_date->diffInDays($end_date,false);

         return $punishment;
	}
	
}