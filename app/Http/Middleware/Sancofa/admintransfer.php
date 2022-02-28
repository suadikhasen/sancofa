<?php

namespace App\Http\Middleware\Sancofa;
use Illuminate\Support\Facades\Auth;

use Closure;

class admintransfer
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
        if (Auth::guard('sancofa')->user()->role == 'admin') {
            
            return $next($request);
        }

        return back();
        
    }
}
