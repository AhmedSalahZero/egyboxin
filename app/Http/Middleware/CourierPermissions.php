<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CourierPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->user()->isAdmin() || Auth()->user()->isCourier())
        {
            if (Auth()->user()->isAdmin() || Request()->segment(3) == Request()->user()->id)
                return $next($request);
        }
        abort(403);
    }
}
