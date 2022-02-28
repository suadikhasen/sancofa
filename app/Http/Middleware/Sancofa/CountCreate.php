<?php

namespace App\Http\Middleware\Sancofa;
use App\Sancofa\CountBooks;

use Closure;

class CountCreate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if ((CountBooks::where('close_status',false)->exists())) {
            
            return back()->with('count','You Cant Create Untill You Finish The Open.');
        }

        return $next($request);
    }
}
