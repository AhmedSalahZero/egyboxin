<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OperatorOrAccountantPermissions
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
        if(Auth()->user()->type == 'admin'||Auth()->user()->type == 'operator' ||Auth()->user()->type == 'accountant')
        {
            return $next($request);
        }
        abort(403);
    }
}
