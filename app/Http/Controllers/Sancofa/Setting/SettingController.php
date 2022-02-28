<?php

namespace App\Http\Controllers\Sancofa\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\HomeProfile;
use Illuminate\Support\Facades\DB;
use App\Sancofa\Payment;
use App\Sancofa\Catagory;
use App\Sancofa\Book;

class SettingController extends Controller
{
     private $profile_id;
     private $catagory_id;
     private $new_catagory_name;
     public function addNewProfile(Request $request)
     {
         
         
         $request->validate([
           
           'tittle'  => 'required',
           'message' => 'required',
           'profile' => 'required',
         ]);

         $check_active_profile  = HomeProfile::where('active',true)->exists();

         if ($check_active_profile) {
         	
         	HomeProfile::where('active',true)->update([
               
               'active' => false,

         	]);
         }

         $path = $request->file('profile')->store('HomeProfile','public');

         $home = HomeProfile::create([
          
           'tittle'  => $request->tittle,
           'message' => $request->message,
           'profile' => '/storage/'.$path,
           'active'  => true,

         ]);

         return back()->with('success','Home Profile Changed Successfully');


     }

     public function oldHomeProfile()
     {
     	 $home_profile = HomeProfile::where('active',false)->get();
     	 return view('sancofa.setting.oldhomeprofile',['home_profile' => $home_profile]);
     }


     public function repost($id)
     {
         $this->profile_id = $id;
         DB::transaction(function () {
             
             HomeProfile::where('active',true)->update([
               
               'active' => false,
      
             ]);

             HomeProfile::findOrFail($this->profile_id)->update([
               
                'active' => true,
                
             ]);
         });

         return back()->with('success','reposted Successfully');

     }



     public function charge()
     {
         $fine = Payment::find('fine');
         $registration_payment = Payment::find('registration');

         return view('sancofa.setting.charge',[
         	'fine'         =>   $fine,
         	'registration' =>   $registration_payment
         	
         ]);
     }



     public function changePayment(Request $request, $id)
     {
         $request->validate([
          
            'amount' => 'required|numeric|gt:0',

         ]);

         Payment::findOrFail($id)->update([
           
           'amount' => $request->amount,
         ]);

         return back()->with('success','amount of payment changed Successfully');
     }

     public function addCatagory(Request $request)
     {
     	 $request->validate([
          
           'catagory' => 'required|string',

     	 ]);

     	 Catagory::create([
           
           'name' => $request->catagory,
      
     	 ]);

     	 return back()->with('success','book catagory added successfully');
     }

     public function allCatagory()
     {
     	 $catagory = Catagory::all();
     	 return view('sancofa.setting.allcatagory',['catagory' => $catagory]);
     }



     public function deleteCatagory($id)
     {
          $delete_catagory = Catagory::findOrFail($id)->delete();
          return back()->with('success','Catagory Deleted Successfully');
     }

     public function showRenameIndex($id)
     {
        return view('sancofa.setting.showrenameindex',['id'  =>  $id]);
     }

     public function renameCatagory(Request $request,$id)
     {  
        $request->validate([

            'rename' => 'required|string'
        ]);
        $this->catagory_id = $id;
        $this->new_catagory_name = $request->rename;
        DB::transaction(function () {
            $catagory = Catagory::findOrFail($this->catagory_id);
            Catagory::findOrFail($this->catagory_id)->update([

                'name' => $this->new_catagory_name,
            ]);


            Book::where('catagory',$catagory->name)->update([

                'catagory' => $this->new_catagory_name,
            ]);
        });

       return back()->with('success','Catagory Renamed Successfully');
     }
}
