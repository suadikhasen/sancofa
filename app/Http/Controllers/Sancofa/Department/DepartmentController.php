<?php

namespace App\Http\Controllers\Sancofa\Department;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\Department;
class DepartmentController extends Controller
{
     public function index()
     {
        $department = Department::all();
        return view('sancofa.department.index');
     }

     public function add(Request $request)
     {
        $request->validate([
           'name' => 'required|string',
        ]);

        Department::create([
         'name' => $request->name,
        ]);

        return back()->with('add','department added successfully');
     }
}
