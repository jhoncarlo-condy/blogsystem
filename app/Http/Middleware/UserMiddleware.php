<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return <mixed></mixed>
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->usertype == 3)
        {
            return $next($request);
        }
        else {
            return redirect('/blog/users')->with('status','Forbidden Access');
        }

    }
}
