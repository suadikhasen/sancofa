<?php
namespace App\Http\Controllers\Sancofa\Service;
/**
 * 
 */
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity as MonthlyActivity;
class Activity 
{
	
	public function actionDate($collection_date,$iteration)
	{
		$dates = $collection_date->keys();
		$array_date = $dates->toArray();
		$returned_date = Carbon::create($array_date[$iteration-1]);
		return $returned_date->toFormattedDateString();
	}

	public function activityStatus($collection_status,$iteration)
	{
       $statuses     =  $collection_status->keys();
       $array_status =  $statuses->toArray();
       $returned_status = $array_status[$iteration-1];

       return $returned_status;
	}

	public function paymentMonth($id)
	{
		$upadte_attribute = MonthlyActivity::findOrFail($id);
		$changes = collect(($upadte_attribute->changes())['attributes']);
		$changes = $changes->keys();
		return $changes[1];
	}

	public function monthName($month_number)
	{
		$month_name = date("F",mktime(0,0,0,$month_number,10));
		return $month_name;
	}
}