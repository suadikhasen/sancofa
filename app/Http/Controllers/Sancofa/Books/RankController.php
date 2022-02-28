<?php

namespace App\Http\Controllers\Sancofa\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sancofa\Rank;
use App\Sancofa\BookMembers;
use Illuminate\Support\Facades\DB;
use App\Http\controllers\Sancofa\service\AmharicDate;
use App\Sancofa\Book;
use App\Sancofa\BookRank;
class RankController extends Controller
{

    public function index()
    {

    	$unique_year = BookRank::select('year')->distinct()->paginate(15);
    	return view('sancofa.books.bookrankyear',['unique_year'=>$unique_year]);

    }

    public function bookRank($year)
    {
    	$ranked_books = BookRank::where('year',$year)->orderBy('no_reading','desc')->paginate(15);
        return view('sancofa.books.bookrank',['ranked_books'=>$ranked_books,'year'=>$year]);

    }
}
