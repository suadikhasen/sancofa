<?php

namespace App\Http\Controllers\Sancofa\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\Rank;
use App\Sancofa\BookMembers;
use Illuminate\Support\Facades\DB;
use App\Http\controllers\Sancofa\service\AmharicDate;

class RankController extends Controller
{
    
    private  $department_request;
    public function rank()
    {
       $rank = Rank::select('year')->distinct()->get();
       return view('sancofa.member.yearofrank',['rank'=>$rank]);
    }

    public function listOfRankAllOver($year)
    { 
       $list_of_rank = Rank::with('SancofaUser')->where('year',$year)->orderBy('no_reading','desc')->paginate(10);
       return view('sancofa.member.listofrank',['list_of_rank' => $list_of_rank,'year'=>$year]);
      
    }

    public function listOfRankFemale($year)
    {  // dd($year);
    	$list_of_rank = Rank::whereHas('SancofaUser',function($query){
           
           $query->where('gender','F');
    	})->where('year',$year)->orderBy('rank.no_reading','desc')->paginate(10);
          
    	return view('sancofa.member.listofrank',['list_of_rank' => $list_of_rank,'year'=>$year]);
    }

    public function rankOfDepartment(Request $request,$year)
    {
       $this->department_request = $request;
       $list_of_rank = Rank::whereHas('SancofaUser',function($query){

          $query->where('department',$this->department_request->department);
       })->where('year',$year)->orderBy('rank.no_reading','desc')->paginate(10);

       return view('sancofa.member.listofrank',['list_of_rank' => $list_of_rank,'year'=>$year]);


       
    }

  



}
