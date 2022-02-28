<?php

namespace App\Http\Controllers\Sancofa\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BookImport;

class BookImportController extends Controller
{
    public function import(Request $request)
     {
          $request->validate([
             
             'book' => 'required',

          ]);

          $extension = array("xls","csv","xlsx","xlm","xla","xlc","xlt","xlw","tsv","ods","xlk");
          $result    = array($request->file('book')->getClientOriginalExtension());

          if (in_array($result[0], $extension)) {
          	 
          	 $imported_user =  Excel::Import(new BookImport,$request->file('book'));
          	 return back()->with('success','imported successfully');
          }

          else{

          	return back()->with('error','please enter appropriate excel file');
          }
          
     }
}
