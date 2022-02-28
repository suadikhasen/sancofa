<?php

namespace App\Sancofa;

use App\Sancofa\Book;
use App\Sancofa\SancofaUser;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ListOfMonthlyPayment extends Model
{   
	use LogsActivity;
	protected $guarded = [];
	protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $logName = 'MonthlyPayment';
    protected static $submitEmptyLogs = false;
    protected $table = 'list_of_monthly_payment';
    

    public function sancofaUser(){

    	return $this->hasOne(SancofaUser::class,'sancofa_id','sancofa_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
      return LogOptions::defaults();
    }
}
