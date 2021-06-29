<?php

namespace App\Http\Middleware;

use App\Models\Barcode;
use Closure;
use Illuminate\Http\Request;

class sellerCanPrint
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
        if(Auth()->user()->type =='seller' && Barcode::where('id',$request->segment(3))->first()->seller_id != Auth()->user()->id )
        {
            abort(403);
        }
        return $next($request);

    }
}
