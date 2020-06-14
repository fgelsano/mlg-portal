<?php

namespace App\Http\Middleware;

use Closure;

class RegistrarMiddleware
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
        if($request->user() && $request->user()->role != 1)
        {
            return new Response(view('Unauthorized')->with('role',1));
        }
        return $next($request);
    }
}