<?php

namespace App\Http\Middleware;

use Closure;

class KurirMiddleware
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
        if($request->user() && $request->user()->level != 'kurir')
        {
            return new Response(view('unauthorized')->with('level', 'Kurir'));
        }
        return $next($request);
    }
}
