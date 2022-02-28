<?php

namespace App\Http\Controllers\Sancofa\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookExport;
use Maatwebsite\Excel\Concerns\WithHeadings;	
class BookExportController extends Controller
{
    public function allBooks()
    {
       
       return (new BookExport)->download('allBooks.csv');

    }
}
