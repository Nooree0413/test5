<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class userMiddleware
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
        if ( Auth::check() && !Auth::user()->isAdmin() )
        {
            return $next($request);
        }
        //return abort(404);
        return redirect('/admin/dashboard');
       
      
    }
}
