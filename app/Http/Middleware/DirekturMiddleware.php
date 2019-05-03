<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class DirekturMiddleware
{
    /**
     * Handle an incoming request.
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->level != 'direktur'){
            return new Response(view('unauthorized')->with('level', 'DIREKTUR'));
        }
        return $next($request);
    }
}
