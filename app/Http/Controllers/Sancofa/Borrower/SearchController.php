<?php

namespace App\Http\Controllers\Sancofa\Borrower;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\BookMembers;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $all_borrowed_books = BookMembers::with(['book','reciever','giver'])->where('reciever_id',$request->search)->where('approve',false)->paginate(25);
          $total = BookMembers::where('reciever_id',$request->search)->where('approve',false)->count();

         return view('sancofa.books.allborrowedbooks',['books'=>$all_borrowed_books,'total'=>$total]);

        
    }
}
