<?php

namespace App\Http\Controllers\Sancofa\Others;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Sancofa\MonthlyPayment;
use App\Sancofa\ListOfMonthlyPayment;
use App\Http\Controllers\Sancofa\Service\AmharicDate;
use App\Http\Controllers\Sancofa\Service\MonthlyPaymentService;
class OthersController extends Controller
{
   /**
    *constructor function used to insert middleware
    *
    *@param no
    */

    public function index()
    {
        
        return view('sancofa.others.index');
    }

    public function monthlyPaymentIndex(){
        $year_of_payment = MonthlyPayment::all();
        return view('sancofa.others.monthlypaymentindex',['years' => $year_of_payment]);
    }

    public function createMonthlyPaymentIndex()
    {
        return view('sancofa.others.createmonthlypayment');
    }

    public function monthlyPaymentCreating(Request $request)
    {
       $request->validate([
          
          'year'    => 'required|integer|gt:0|digits:4',
          'amount'  => 'required|integer|gt:0',
            
       ]);
       
       $year_checking        = (new AmharicDate)->monthly_Payment_Creating_Year_Checking($request->year);
       $before_creating_check = MonthlyPayment::where('year',$request->year)->exists();
       $open_status_checking  = MonthlyPayment::where('status',false)->exists();
       if (!($year_checking)) {
           return back()->with('fail','Please Insert Current Or Future Ethiopian Year Or Set Your Date And Time Correctly');
       }elseif ($before_creating_check) {
           return  back()->with('fail','Year Is Already Created');
       }elseif ($open_status_checking) {
           return back()->with('fail','There Is An Open Monthly Payment Please Close It Before Creating A New One');
       }


       $monthly_payment = MonthlyPayment::create([
         
          'year'   => $request->year,
          'amount' => $request->amount,
          'status' => false,

       ]);

       return back()->with('success','Monthly Payment Created Successfully');
    }

    public function monthlyPaymentYear($year)
    { 
      $monthly_payment  = MonthlyPayment::findOrFail($year);
      $total_payment_collected = (new MonthlyPaymentService)->calculate_Total_Monthly_Payment($year,$monthly_payment->amount);
      $list =  ListOfMonthlyPayment::with('sancofaUser')->where('year',$year)->paginate(25);
      return view('sancofa.others.listofmonthlypayer',[
        'list' => $list,
        'year' => $year,
        'monthly_payment'           => $monthly_payment,
        'total_payment_collected'   => $total_payment_collected,
      ]);
    }

    public function addMembersToPaymentView($year)
    {
        return view('sancofa.others.addmemberstopayment',['year' => $year]);
    }

    public function memberAddingToMonthlyPayment(Request $request,$year)
    {
       
       $check_close = MonthlyPayment::findOrFail($year);
        if ($check_close->status) {
            
            return back()->with('fail','This  Payment Is Closed');

        }

       $request->validate([
          
          'sancofa_id' =>'required|exists:sancofa_user,sancofa_id',

       ]);

       if (ListOfMonthlyPayment::where('sancofa_id',$request->sancofa_id)->where('year',$year)->exists()) {

             return back()->with('fail','This Member Is Already Added To This Year Monthly Payment');
           
       }
       
       ListOfMonthlyPayment::create([
         
          'sancofa_id' => $request->sancofa_id,
          'year'       => $year,

       ]);

       return back()->with('success','member added Successfully To This Monthly Payment');
    }


    public function paidingMonthlyPayment($id,$month,$year)
    {   
        $updation = false;
        $check_close = MonthlyPayment::findOrFail($year);
        if ($check_close->status) {
            
            return back()->with('fail','This  Payment Is Closed');

        }
       
        if ($month == 'september') 
        {
             ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'september' => true,
  
             ]);

             $updation = true;
        }
        elseif ($month == 'october') 
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'october' => true,
  
             ]);

            $updation = true;
        }
        elseif ($month == 'november')
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'november' => true,
  
             ]);

            $updation = true;
        }
        elseif ($month == 'december')
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'december' => true,
  
             ]);

            $updation = true;
        }
        elseif ($month == 'january')
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'january' => true,
  
             ]);

            $updation = true;
        }
        elseif ($month == 'february')
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'february' => true,
  
             ]);
            $updation = true;
        }
        elseif ($month == 'march') 
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'march' => true,
  
             ]);

            $updation = true;
        }
        elseif ($month == 'april') 
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'april' => true,
  
             ]);
            $updation = true;
        }
        elseif ($month == 'may') 
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'may' => true,
  
             ]);
            $updation = true;
        }
        elseif ($month == 'june') 
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'june' => true,
  
             ]);
            $updation = true;
        }
        elseif ($month == 'july') 
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'july' => true,
  
             ]);
            $updation = true;
        }
        elseif ($month == 'august') 
        {
            ListOfMonthlyPayment::findOrFail($id)->update([
                 
                  'august' => true,
  
             ]);

            $updation = true;
        }

        if ($updation) {
            
            return  back()->with('success','monthly payment paided successfully');
        }

        return back()->with('fail','some thing went wrong may be re start your server');
    }


    public function closeMonthlyPayment($year)
    {
        $payment_close = MonthlyPayment::findOrFail($year)->update([

            'status' => true,

        ]);

        return back()->with('success','closed successfully');
    }

    public function searchInMonthlyPayment(Request $request,$year)
    {   
        $request->validate([

            'search' => 'required',
        ]);
        $list = ListOfMonthlyPayment::with('sancofaUser')->where('sancofa_id',$request->search)->where('year',$year)->paginate(10);
        $monthly_payment = MonthlyPayment::findOrFail($year); 
        $total_payment_collected = (new MonthlyPaymentService)->calculate_Total_Monthly_Payment($year,$monthly_payment->amount);
      return view('sancofa.others.listofmonthlypayer',[
        'list' => $list,
        'year' => $year,
        'monthly_payment' => $monthly_payment,
        'total_payment_collected' => $total_payment_collected,
      ]);
    }
}
