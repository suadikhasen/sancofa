<?php

namespace App\Http\Controllers\Sancofa\Setting\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\Report;
use App\Sancofa\SancofaUser;
use App\Sancofa\BlockedUser;
use App\Sancofa\Book;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Sancofa\BookMembers;
use Illuminate\Support\Collection;

class GeneralReport extends Controller
{


    public function generalMemberReport()
    {
       $all_member    = SancofaUser::count();
       $active_member = SancofaUser::where('activation',true)->count();
       $blocked_member = BlockedUser::count();
       $male_member = SancofaUser::where('gender','M')->count();
       $female_member  = SancofaUser::where('gender','F')->count();


       $general_report = new Report;
       $general_report->labels(['members']);
       $general_report->title('General Report About Members',25,'green');
       $general_report->dataset('all member','bar',[$all_member])->backgroundColor('orange');
       $general_report->dataset('active member','bar',[$active_member])->backgroundColor('blue');
       $general_report->dataset('blocked member','bar',[$blocked_member])->backgroundColor('#ff00dd');
       $general_report->dataset('male member','bar',[$male_member])->backgroundColor('rebeccapurple');
       $general_report->dataset('female member','bar',[$female_member])->backgroundColor('royalblue');

       return view('sancofa.setting.report.generalmembers',['general_report'=>$general_report]);

    }
    public function dailyReport(Request $request)
    {

      $general_report = new Report;
    	$request->validate([
           'information' => 'required|string',
           'day'         => 'required|integer|gt:0',
    	]);

    	if ($request->information == 'newly registered member') {
	    	  $days_after_now;
          if ($request->day == 0) {
              $days_after_now = (Carbon::now());
              $days_year = $days_after_now->year;
              $days_month = $days_after_now->month;
              $days_day   = $days_after_now->day;
              $days_after_now = Carbon::create($days_year,$days_month,$days_day);
          }else{
            $days_after_now = Carbon::now()->subDays($request->day);
          }
	        $new_registerde_member = DB::table('sancofa_user')->where('created_at' ,'>=',$days_after_now)->select('created_at',DB::raw('count(*) as total , Date(created_at) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');
	        $general_report->labels($new_registerde_member->keys());
	        $general_report->dataset('new registerd member for last '.$request->day.' days','line',$new_registerde_member->values())->color('green');

    	}elseif ($request->information == 'member who borrow book') {

          $days_after_now = Carbon::now()->subDays($request->day);
	        $borrow_book = DB::table('book_members')->where('giving_date' ,'>=',$days_after_now)->select('giving_date',DB::raw('count(*) as total , Date(giving_date) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');
	        $general_report->labels($borrow_book->keys());
	        $general_report->dataset('member who borrow for last '.$request->day.' days','line',$borrow_book->values());
    	}elseif ($request->information == 'member who return book') {

    		  $days_after_now = Carbon::now()->subDays($request->day);
	        $return_book = DB::table('book_members')->where('returned_date' ,'>=',$days_after_now)->where('approve',true)->select('returned_date',DB::raw('count(*) as total , Date(returned_date) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');
	        $general_report->labels($return_book->keys());
	        $general_report->dataset(' member who return books  for last '.$request->day.' days','line',$return_book->values());

    	}

        return view('sancofa.setting.report.generalmembers',['general_report'=>$general_report]);

    }

    public function monthlyReport(Request $request)
    {
       $general_report = new Report;
       $request->validate([
         'information' => 'required|string',
       ]);

       if ($request->information == 'newly registered member')
       {

          $new_registerde_member = DB::table('sancofa_user')->whereYear('created_at',now()->year)->select('created_at',DB::raw('count(*) as total,Month(created_at) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');

          $general_report->labels($new_registerde_member->keys());
	        $general_report->dataset('new registered member for last months ','bar',$new_registerde_member->values());

       }elseif ($request->information == 'member who borrow book') {

       	   $borrower = DB::table('book_members')->whereYear('giving_date',now()->year)->select('giving_date',DB::raw('count(*) as total,Month(giving_date) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');

       	   $general_report->labels($borrower->keys());
       	   $general_report->dataset('member who borrow book for months','bar',$borrower->values())->backgroundColor('orange');

       }elseif ($request->information == 'member who return book') {

          $borrower = DB::table('book_members')->whereYear('returned_date',now()->year)->where('approve',true)->select('returned_date',DB::raw('count(*) as total,Month(returned_date) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');
       	   $general_report->labels($borrower->keys());
       	   $general_report->dataset('member who return  book for months','bar',$borrower->values())->backgroundColor('royalblue');

       }

       return view('sancofa.setting.report.generalmembers',['general_report'=>$general_report]);
    }

    public function yearlyReport(Request $request)
    {


        $general_report = new Report;
    	if ($request->information == 'newly registered member')
       {

          $new_registerde_member = DB::table('sancofa_user')->select('created_at',DB::raw('count(*) as total,Year(created_at) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');

          $general_report->labels($new_registerde_member->keys());
	        $general_report->dataset('new registered member for  years ','bar',$new_registerde_member->values());

       }elseif ($request->information == 'member who borrow book') {

       	   $borrower = DB::table('book_members')->select('giving_date',DB::raw('count(*) as total,Year(giving_date) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');

       	   $general_report->labels($borrower->keys());
       	   $general_report->dataset('member who borrow book for years','bar',$borrower->values())->backgroundColor('orange');

       }elseif ($request->information == 'member who return book') {

          $borrower = DB::table('book_members')->where('approve',true)->select('returned_date',DB::raw('count(*) as total,Year(returned_date) as date'))->groupBy('date')->orderBy('date')->pluck('total','date');
       	   $general_report->labels($borrower->keys());
       	   $general_report->dataset('member who return  book for years','bar',$borrower->values())->backgroundColor('royalblue');

       }

       return view('sancofa.setting.report.generalmembers',['general_report'=>$general_report]);
    }

    public function generalBoksReport()
    {
    	$all_books            = Book::count();
    	$lost_books           = Book::where('status',false)->count();
    	$borrowed_book        = BookMembers::where('approve',false)->count();
    	$available_book       = ($all_books -($lost_books + $borrowed_book));

    	$general_report = new Report;
    	$general_report->labels(['books']);
    	$general_report->title('General Report For books',25,'#dddfff');
    	$general_report->dataset('all registered books','bar',[$all_books])->backgroundColor('green');
    	$general_report->dataset('lost books ','bar',[$lost_books])->backgroundColor('red');
    	$general_report->dataset('borrowed books','bar',[$borrowed_book])->backgroundColor('royalblue');
    	$general_report->dataset('available books in laibrary','bar',[$available_book])->backgroundColor('#ff9090');

    	return view('sancofa.setting.report.generalbooks',['general_report' => $general_report]);
    }

    public function BooksDailyReport(Request $request)
    {
       $request->validate([
         'information' => 'required',
         'day'         => 'required',
       ]);

       $general_report = new Report;
       $days_after_now;
       if ($request->day == 0) {
          $days_after_now = (Carbon::now());
          $days_year = $days_after_now->year;
          $days_month = $days_after_now->month;
          $days_day   = $days_after_now->day;
          $days_after_now = Carbon::create($days_year,$days_month,$days_day);
       }else{
         $days_after_now = Carbon::now()->subDays($request->day);
       }

       if ($request->information == 'newly registered book') {
         $newly_registered_book = DB::table('books')->where('created_at','>=',$days_after_now)->select('created_at',DB::raw('count(*) as total,Date(created_at) as date'))->orderBy('date','ASC')->groupBy('date')->pluck('total','date');
         $general_report->labels($newly_registered_book->keys());
         $general_report->dataset('newly registered books','line',$newly_registered_book->values())->color('green');

       }elseif ($request->information == 'borrowed book') {
         $borrowed_book = DB::table('book_members')->where('giving_date','>=',$days_after_now)->select('giving_date',DB::raw('count(*) as total,Date(giving_date) as date'))->orderBy('date','ASC')->groupBy('date')->pluck('total','date');
         $general_report->labels($borrowed_book->keys());
         $general_report->dataset('borrowed books','line',$borrowed_book->values())->color('orange');

       }elseif ($request->information == 'returned book') {
         $returned_book = DB::table('book_members')->where('returned_date','>=',$days_after_now)->where('approve',true)->select('returned_date',DB::raw('count(*) as total, Date(returned_date) as date'))->orderBy('date','ASC')->groupBy('date')->pluck('total','date');
         $general_report->labels($returned_book->keys());
         $general_report->dataset('returned books','line',$returned_book->values())->color('royalblue');

       }

       return view('sancofa.setting.report.generalbooks',['general_report' => $general_report]);

    }

    public function BooksYearlyReport(Request $request)
    {
      $request->validate([
        'information' => 'required|string',
      ]);
      $general_report = new Report;
      if ($request->information == 'newly registered book') {
        $newly_registered_book = DB::table('books')->select('created_at',DB::raw('count(*) as total,Year(created_at) as date'))->orderBy('date','ASC')->groupBy('date')->pluck('total','date');
        $general_report->labels($newly_registered_book->keys());
        $general_report->dataset('newly registered books','line',$newly_registered_book->values())->color('green');

      }elseif ($request->information == 'borrowed book') {
        $borrowed_book = DB::table('book_members')->select('giving_date',DB::raw('count(*) as total,Year(giving_date) as date'))->orderBy('date','ASC')->groupBy('date')->pluck('total','date');
        $general_report->labels($borrowed_book->keys());
        $general_report->dataset('borrowed books','line',$borrowed_book->values())->color('orange');

      }elseif ($request->information == 'returned book') {
        $returned_book = DB::table('book_members')->where('approve',true)->select('returned_date',DB::raw('count(*) as total,Year(returned_date) as date'))->orderBy('date','ASC')->groupBy('date')->pluck('total','date');
        $general_report->labels($returned_book->keys());
        $general_report->dataset('returned books','line',$returned_book->values())->color('royalblue');

      }
      return view('sancofa.setting.report.generalbooks',['general_report' => $general_report]);
    }

    public function BooksMonThlyReport(Request $request)
    {
      $general_report = new Report;
      $request->validate([
        'information' => 'required|string',
      ]);

      if ($request->information == 'newly registered book') {
        $newly_registered_book = DB::table('books')->whereYear('created_at',now()->year)->select('created_at',DB::raw('count(*) as total,Month(created_at) as date'))->groupBy('date')->orderBy('date','ASC')->pluck('total','date');
        $general_report->labels($newly_registered_book->keys());
        $general_report->dataset('newly registered books','line',$newly_registered_book->values())->color('green');

      }elseif ($request->information == 'borrowed book') {
        $borrowed_book = DB::table('book_members')->whereYear('giving_date',now()->year)->select('giving_date',DB::raw('count(*) as total,Month(giving_date) as date'))->groupBy('date')->orderBy('date','ASC')->pluck('total','date');
        $general_report->labels($borrowed_book->keys());
        $general_report->dataset('borrowed books','line',$borrowed_book->values())->color('orange');

      }elseif ($request->information == 'returned book') {
         $returned_book = DB::table('book_members')->where('approve',true)->whereYear('returned_date',now()->year)->select('returned_date',DB::raw('count(*) as total,Month(returned_date) as date'))->groupBy('date')->orderBy('date','ASC')->pluck('total','date');
         $general_report->labels($returned_book->keys());
         $general_report->dataset('returned books','line',$returned_book->values())->color('royalblue');
      }

      return view('sancofa.setting.report.generalbooks',['general_report' => $general_report]);

    }


}
