<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;

class SchoolAdministratorMiddleware
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
        if($request->user() && $request->user()->role != 7)
        {
            return new Response(view('admin.unauthorized.index')->with('role',7));
        }
        return $next($request);
    }
}
