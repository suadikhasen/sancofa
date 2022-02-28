<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'rank';
    protected $guarded = [];

    public function SancofaUser()
    {
    	return $this->hasOne('App\Sancofa\SancofaUser','sancofa_id','rank_id');
    }
}
