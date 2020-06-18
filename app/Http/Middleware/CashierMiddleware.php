<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;

class CashierMiddleware
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
        if($request->user() && $request->user()->role != 2)
        {
            return new Response(view('admin.unauthorized.index')->with('role',2));
        }
        return $next($request);
    }
}
