<?php
namespace App\Http\Controllers\Sancofa\Service;
use App\Sancofa\Book;

/**
 * 
 */
class BookIdGeneration 
{
	private $numeric_id;
	public function generate(int $id)
	{  
	   $this->numeric_id = $id;
	   $book_id = 'acc-'.$id;
       $check = Book::where('book_id',$book_id)->count();
       if ($check > 0) {
       	  
       	  return $this->generate($id+1);
       }
       	 return $this->numeric_id;
       
	}

}