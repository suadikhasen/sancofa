<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model
{
     protected $table = 'blocked_user';
     protected $primaryKey = 'member_sancofa_id';
     protected $keyType    = 'string';
     public    $inrementing = false;
     protected $guarded =[];


}
