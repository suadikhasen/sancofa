<?php

namespace App\Http\Controllers\Sancofa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use App\Sancofa\Book;
use App\Sancofa\SancofaUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class MemberActivity extends Controller
{
    public function allActivity($id)
    {   
        $last_days  = Carbon::now()->subDays(10);
    	$activity   = Activity::where('causer_id',$id)->where('created_at','>=',$last_days)->select('created_at',DB::raw('count(*) as total , Date(created_at) as date'))->paginate(5);
        dd($activity);
        return view('sancofa.member.activity.index');


    }
}
