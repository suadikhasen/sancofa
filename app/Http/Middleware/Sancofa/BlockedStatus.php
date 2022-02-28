<?php

namespace App\Http\Middleware\Sancofa;
use App\Sancofa\BlockedUser as block;

use Closure;
use Auth;

class BlockedStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   if (block::where('member_sancofa_id',Auth::guard('sancofa')->user()->sancofa_id)->exists()) {
           
           Auth::guard('sancofa')->logout();
           return redirect('/');
        }
    
        return $next($request);
    }
}
