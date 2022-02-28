<?php

namespace App\Http\Controllers\Sancofa\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

class MemberExportController extends Controller
{
     public function allMember()
     {
        return (new UserExport)->download('allmember.csv');

     }
}
