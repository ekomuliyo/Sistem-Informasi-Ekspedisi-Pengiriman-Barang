<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Response;

class PelangganMiddleware
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
        if($request->user() && $request->user()->level != 'pelanggan')
        {
            return new Response(view('unauthorized')->with('level', 'Pelanggan'));
        }
        return $next($request);
    }
}
