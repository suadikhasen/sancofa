<?php

namespace App\Http\Middleware\Sancofa;
use Illuminate\Support\Facades\Auth;

use Closure;

class SancofaGuest
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
        if (Auth::guard('sancofa')->check()) {
            return redirect()->route('Sancofa.Home');
        }
        return $next($request);
    }
}
