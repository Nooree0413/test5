<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class Admin
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
        if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return $next($request);
        }
        // return abort(404);
         return redirect('/eventfound/user/view');
       
      

    
    }
}
