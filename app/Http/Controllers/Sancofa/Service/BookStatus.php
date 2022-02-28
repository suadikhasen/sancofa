<?php 

namespace  App\Http\Controllers\Sancofa\Service;
use App\Sancofa\BookMembers;
use App\Sancofa\Book;
use App\Sancofa\BookRank;
use Andegna\DateTimeFactory;

/**
 * 
 */
class BookStatus 
{
	
	public function borrowedStatus($id)
	{
      $book = BookMembers::where('book_id',$id)->where('approve',false)->exists();
      return $book;
	}

	public function bookRankCreationStatus($id)
	{  
       $book_name    = Book::findOrFail($id)->book_name;
       $amharic_date = DateTimeFactory::now();
       $amharic_year = $amharic_date->getYear();
       if (BookRank::where('book_name',$book_name)->where('year',$amharic_year)->exists()) {

       	  return true;
       	
       }else{

       	  return false;
       }
	}
}