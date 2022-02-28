<?php

namespace App\Http\Controllers\Sancofa\Chart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\Book;
use App\Sancofa\Book as AllBook;

class BookChartController extends Controller
{
    public function report()
    {
    	$chart = new book;
    	$data = AllBook::groupBy('book_author')->get()->map(function($item){
    		return count($item);
    	});

    	$chart->labels($data->keys());
    	$chart->title('hasen',16,'red');
    	$chart->options([
        
         'tooltip' =>[
             
             'show' =>false,
           ]
    	]);
    	$chart->barWidth(0.5);
    	$chart->displayLegend(true);
    	// dd($data);
    	$chart->dataset('Report','bar',$data->values())->color('green')->backgroundColor('red');
    	return view('sancofa.setting.chart.graph',['chart'=>$chart]);

    }
}
