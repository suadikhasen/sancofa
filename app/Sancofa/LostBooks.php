<?php

namespace App\Sancofa;

use Illuminate\Database\Eloquent\Model;

class LostBooks extends Model
{
     protected $table          = 'lost_books';
     protected $primaryKey     = 'book_id';
     public    $incrementing   = false;
     protected $guarded        = [];
}
