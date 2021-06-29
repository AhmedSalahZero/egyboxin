<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OperatorPermissions
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
        if(Auth()->user()->type == 'admin'||Auth()->user()->type == 'operator')
        {
            return $next($request);
        }
        abort(403);
    }
}
