<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class AdminMiddleware
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
        if (Auth::user()) 
        {
            // if (auth()->user()->role_id == 5) {
            //    return $next($request);
            // }

            if (Auth::user()->role->name == "Admin" || Auth::user()->role->name == "Top Management") {
               return $next($request);
            }
        }
        else
        {
            return redirect()->guest(route('login'));
        }
        
       abort(401);
    }

}
