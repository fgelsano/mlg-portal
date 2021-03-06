<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;

class ParentMiddleware
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
        if($request->user() && $request->user()->role != 6)
        {
            return new Response(view('admin.unauthorized.index')->with('role',6));
        }
        return $next($request);
    }
}
