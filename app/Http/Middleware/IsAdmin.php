<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
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
        if (Auth::guard('admin')->check() && (Auth::guard('admin')->user()->user_type == 'admin' || Auth::guard('admin')->user()->user_type == 'staff' || Auth::guard('admin')->user()->user_type == 'organization')) {
            return $next($request);
        }
        else{
            abort(404);
        }
    }
}
