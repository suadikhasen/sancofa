<?php

namespace App\Http\Controllers\Sancofa\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\ForgotPasswordQuestion;
use App\Sancofa\SancofaUser;
use App\Sancofa\ForgotPasswordAnswer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
     
     
     private $qestion1;
     private $qestion2;
     private $qestion3;
     private $qestion4;
     private $qestion5;
     
     

     public function index()
     {
     	$questions = ForgotPasswordQuestion::all();
     	 // dd(Route::currentRouteName());
        
        if (Route::currentRouteName() == 'Sancofa.ForgotPassword') {
        	
        	return view('sancofa.member.forgotpasswordquestion',['questions' => $questions]);
        }

        elseif (Route::currentRouteName() == 'Sancofa.Profile.FillPasswordQuestion') {

        	return view('sancofa.member.fillforgotpassword',['questions' => $questions]);

        }

        elseif (Route::currentRouteName() == 'Sancofa.Profile.UpdatePasswordQuestion') {
        	
        	$answers = ForgotPasswordAnswer::where('sancofa_id',Auth::guard('sancofa')->user()->sancofa_id)->get();
        	//dd(($answers));
        	return view('sancofa.member.fillforgotpassword',['questions' => $questions,'answers'=>($answers)]);
        }
     	
     }



     public function checkForgotPassword(Request $request)
     {    
     	  $request->only(['q1','q2','q3','q4','q5','sancofa_id','new_password']);
     	  $request->validate([

     	  	'q1' => 'required',
     	  	'q2' => 'required',
     	  	'q3' => 'required',
     	  	'q4' => 'required',
     	  	'q5' => 'required',
     	  	'sancofa_id' =>'required|exists:sancofa_user,sancofa_id',
     	  	'new_password' =>'required|min:5|confirmed',
     	  ]);

     	  $id       = $request->sancofa_id;
     	  $q1       = $request->q1;
     	  $q2       = $request->q2;
     	  $q3       = $request->q3;
     	  $q4       = $request->q4;
     	  $q5       = $request->q5;
     	  $password = $request->new_password;

     	  if (!(SancofaUser::findOrFail($request->sancofa_id)->activation)) {
     	  	  
     	  	  return back()->with('error','you are not active member');

     	  }

     	  else if(!(ForgotPasswordAnswer::where([

     	  	['sancofa_id',$id],
     	  	['answer',$q1],
     	  	['question_id',1]

     	  ])->exists())) {
     	  	 
     	  	 return back()->with('error','answer mismached')->withInput();

     	  }


     	  else if(!(ForgotPasswordAnswer::where([

     	  	['sancofa_id',$id],
     	  	['answer',$q2],
     	  	['question_id',2]

     	  ])->exists())) {
     	  	 
     	  	 return back()->with('error','answer mismached')->withInput();

     	  }


     	  else if(!(ForgotPasswordAnswer::where([

     	  	['sancofa_id',$id],
     	  	['answer',$q3],
     	  	['question_id',3]

     	  ])->exists())) {
     	  	 
     	  	 return back()->with('error','answer mismached')->withInput();

     	  }


     	  else if(!(ForgotPasswordAnswer::where([

     	  	['sancofa_id',$id],
     	  	['answer',$q4],
     	  	['question_id',4]

     	  ])->exists())) {
     	  	 
     	  	 return back()->with('error','answer mismached')->withInput();

     	  }

     	  else if(!(ForgotPasswordAnswer::where([

     	  	['sancofa_id',$id],
     	  	['answer',$q5],
     	  	['question_id',5]

     	  ])->exists())) {
     	  	 
     	  	 return back()->with('error','answer mismached')->withInput();

     	  }


     	  else if(!(ForgotPasswordAnswer::where([

     	  	['sancofa_id',$id],
     	  	['answer',$q1],
     	  	['question_id',1]

     	  ])->exists())) {
     	  	 
     	  	 return back()->with('error','answer mismached')->withInput();

     	  }

     	  


     	  SancofaUser::findOrFail($id)->update([
              
              'password' => Hash::make($password),
      
     	  ]);

     	  return back()->with('success','password changed successfully now you can log in');
     }


     public function saveAnswers(Request $request)
     {
     	$request->only(['q1','q2','q3','q4','q5']);
     	  $request->validate([

     	  	'q1' => 'required',
     	  	'q2' => 'required',
     	  	'q3' => 'required',
     	  	'q4' => 'required',
     	  	'q5' => 'required',
     	  ]);

     	  $this->question1 = $request->q1;
     	  $this->question2 = $request->q2;
     	  $this->question3 = $request->q3;
     	  $this->question4 = $request->q4;
     	  $this->question5 = $request->q5;

     	  DB::transaction(function () {
     	      $question;
     	      for ($i=1; $i <=5 ; $i++) { 
     	      	 
     	      	  if ($i == 1) {
     	      	  	 $question = $this->question1;
     	      	  }

     	      	  elseif ($i == 2) {
     	      	  	 $question = $this->question2;
     	      	  }

     	      	  elseif ($i == 3) {
     	      	  	 $question = $this->question3;
     	      	  }
     	      	  elseif ($i == 4) {
     	      	  	 $question = $this->question4;
     	      	  }

     	      	  elseif ($i == 5) {
     	      	  	$question = $this->question5;
     	      	  }

     	      	 ForgotPasswordAnswer::updateOrCreate(

     	      	 	[
     	      	 		'sancofa_id'  => Auth::guard('sancofa')->user()->sancofa_id,
     	      	 		'question_id' => $i,
     	      	 	],

     	      	 	[
            
	                  'answer'     => $question,
	                  'question_id'=>$i,

     	            ]
     	      );
     	      }
     	  },5);


     	  
       return back()->with('success','answer saved successfully');

     }
}
