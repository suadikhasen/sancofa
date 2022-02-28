<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     protected $table          = 'payment';
     protected $primaryKey     = 'reason';
     public    $incrementing   = false;
     protected $keyType        = 'string';
     protected $guarded        = [];

     public $timestamps = false;
}
