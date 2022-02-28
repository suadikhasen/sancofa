<?php

namespace App\Sancofa;

use App\Sancofa\LostBooks;
use App\Sancofa\BookMembers;
use Spatie\Activitylog\LogOptions;
use App\Sancofa\ListOfCountedBooks;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Http\controllers\Sancofa\service\AmharicDate;

class Book extends Model
{   

	use SearchableTrait;
    use LogsActivity;
    
    protected   $guarded       =    [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $logName = 'Book';
    protected static $submitEmptyLogs = false;
    protected   $table         =    'books';
    protected   $primaryKey    =    'book_id';
    public      $incrementing  =    false;
    protected   $keyType       =    'string';
    public      $timestamps    =    false;
    public  static $count;
    protected $searchable = [


      'columns' => [
        
        'books.book_name'   => 100,
        'books.book_author' => 100,
        'books.book_id'     => 80,
        'books.catagory'    => 50,
        'books.donator'     => 30,

      ],
  
    ];

    public function bookMembers()
    {   
        $year = new AmharicDate();
        return $this->hasMany(BookMembers::class,'book_id','book_id')->groupBy('books.book_name');
    }

    public function unCountedBooks()
    {   
        
        return $this->hasOne(ListOfCountedBooks::class,'book_id','book_id')->where(function($query){
            $query->where([
            ['list_of_counted_book.count','=',self::$count],
            ['list_of_counted_book.lost_status','=',true],
           ])->orWhere([
             ['list_of_counted_book.count','!=',self::$count],
             ['list_of_counted_book.lost_status','=',false],
           ]);
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
      return LogOptions::defaults();
    }
}
