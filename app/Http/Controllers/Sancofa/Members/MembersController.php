<?php

namespace App\Http\Controllers\Sancofa\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sancofa\addMember;
use App\Sancofa\SancofaUser;
use App\Sancofa\Department;
use Illuminate\Support\Facades\Hash;
use App\Sancofa\Rank;
use Illuminate\Support\Facades\Auth;
use App\Sancofa\RegistrationPayment;
use Illuminate\Support\Facades\DB;
use App\Sancofa\Payment;
use App\Sancofa\BlockedUser;
use App\Http\controllers\Sancofa\service\AmharicDate;
use App\Sancofa\BookMembers;

class MembersController extends Controller
{


    private $address;
    private $validated_data;
    private $registraton_payment;
    private $registration_payment_status = true;
    private $photo_status;
    private $member_sancofa_id;

    public function index()
    {

       $department = Department::all();
       $next_id = SancofaUser::orderBy('sancofa_id','desc')->first()->sancofa_id;
       $next_id = $next_id+1;
       return view('sancofa.member.add',['department'  => $department,'next_id'=>$next_id]);

    }

    public function register(addMember $request,int $id = -1)
    {
       $this->validated_data = $request->validated();


       if ($request->filled('address'))
       {

          $this->address = $request['address'];
       }

       else
       {

          $this->address = 'unknown';
       }

       if ($request->payment == 'yes') {

          $this->registraton_payment =  Payment::find('registration')->amount;
          $this->registration_payment_status = true;

       }
       else{

          $this->registraton_payment =  0.0;
          $this->registration_payment_status = false;

       }

       if ($request->photo == 'yes') {

           $this->photo_status = true;

       }else{

         $this->photo_status = false;

       }

         DB::transaction(function () {

           SancofaUser::create([

             'full_name'     =>   $this->validated_data['full_name'],
             'department'     =>   $this->validated_data['dept'],
             'sancofa_id'     =>   $this->validated_data['sancofa_id'],
             'role'           =>   'member',
             'phone_no'       =>   $this->validated_data['phone_no'],
             'university_id'  =>   $this->validated_data['univ_id'],
             'gender'         =>   $this->validated_data['gender'],
             'address'        =>   $this->address,
             'photo_status'   =>   $this->photo_status,
             'payment_status' =>   $this->registration_payment_status,
             'created_at'     =>   now(),

           ]);

       });

       return redirect()->route('Sancofa.Members.Add')->with([

          'registration' => 'member registered successfully',


        ]);



    }

    public function allMembers()
    {

       $user  = SancofaUser::orderBy('full_name','asc')->paginate(25);
       $total = SancofaUser::count();
       return view('sancofa.member.allmembers',[
          'sancofa_user'  =>  $user,
          'total'         =>  $total,
      ]);
    }

    public function allActiveMembers()
    {
       $active_members = SancofaUser::where('activation',true)->paginate(10);
       $total          = SancofaUser::where('activation',true)->count();
       return view('sancofa.member.active',[
        'active_members' => $active_members,
        'total'          => $total,
      ]);
    }

    public function check(Request $request)
    {
       $request->validate([
         'sancofa_id' => 'required|exists:sancofa_user,sancofa_id',
       ]);

       $user = SancofaUser::find($request->sancofa_id);

       return view('sancofa.member.memberinfo',['user' => $user]);

    }

    public function activate(Request $request,$id)
    {

       $request->validate([
        'password' => 'required|min:5|confirmed',
       ]);

      $user = SancofaUser::find($id)->update([

         'password'   => Hash::make($request->password),
         'activation' =>true,

       ]);

      return back()->with('active','activated successfully');



    }


    public function deActivate($id)
    {
        SancofaUser::find($id)->update([

          'activation' => false,
          'password'   => NULL,

        ]);

        return back()->with('deactive','member dis activted successfully');
    }



    public function changePasswordForActive(Request $request, $id)
    {
       $request->validate([

         'new_password' => 'required|min:5|confirmed'

       ]);

       SancofaUser::find($id)->update([

          'password' => Hash::make($request->new_password)

       ]);

       return back()->with('changed','password changed successfully');
    }

    public function updateOrCreateAddress(Request $request,$id)
    {
       $request->validate([

         'address'  =>  'required|string',

       ]);

       SancofaUser::findOrFail($id)->update([

        'address' => $request['address'],
       ]);

       return back()->with('address','address saved successfully');
    }


    public function updatePhotoStatus($id)
    {
       SancofaUser::findOrFail($id)->update([

           'photo_status' => true,
       ]);

       return back()->with('success','photo status updated successfully');
    }

    public function updatePaymentStatus($id)
    {

       $this->member_sancofa_id = $id;
       DB::transaction(function () {
           $registration_payment = Payment::find('registration')->amount;
           SancofaUser::findOrFail($this->member_sancofa_id)->update([

            'payment_status' => true,

           ]);

       });

       return back()->with('success','payment status updated successfully');
    }

    public function searchMembers(Request $request)
    {
       $request->validate([

        'search' => 'required',
       ]);

       $user  = SancofaUser::orderBy('full_name','asc')->search($request->search)->paginate(5);
       $total = count($user);
       return view('sancofa.member.allmembers',[
          'sancofa_user'  =>  $user,
          'total'         =>  $total,
      ]);
    }

    public function searchBySancofaID(Request $request)
    {
      $request->validate([
        'sancofa_id' => 'required',
      ]);

      $user = SancofaUser::where('sancofa_id',$request->sancofa_id)->paginate(10);
      $total= 1;
      return view('sancofa.member.allmembers',[
        'sancofa_user' => $user,
        'total'        => $total,
      ]);
    }

    public function orderBy(Request $request)
    {
         $request->validate([
          'order' => 'required|string',
         ]);

         $user;
         $total = SancofaUser::count();

         if ($request->order == 'by decreasing registration date')
         {
            $user = SancofaUser::orderBy('created_at','desc')->paginate(25);
         }
         elseif ($request->order == 'by increasing registration date')
         {
            $user = SancofaUser::orderBy('created_at','asc')->paginate(25);
         }
         elseif ($request->order == 'by decreasing year')

         {
           $user = SancofaUser::orderBy('year','desc')->paginate(25);
         }elseif ($request->order == 'by increasing year') {

            $user = SancofaUser::orderBy('year','asc')->paginate(25);
         }elseif ($request->order == 'by department') {

            $user = SancofaUser::orderBy('department','asc')->paginate(25);
         }elseif($request->order == 'by decreasing sancofa id'){

             $user = SancofaUser::orderBy('sancofa_id','desc')->paginate(25);

         }elseif($request->order == 'by increasing sancofa id'){

             $user = SancofaUser::orderBy('sancofa_id','asc')->paginate(25);

         }

         return view('sancofa.member.allmembers',[
          'sancofa_user'  =>  $user,
          'total'         =>  $total,
        ]);
    }

    public function blockUser($id)
    {
       BlockedUser::create([

         'member_sancofa_id' => $id,
         'admin_sancofa_id' => Auth::guard('sancofa')->user()->sancofa_id,

       ]);

       return back()->with('success','blocked successfully');
    }

    public function unBlockUser($id)
    {
        BlockedUser::findOrFail($id)->delete();
        return back()->with('success','unblocked successfully');
    }

    public function UpdateView($id)
    {
       $user = SancofaUser::findOrFail($id);
       return view('sancofa.member.updatemember',['user'=>$user]);
    }


    public function detailAboutMember(Request $request)
    {
      $request->validate([

         'sancofa_id'=>'required'
      ]);
      $sancofa_user = SancofaUser::findOrFail($request->sancofa_id);
      return view('sancofa.member.detailformember',['sancofa_user'=>$sancofa_user]);

    }

    public function updateMember(Request $request, $id)
    {
       $request->validate([

           'full_name'    =>   'string|required',
           'phone_no'     =>   'digits:10|required',
           'dept'         =>   'required',
           'gender'       =>   'required|string',
           'photo'        =>   'required|string|in:yes,no',
           'payment'      =>   'required|string|in:yes,no',
           'univ_id'     =>    'required|string',

       ]);
       
       if ((SancofaUser::findOrFail($id)->university_id) != ($request->univ_id)) {

            $request->validate([
              'univ_id'      =>   'required|unique:sancofa_user,university_id',
            ]);
       }


       if ($request->filled('address'))
       {

          $this->address = $request['address'];
       }

       else
       {

          $this->address = 'unknown';
       }

       if ($request->payment == 'yes') {
          $this->registraton_payment =  Payment::find('registration')->amount;
          $this->registration_payment_status = true;
       }
       else{

          $this->registraton_payment =  0.0;
          $this->registration_payment_status = false;

       }

       if ($request->photo == 'yes') {

           $this->photo_status = true;

       }else{

         $this->photo_status = false;

       }
       
       SancofaUser::findOrFail($id)->update([
    
         'full_name'      =>   $request['full_name'],
         'department'     =>   $request['dept'],
         'phone_no'       =>   $request['phone_no'],
         'university_id'  =>   $request['univ_id'],
         'gender'         =>   $request['gender'],
         'address'        =>   $this->address,
         'photo_status'   =>   $this->photo_status,
         'payment_status' =>   $this->registration_payment_status,

       ]);

       return back()->with('registration','updated successfully');
    }

    public function BorrowedHistory($id)
    {   
        $user = SancofaUser::findOrFail($id);
        $borrowed_history = BookMembers::with('book')->where('reciever_id',$id)->orderBy('giving_date')->paginate(10);

        return view('sancofa.member.borrowedhistry',['borrowed_history' => $borrowed_history,'user' => $user]);

    }



}
