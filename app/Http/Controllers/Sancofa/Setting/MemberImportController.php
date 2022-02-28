<?php

namespace App\Http\Controllers\Sancofa\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class MemberImportController extends Controller
{
     public function import(Request $request)
     {
          $request->validate([
             
             'member' => 'required',

          ]);

          $extension = array("xls","csv","xlsx","xlm","xla","xlc","xlt","xlw","tsv","ods","xlk");
          $result    = array($request->file('member')->getClientOriginalExtension());

          if (in_array($result[0], $extension)) {
          	 
          	 $imported_user =  Excel::queueImport(new UsersImport,$request->file('member'));
          	 return back()->withSuccess('importing to database');
          }

          else{

          	return back()->with('error','please enter appropriate excel file');
          }


          

          
     }
}
