<?php

namespace App\Http\Controllers\Sancofa\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sancofa\Service\BookIdGeneration;
use App\Http\Requests\Sancofa\AddBooks;
use App\Http\Requests\Sancofa\EditBook;
use App\Sancofa\Book;
use App\Sancofa\BookMembers;
use Illuminate\Support\Facades\DB;
use App\Sancofa\Catagory;
use Illuminate\Support\Facades\Artisan;

class BooksController extends Controller
{
  private $book_id;
  private $books;
  private $number_of_copies;
  private $array;

	public function allBooks()
	{
   
	  $books = Book::orderBy('created_at','asc')->paginate(25);
		$total = Book::count();
		return view('sancofa.books.allbooks',[
         'books' => $books,
         'total' => $total,
		]);

	}



    public function index()
    {
       $unique_name     =   Book::select('book_name')->distinct();
       $unique_book_id  =   Book::select('book_id');
       $unique_donator  =   Book::select('donator')->distinct();
       $unique_author   =   Book::select('book_author')->distinct();
       $last_book_id    =   Book::select('book_id')->latest()->first();
       $book_catagory   =   Catagory::all();

       return view('sancofa.books.add',[

          'unique_name'      =>   $unique_name,
          'unique_donator'   =>   $unique_donator,
          'unique_author'    =>   $unique_author,
          'last_book_id'     =>   $last_book_id,
          'unique_book_id'   =>   $unique_book_id,
          'book_catagory'    =>   $book_catagory,

       ]);
    }

    public function register(AddBooks $request)
    {
    	$this->books  = $request->validated();

      if ($request->filled('id')) {

         if ($request->number > 1) {

           return back()->with('error','do not enter id when you enter multibooks');
         }
      }

      if ($request->number == 1 && $request->filled('id')) {

          Book::create([

              'book_id'        =>     $this->books['id'],
              'book_name'      =>     $this->books['name'],
              'book_author'    =>     $this->books['author'],
              'donator'        =>     $this->books['donate'],
              'catagory'       =>     $this->books['catagory'],
              'price'          =>     $this->books['price'],
              'created_at'     =>     now(),

            ]);

          return redirect()->route('Sancofa.Books.Add')->with('book_added','book added successfully');


      }

      $this->number_of_copies = $request->number;
      $array = array();
      $count = Book::count();
      for ($i=0; $i < $this->number_of_copies; $i++) {

          if ($i == 0) {

             $array[$i] = (new BookIdGeneration)->generate($count+1);
          }else{
             $value = $array[$i-1];
             $array[$i] = (new BookIdGeneration)->generate($value+1);
          }
      }

      $this->array = $array;

      DB::transaction(function () {

          for($i = 0 ; $i < $this->number_of_copies;$i++ ){
            Book::create([

              'book_id'        =>     'acc-'.$this->array[$i],
              'book_name'      =>     $this->books['name'],
              'book_author'    =>     $this->books['author'],
              'donator'        =>     $this->books['donate'],
              'catagory'       =>     $this->books['catagory'],
              'price'          =>     $this->books['price'],
              'created_at'     =>     now(),

            ]);

          }

      });


        $generated_book = collect($array);
    	return redirect()->route('Sancofa.Books.Add')->with(['book_added'=>'book added successfully','generated_book'=>$generated_book]);

    }

    public function allBookStatus()
    {
       $books = BookMembers::with(['book','reciever','giver'])->paginate(25);
       $total = BookMembers::count();
       return view('sancofa.books.bookstatus',['books'=>$books,'total'=>$total]);
    }

    public function search(Request $request)
    {

      $request->validate([
       'search' => 'required',
      ]);

      $books = Book::orderBy('book_name','asc')->search($request->search)->paginate(5);
      $total = count($books);

      return view('sancofa.books.allbooks',[
         'books' => $books,
         'total' => $total,
      ]);



    }

    public function findByAccession(Request $request)
    {
       $request->validate([

        'id' => 'required',

       ]);

       $books = Book::findOrFail($request->id);
       return view('sancofa.books.allbooks',[

         'books' => $books,

       ]);
    }

    


    public function orderBy(Request $request)
    {
       $request->validate([

          'order' => 'required|string',

       ]);

       $books;
       $total = Book::count();
       if ($request->order == 'by decreasing registration date'){

          $books = Book::orderBy('created_at','desc')->paginate(25);

       }
       else if ($request->order == 'by increasing registration date')
       {

         $books = Book::orderBy('created_at','asc')->paginate(25);
       }

       elseif ($request->order == 'by book tittle')
       {
          $books = Book::orderBy('book_name','asc')->paginate(25);

       }
       elseif ($request->order == 'by book author') {

           $books = Book::orderBy('book_author','asc')->paginate(25);

       }
       elseif ($request->order == 'by price') {

          $books = Book::orderBy('price','desc')->paginate(25);

       }elseif ($request->order == 'by increasing accession number') {
         $books = Book::select('books.*',DB::raw('LENGTH(book_id) as id_size'))->orderBy('id_size','ASC')->orderBY('book_id','ASC')->paginate(25);
       }elseif ($request->order == 'by decreasing accession number') {
         $books = Book::select('books.*',DB::raw('LENGTH(book_id) as id_size'))->orderBy('id_size','DESC')->orderBY('book_id','DESC')->paginate(25);
       }

       return view('sancofa.books.allbooks',[
         'books' => $books,
         'total' => $total,
     ]);
    }

    public function editBook($id)
    {
       $unique_donator  =   Book::select('donator')->distinct();
       $unique_author   =   Book::select('book_author')->distinct();
       $unique_name     =   Book::select('book_name')->distinct();
       $book_catagory   =   Catagory::all();
       $book_info       =   Book::FindOrFail($id);
       return view('sancofa.books.edit',[

      'unique_donator' => $unique_donator,
      'unique_name'    => $unique_name,
      'book_catagory'  => $book_catagory,
      'book_info'      => $book_info,

     ]);

   }

  public function Update(EditBook $request,$id)
 {
       $validated_book = $request->validated();
       $book_updated   = Book::findOrFail($id)->update([

         'book_name'   => $validated_book['name'],
         'book_author' => $validated_book['author'],
         'catagory'    => $validated_book['catagory'],
         'price'       => $validated_book['price'],
         'donator'     => $validated_book['donate'],

      ]);

   return back()->with('book_added','book edited successfulluy');

 }





}
