<?php

namespace App\Sancofa;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BookMembers extends Model
{   

    use LogsActivity;
    protected $guarded   =   [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $logName = 'Book and Members';
    protected $table     =   'book_members';
    public $timestamps = false;

    public function book()
    {
       return $this->hasOne('App\Sancofa\Book','book_id','book_id');
    }

    public function giver()
    {
       return $this->hasOne('App\Sancofa\SancofaUser','sancofa_id','giver_id');
    }

    public function reciever()
    {
       return $this->hasOne('App\Sancofa\SancofaUser','sancofa_id','reciever_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
      return LogOptions::defaults();
    }

    
}
