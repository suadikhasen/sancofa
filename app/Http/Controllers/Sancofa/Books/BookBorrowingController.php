<?php

namespace App\Http\Controllers\Sancofa\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\BookMembers;
use App\Sancofa\SancofaUser;
use App\Sancofa\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Andegna\DateTimeFactory;
use App\Sancofa\Rank;
use App\Http\Controllers\Sancofa\Service\BlockedStatus;
use App\Http\Controllers\Sancofa\Service\ReservedStatus;
use App\Http\Controllers\Sancofa\Service\BookStatus;
use App\Sancofa\ReservedBook;
use App\Sancofa\BookRank;
class BookBorrowingController extends Controller
{
    
    private $book_id;
    private $reciever_id;
    private $book_borrowed;
    private $amharic_year_for_rank;

    public function index()
    {
    	return view('sancofa.books.borrowings1');
    }



    public function check(Request $request)
    {
       $request->validate([

         'sancofa_id' => 'required|exists:sancofa_user,sancofa_id',

       ]);


       /**
       * check blocked user
       */
       if ((new BlockedStatus)->checkBlockStatus($request->sancofa_id)) {
          
           return back()->with('check','the member is blocked member')->withInput();

          
       }
       
       
      /**
       *check if the reciever is active or not
       *
       *
       */

       $find_member  = SancofaUser::findOrFail($request->sancofa_id);
       if ($find_member->activation) {

           $now         =   Carbon::now();

           $now_year    =   $now->year;
           $now_month   =   $now->month;
           $now_day     =   $now->day;

           $now_date    =   Carbon::create($now_year,$now_month,$now_day);



          
           $check_three_book      = BookMembers::where('reciever_id',$request->sancofa_id)->where('approve',false)->count();

           if ($check_three_book >= 3) {
               
               return back()->with('check','active member doesnt boorow more than three books')->withInput();
           }

           $check_boorowed_book_expired = BookMembers::where('reciever_id',$request->sancofa_id)->where('approve',false)->where('returned_date','<',$now_date)->count();

           if ($check_boorowed_book_expired  > 0) {
              
               return back()->with('check','the book he borrowed before had passed thier returned date pleas return the boo')->withInput();
           }

           $check_punishment = BookMembers::where('reciever_id',$request->sancofa_id)->where('punishment',false)->where('approve',true)->count();

           if ($check_punishment > 0) {
              
              return back()->with('check','the member doesnt pay the panishment')->withInput();
           }

           return view('sancofa.books.borrowings2',['user'=>$find_member]);


       }

       $check_double = BookMembers::where('reciever_id' ,  $request->sancofa_id)->where('approve',false)->count();

       $check_punishment = BookMembers::where('reciever_id',$request->sancofa_id)->where('approve',true)->where('punishment',false)->count();

       if ($check_double >0) {

       	  return redirect()->route('Sancofa.Books.Borrowing')->with('check','the member doesnt return the book')->withInput();
       }

       elseif ($check_punishment > 0) {
       	
          return redirect()->route('Sancofa.Books.Borrowing')->with('check','the member doesnt pay the panishment')->withInput();
       	  
       }

       

       return view('sancofa.books.borrowings2',['user'=>$find_member]);

    }

    public function giveBook(Request $request,$reciever_id)
    {
    	 $request->validate([

            'book_id' => 'string|required|exists:books,book_id'
    	 ]);
        
    	  $this->book_id = Book::findOrFail($request->book_id);
        $this->reciever_id = $reciever_id;


        if (BookMembers::where('book_id',$this->book_id->book_id)->where('approve',false)->exists())
          
        {
           return back()->with('already_borrowed','book already borrowed');
        }

        if (Book::where('book_id',$this->book_id->book_id)->where('status',false)->exists())
        {
           
           return back()->with('already_borrowed','book is lost can not be borrowed');  
        }


        if ((new ReservedStatus)->ReservedStatus($request->book_id) && !((new ReservedStatus)->memberStatus($reciever_id))) 
        {  
           $user_id = ReservedBook::where('book_id',$request->book_id)->first()->user_id;
           $full_name = SancofaUser::findOrFail($user_id)->full_name; 
           return back()->with('already_borrowed','Book is reserved to '.'<b>'.$full_name.'</b>'.' PLEASE go to the reserved books and click notify to remove from reserved books and then back to this, if member has been notified about the reservation ');
        }
        
        $amharic_date = DateTimeFactory::now();
        $this->amharic_year_for_rank = $amharic_date->getYear();

        DB::transaction(function () {

            if( ((new ReservedStatus)->memberStatus($this->reciever_id)) ){
                
                ReservedBook::where('user_id',$this->reciever_id)->where('reserved',false)->update([
                  
                    'reserved' => true,
                ]);


             }

            $now = Carbon::now();
            $returned_date;
            
            if (SancofaUser::findOrFail($this->reciever_id)->activation) {
                
                $returned_date = Carbon::now()->addDays(10);

            }else{

                $returned_date = Carbon::now()->addDays(5);
            }
            
            $rank = Rank::where('rank_id',$this->reciever_id)->where('year',$this->amharic_year_for_rank)->exists();



           $this->book_borrowed    =  BookMembers::create([

            'book_id'       =>   $this->book_id->book_id,
            'giver_id'      =>   Auth::guard('sancofa')->user()->sancofa_id,
            'reciever_id'   =>   $this->reciever_id,
            'giving_date'   =>   $now,
            'returned_date' =>   $returned_date,

          ]); 

          if ($rank) {
             Rank::where('rank_id',$this->reciever_id)->where('year',$this->amharic_year_for_rank)->increment('no_reading');

          }else{
            
            Rank::create([
              
              'rank_id'      =>  $this->reciever_id,
              'year'         =>  $this->amharic_year_for_rank,
              'no_reading'   =>  1,

            ]);
          }
          $book_name = Book::findOrFail($this->book_id->book_id)->book_name;
          if ((new BookStatus)->bookRankCreationStatus($this->book_id->book_id)) {
             
             $id = BookRank::where('book_name',$book_name)->where('year',$this->amharic_year_for_rank)->first()->id;
             BookRank::findOrFail($id)->increment('no_reading');

          }else{ 
            
            BookRank::create([
             
              'book_name' =>$book_name,
              'year'      => $this->amharic_year_for_rank,
              'no_reading'=> 1,

            ]);
          }
        
        },5);
        


        

        return redirect()->route('Sancofa.Books.EndBorrow',['id'=>$this->book_borrowed->id]);


    }

    public function borrowed($borrow_id)
    {
        $borrower = BookMembers::findOrFail($borrow_id);
        return view('sancofa.books.borrowedinfo',['borrower' => $borrower]);
    }

    public function allBorrowedBooks()
    {
          $all_borrowed_books = BookMembers::with(['book','reciever','giver'])->where('approve',false)->paginate(25);
          $total = BookMembers::where('approve',false)->count();

         return view('sancofa.books.allborrowedbooks',['books'=>$all_borrowed_books,'total'=>$total]);
    }

    public function extendBorrowedBook($borrow_id)
    {
    	
    	$borrower      = BookMembers::findOrFail($borrow_id);
    	$returned_date = Carbon::create($borrower->returned_date);
    	$updated_date  = $returned_date->addDays(5);

    	$borrower->update([

    		'returned_date' => $updated_date,
         
    	]);

    	return back()->with('return','return date extended successfully');
        
    }

    public function searchByAccessionKey(Request $request)
    {
        $request->validate([
          'search' => 'required',
        ]);
        $all_borrowed_books = BookMembers::with(['book','reciever','giver'])->where('book_id',$request->search)->where('approve',false)->paginate(25);
        $total = BookMembers::where('approve',false)->count();

         return view('sancofa.books.allborrowedbooks',['books'=>$all_borrowed_books,'total'=>$total]);

    }
}
