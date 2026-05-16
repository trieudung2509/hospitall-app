<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUser
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
        if (Auth::guard('web')->check() && 
                (Auth::guard('web')->user()->user_type == 'customer' || 
                Auth::guard('web')->user()->user_type == 'seller' || 
                Auth::guard('web')->user()->user_type == 'user' ||
                Auth::guard('web')->user()->user_type == 'delivery_boy') ) {
            
            return $next($request);
        }
        else{
            session(['link' => url()->current()]);
            return redirect()->route('user.login');
        }
    }
}
