<?php

namespace App\Http\Controllers\Sancofa\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\BookMembers;
use App\Sancofa\Punishment;
use Illuminate\Support\Facades\DB;


class PunishMentController extends Controller
{   
	private $borrowing_id;
	private $panishment_id;
    public function show()
    {
       $panished_members = Punishment::with(['book_members.reciever'])->where('paid',false)->paginate(25);

       return view('sancofa.punishment.index',['panished_members' => $panished_members]); 
    }

    public function pay($borrowing_id,$panishment_id)
    { 
    	$this->borrowing_id     =   $borrowing_id;
    	$this->panishment_id    =   $panishment_id;
    	
    	DB::transaction(function () {

    		Punishment::find($this->panishment_id)->update([
               'paid' => true,
    		]);

    		BookMembers::find($this->borrowing_id)->update([
               
               'punishment' => true,

    		]);


    	    
    	},5);

    	return back()->with('paid','panishment paided successfully');
       
    }
}
