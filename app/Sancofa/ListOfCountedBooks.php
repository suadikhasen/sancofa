<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;
use App\Sancofa\Book;

class ListOfCountedBooks extends Model
{
    protected $table = 'list_of_counted_book';
    protected $guarded = [];

    public function books()
    {
    	return $this->hasOne(Book::class,'book_id','book_id');
    }
}
