<?php

namespace App\Http\Controllers\Sancofa\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\ReservedBook;

class BookReservingController extends Controller
{
    public function reserve(Request $request,$id)
    {
         $request->validate([
           'sancofa_id' => 'required|exists:sancofa_user,sancofa_id',
         ]);

         $check_book = ReservedBook::where('book_id',$id)->where('reserved',false)->exists();
         $check_member = ReservedBook::where('user_id',$request->sancofa_id)->where('reserved',false)->exists();
         
         if ($check_book) {
         	
         	return back()->with('error','book already reserved');
         }

         if ($check_member) {
         	
         	return back()->with('error','member can not reserve more than one book');
         }
         
         ReservedBook::create([
           
           'user_id' => $request->sancofa_id,
           'book_id'    => $id
         ]);
  
      return back()->with('success','book reserved successfully');
    }

    public function allReservedBooks()
    {
        $all_reserved_books = ReservedBook::with(['member','book'])->where('reserved',false)->paginate(10);
        return view('sancofa.books.allreservedbooks',['all_reserved_books' => $all_reserved_books]);
    }

    public function notify($id)
    {
        $notify = ReservedBook::findOrFail($id)->update([

            'reserved' => true,

        ]);

        return back()->with('success','book reserve notification updated successfully');
    }
}
