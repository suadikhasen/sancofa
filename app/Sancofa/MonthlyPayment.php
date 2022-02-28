<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model
{
    protected $table    = 'montly_payment';
    protected $guarded  =  [];
    protected $primaryKey = 'year';
    public    $incrementing = false;
}
