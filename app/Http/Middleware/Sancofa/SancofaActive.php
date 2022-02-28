<?php

namespace App\Http\Middleware\Sancofa;
use Illuminate\Support\Facades\Auth;

use Closure;

class SancofaActive
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
        if (Auth::guard('sancofa')->user()->activation) {
            return $next($request);
        }
        
        return redirect()->route('Sancofa.Index');
        
    }
}
