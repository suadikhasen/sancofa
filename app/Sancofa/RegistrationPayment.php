<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;

class RegistrationPayment extends Model
{
    public $table = 'registration_payment';
    protected $guarded = [];
    protected $primaryKey = 'member_sancofa_id';
    public    $incrementing = false;

}
