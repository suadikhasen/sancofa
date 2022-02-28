<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    protected $table  = 'sancofa_punishment';
    protected $guarded= [];

    public function book_members()
    {
       return $this->hasOne(\App\Sancofa\BookMembers::class,'id','borrower_id');
    }
}
