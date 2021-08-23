<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
class MasterMiddleware
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
        if(Sentinel::check() && Sentinel::inRole('master'))
            return $next($request);
        else 
            return redirect('login');
    }
    
}
