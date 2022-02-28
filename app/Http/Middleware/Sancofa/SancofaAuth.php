<?php

namespace App\Http\Middleware\Sancofa;

use Closure;
use Illuminate\Support\Facades\Auth;
class SancofaAuth
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
            return $next($request);
        }
        
        return redirect()->route('Sancofa.Index');
    }
}
