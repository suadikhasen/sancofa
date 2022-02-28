<?php

namespace App\Http\Controllers\Sancofa\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Sancofa\SancofaUser;
use Spatie\Activitylog\ActivityLogger;
use App\Sancofa\BookMembers;
use App\Sancofa\Book;
use App\Sancofa\Punishment;
class ActivityController extends Controller
{
	// use LogsActivity;



    public function allActivitiesIndex($id)
    {
      $year = Activity::select(DB::raw('Year(created_at) as year'))->distinct()->orderBy('year','desc')->get();
      return view('sancofa.member.activity.allactivityinyear',['year'=>$year,'id'=>$id]);
    }

    public function AllActivitiesYear($id,$year)
    {
       $month = Activity::whereYear('created_at',$year)->select(DB::raw('Month(created_at) as month'))->distinct()->orderBy('month','asc')->get();
       return view('sancofa.member.activity.allactivityinmonth',[
        'month'=>$month,
        'id'=>$id,
        'year'=>$year,
      ]);
    }

    public function AllActivitiesMonth($id,$year,$month)
    {
       $full_name = SancofaUser::findOrFail($id)->full_name;
       $last_activity  = Activity::where('causer_id',$id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->select('log_name',DB::raw('count(*) as total'))->groupBy('log_name')->get();
       return view('sancofa.member.activity.recentactivity',[
          'last_activity' => $last_activity,
          'full_name'     => $full_name,
          'id'            => $id,
          'year'          => $year,
          'month'         => $month,
       ]);

    }

    public function detailInMonth($id,$year,$month,$log_name)
    {
       if ($log_name == 'Book')
      {

        return ($this->detailAllActivitiesOnBooks($id,$year,$month,$log_name));
      }

      elseif ($log_name == 'Book and Members')
      {
        return ($this->detailAllActivityOnBookAndMembers($id,$year,$month,$log_name));
      }
      elseif ($log_name == 'Members')
      {
        return ($this->detailAllActivitiesOnMembers($id,$year,$month,$log_name));

      }elseif ($log_name == 'Reserving Books') {

        return ($this->detailAllActivitiyOnReservingBooks($id,$year,$month,$log_name));
      }elseif ($log_name == 'MonthlyPayment') {
         
         return ($this->detailAllActivityOnMonthlyPayment($id,$year,$month,$log_name));
      }

    }

    public function detailAllActivitiesOnBooks($id,$year,$month,$log_name)
    {
       $full_name = SancofaUser::findOrFail($id)->full_name;
       $activity = Activity::with('books')->where([
        ['causer_id','=',$id],
        ['log_name','=',$log_name],
       ])->whereYear('created_at',$year)->whereMonth('created_at',$month)->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get();
      $grouped_activity = $activity->groupBy(['date','description']);

      return view('sancofa.member.activity.detailbookactivity',[
        'grouped_activity' => $grouped_activity,
        'full_name'        => $full_name,
        'year'             => $year,
        'month'            => $month,
      ]);
    }

    public function detailAllActivitiesOnMembers($id,$year,$month,$log_name)
    {
      $full_name = SancofaUser::findOrFail($id)->full_name;
      $grouped_activity = Activity::with(['book_with_book_and_members','member_with_book_and_members'])->where([

          ['log_name','=',$log_name],
          ['causer_id','=',$id],

      ])->whereYear('created_at',$year)->whereMonth('created_at',$month)->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get()->groupBy([
        'date','description']);

      return view('sancofa.member.activity.detailmemberactivity',[

          'grouped_activity' => $grouped_activity,
          'full_name'        => $full_name,
          'year'             => $year,
          'month'            => $month,

      ]);
    }

    public function detailAllActivityOnBookAndMembers($id,$year,$month,$log_name)
    {
       $full_name = SancofaUser::findOrFail($id)->full_name;
       $activity = Activity::with(['book_with_book_and_members','member_with_book_and_members'])->where([
        ['causer_id','=',$id],
        ['log_name','=',$log_name],
       ])->whereYear('created_at',$year)->whereMonth('created_at',$month)->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get();
      $grouped_activity = $activity->groupBy(['date','description']);

      return view('sancofa.member.activity.detailbookmembersactivity',[
        'grouped_activity' => $grouped_activity,
        'full_name'        => $full_name,
        'year'             => $year,
        'month'            => $month,
      ]);
    }

    public function detailAllActivitiyOnReservingBooks($id,$year,$month,$log_name)
    {
      $full_name = SancofaUser::findOrFail($id)->full_name;
      $activity  = Activity::with(['ReservedBooks.book','ReservedBooks.member'])->where([

        ['causer_id','=',$id],
        ['log_name','=', $log_name],
      ])->whereYear('created_at',$year)->whereMonth('created_at',$month)->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get();

      $grouped_activity = $activity->groupBy(['date','description']);
      return view('sancofa.member.activity.DetailOnReservedBooks',[
        'grouped_activity' => $grouped_activity,
        'full_name'        => $full_name,
      ]);
    }

    public function detailAllActivityOnMonthlyPayment($id,$year,$month,$log_name)
    {
      $full_name = SancofaUser::findOrFail($id)->full_name;
      $activity  = Activity::with(['monthlyPayment.sancofaUser','monthlyPayment'])->where([

        ['causer_id','=',$id],
        ['log_name','=', $log_name],
      ])->whereYear('created_at',$year)->whereMonth('created_at',$month)->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get();

      $grouped_activity = $activity->groupBy(['date','description']);
      return view('sancofa.member.activity.detailmonthlypaymentactivity',[
        'grouped_activity' => $grouped_activity,
        'full_name'        => $full_name,
        'year'             => $year,
        'month'            => $month,
      ]);
    }

    public function index($id)
    {
       $last_day      = Carbon::now()->subDays(30);
       $full_name     = SancofaUser::findOrFail($id)->full_name;
       $last_activity = Activity::where('created_at','>=',$last_day)->where('causer_id',$id)->select('log_name',DB::raw('count(*) as total'))->groupBy('log_name')->get();

       return view('sancofa.member.activity.recentactivity',[
	       	'last_activity'=>$last_activity,
	       	'full_name'=>$full_name,
	       	'id'=>$id,
       ]);

    }



    public function detailRecentActiviyty($id,$log)
    {
    	if ($log == 'Book')
    	{

    		return ($this->detailRecentActiviytyOnBooks($id,$log));
    	}

    	elseif ($log == 'Book and Members')
    	{
    		return ($this->detailRecentActiviytyOnBookAndMembers($id,$log));
    	}
    	elseif ($log == 'Members')
    	{
    		return ($this->detailRecentActiviytyOnMembers($id,$log));
    	}elseif ($log == 'Reserving Books') {

        return ($this->detailRecentActiviytyOnReservingBooks($id,$log));
      }elseif ($log == 'MonthlyPayment') {
        return ($this->detailRecentActivityOnMonthlyPayment($id,$log));
      }
    }

    public function detailRecentActiviytyOnReservingBooks($id,$log)
    {
      $last_day  = Carbon::now()->subDays(30);
      $full_name = SancofaUser::findOrFail($id)->full_name;
      $activity  = Activity::with(['ReservedBooks.book','ReservedBooks.member'])->where([

        ['causer_id','=',$id],
        ['log_name','=', $log],
        ['created_at','>=',$last_day],
      ])->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get();
      $grouped_activity = $activity->groupBy(['date','description']);

      return view('sancofa.member.activity.DetailOnReservedBooks',[
        'grouped_activity' => $grouped_activity,
        'full_name'        => $full_name,
      ]);
    }


    public function detailRecentActiviytyOnBooks($id,$log)
    {
       //dd(Activity::all()->last()->changes()->values());
       $last_day  = Carbon::now()->subDays(30);
       $full_name = SancofaUser::findOrFail($id)->full_name;
       $activity = Activity::with('books')->where([
       	['causer_id','=',$id],
       	['log_name','=',$log],
       	['created_at','>=',$last_day],
       ])->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get();
      $grouped_activity = $activity->groupBy(['date','description']);

      return view('sancofa.member.activity.detailbookactivity',[
      	'grouped_activity' => $grouped_activity,
        'full_name'        => $full_name,
      ]);

    }

    public function detailRecentActiviytyOnBookAndMembers($id,$log)
    {
       // $changes = Activity::all()->last();
       // dd($changes->changes());
       $last_day  = Carbon::now()->subDays(30);
       $full_name = SancofaUser::findOrFail($id)->full_name;
       $activity = Activity::with(['book_with_book_and_members','member_with_book_and_members'])->where([
        ['causer_id','=',$id],
        ['log_name','=',$log],
        ['created_at','>=',$last_day],
       ])->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get();
      $grouped_activity = $activity->groupBy(['date','description']);

      return view('sancofa.member.activity.detailbookmembersactivity',[
        'grouped_activity' => $grouped_activity,
        'full_name'        => $full_name,
      ]);

    }

    public function detailRecentActiviytyOnMembers($id,$log)
    {
    	$last_day = Carbon::now()->subDays(30);
    	$full_name = SancofaUser::findOrFail($id)->full_name;
    	$grouped_activity = Activity::with(['book_with_book_and_members','member_with_book_and_members'])->where([

          ['log_name','=',$log],
          ['causer_id','=',$id],

          ['created_at','>=',$last_day],
    	])->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get()->groupBy([
    		'date','description']);

    	return view('sancofa.member.activity.detailmemberactivity',[

          'grouped_activity' => $grouped_activity,
          'full_name'        => $full_name,

    	]);
    }

    public function detailRecentActivityOnMonthlyPayment($id,$log)
    {
       
       $last_day = Carbon::now()->subdays(30);
       $full_name = SancofaUser::findOrFail($id)->full_name;
       $grouped_activity = Activity::with(['monthlyPayment.sancofaUser','monthlyPayment'])->where([
         ['log_name','=',$log],
         ['causer_id','=',$id],
         ['created_at','>=',$last_day],

       ])->select('activity_log.*',DB::raw('Date(created_at) as date'))->orderBy('date','desc')->get()->groupBy([
        'date','description']);
       return view('sancofa.member.activity.detailmonthlypaymentactivity',[

          'grouped_activity' => $grouped_activity,
          'full_name'        => $full_name,

      ]);
    }

    public function detailOnUpdates($id)
    {
      $activity = Activity::findOrFail($id);
      $updates = $activity->changes();
      $log_name = $activity->log_name;
      $message;
      if ($log_name == 'Book and Members') {

        if ((count(($updates->toArray())['attributes'])) == 1) {

           $message = "accept panishment";

        }else{
          $borrowing_id = $activity->subject_id;
          $panishment   = BookMembers::findOrFail($borrowing_id)->punishment;
          if ($panishment) {

             $panishment =  Punishment::where('borrower_id',$borrowing_id)->exists();
             if ($panishment) {
               $panishment = Punishment::where('borrower_id',$borrowing_id)->first();
               $panishment_status = $panishment->paid;
               if ($panishment_status) {
                   $message = 'accept this book with panishment';
               }else{
                 $message = 'accept this book with out panishment';
               }
             }else{
               $message = 'accept this book with out panishment';
             }
          }else{
            $message = 'accept this book with out panishment';
          }
        }

        return view('sancofa.member.activity.acceptpanishment',['message'=>$message]);

      }
      return view('sancofa.member.activity.activityonupdates',['updates'=>$updates]);
    }

    
}
