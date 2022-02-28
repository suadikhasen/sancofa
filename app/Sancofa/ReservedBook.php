<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;
use App\Sancofa\Book;
use App\Sancofa\SancofaUser;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ReservedBook extends Model
{
    
    use LogsActivity;
    protected $table = 'reserved_books';
    protected $guarded = [];
    protected static $logFillable = true;
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'Reserving Books';


    public function book()
    {
       return $this->hasOne(Book::class,'book_id','book_id');
    }

    public function member()
    {
        
        return $this->hasOne(SancofaUser::class,'sancofa_id','user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
      return LogOptions::defaults();
    }
}
