<?php
namespace App\Http\Controllers\Sancofa\Books;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Sancofa\CountBooks;
use App\Sancofa\ListOfCountedBooks;
use App\Sancofa\Book;
use App\Sancofa\LostBooks;

class CountBookController extends Controller
{

    protected $book_id;
    protected $count;
    public function index()
    {
        $count_books =  CountBooks::paginate(10);
        return view('sancofa.books.count.index',['count_books'=>$count_books]);
    }

    public function create()
    {

        CountBooks::create([]);
        return back()->with('message','Counting Book Created Successfully');

    }

    public function show_count_books_page($id)
    {   
      Book::$count = $id;
    	$counted_books     = ListOfCountedBooks::where('count',$id)->where('lost_status',true)->count();
    	$un_counted_books = Book::with('unCountedBooks')->whereDoesntHave('unCountedBooks')->count();
    	$count            = CountBooks::findOrFail($id);

    	return view('sancofa.books.count.countpage',[
    		'counted_books'     => $counted_books,
    		'un_counted_books'  => $un_counted_books,
    		'count'             => $count,
      ]);


    }

    public function countBooks(Request $request,$id)
    {
    	$request->validate([

           'book_id' => 'required|exists:books,book_id',
    	]);

    	if (ListOfCountedBooks::where('book_id',$request->book_id)->where('count',$id)->exists()) {

    		return back()->with('error','already counted for this counting');
    	}elseif (!(Book::findOrFail($request->book_id)->status)) {

    		return back()->with('error','lost books can not be counted');
    	}

    	$count = ListOfCountedBooks::create([

            'book_id' => $request->book_id,
            'count'   => $id,

    	]);
    	return back()->with('success','book counted Successfully');
    }

    public function finishCountingBoks($id)
    {
       $finish = CountBooks::findOrFail($id)->update([

          'close_status' => true,

       ]);

       return back()->with('success','counting finished Successfully');
    }

    public function countedBooks($id)
    {
    	$counted_books = ListOfCountedBooks::with('books')->where('count',$id)->paginate(25);
    	return view('sancofa.books.count.countedbooks',[
    		'counted_books'=>$counted_books,
    		'id'           => $id,
       ]);

    }

    public function unCountedBooks($id)
    { 

    	Book::$count = $id;
    	$un_counted_books = Book::with('unCountedBooks')->whereDoesntHave('unCountedBooks')->paginate(25);
        $total = Book::with('unCountedBooks')->whereDoesntHave('unCountedBooks')->count();
    	return view('sancofa.books.count.uncountedbooks',[
    		'un_counted_books' => $un_counted_books,
    		'id'               => $id,
        'total'            => $total,
    	]);
    }


    public function makeLost($id,$count)
    {  
       $this->id = $id;
       $this->count = $count;
       DB::transaction(function () {

          Book::findOrFail($this->id)->update([

          'status' =>false,

          ]);

          ListOfCountedBooks::create([
             
             'book_id'     => $this->id,
             'count'       => $this->count,
             'lost_status' => false,

          ]);
           
       },5);
       

       return back()->with('success' ,'book added to lost books');
    }
}
