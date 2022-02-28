<?php

namespace App\Http\Controllers\Sancofa\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Sancofa\BookMembers;
use Illuminate\Support\Carbon;
use App\Sancofa\Punishment;
use App\Http\Controllers\Sancofa\Service\Punishment as PunishmentCalculater;
use App\Sancofa\Payment;
use App\Sancofa\ReservedBook;

class BookReturningController extends Controller
{
    /**
     *when punishment is paided with book
     *
     *
     */

    private $borrower;
    private $borrower_id;
    private $calculated_punishment;
    


    public function withPunishMent($borrow_id)
    {  
       $this->borrower              =  BookMembers::find($borrow_id);
       $this->borrower_id           =  $borrow_id;
       $end_date                    =  $this->borrower->returned_date;
       $punishment                  =  new PunishmentCalculater();
       $rate                        = Payment::find('fine')->amount;

       $this->calculated_punishment =  $punishment->calculatePanishment($end_date);
    

         DB::transaction(function () {


            $this->borrower->update([
              
              'punishment'    => true,
              'approve'       => true,
              'returned_date' => Carbon::now(),

            ]);

          Punishment::create([

          	'borrower_id' => $this->borrower_id,
          	'punishment'  => $this->calculated_punishment,
          	'paid'        => true,


          ]);
          
          
          


           
       },5);

       return back()->with('return','book returned successfully with paiding panishment');
    }
    
    /**
     *when the book has punishment
     *
     *but returned with out punishment
     *
     */
    
    public function withOutPunishMent($borrow_id)
    {  
    	
       $this->borrower              =  BookMembers::find($borrow_id);
       $this->borrower_id           =  $borrow_id;
       $end_date                    =  $this->borrower->returned_date;
       $punishment                  =  new PunishmentCalculater();
       $rate                        = Payment::find('fine')->amount;
       $this->calculated_punishment =  $punishment->calculatePanishment($end_date);

       DB::transaction(function () {

          $this->borrower->update([
            
            'punishment'    => false,
            'approve'       => true,
            'returned_date' => Carbon::now(),

          ]);

          

          Punishment::create([

          	'borrower_id' => $this->borrower_id,
          	'punishment'  => $this->calculated_punishment,
          	'paid'        => false,


          ]);

    	},5);

    	return back()->with('return','book returned successfully with out paiding panishment');


    }

   

    public function noPunishMent($borrow_id)
    {
        $borrower = BookMembers::find($borrow_id)->update([
           
           'approve'        => true,
           'returned_date'  => Carbon::now(),
           'punishment'     => true,


        ]);

        return back()->with('return','book returned successfully');
    }


}
