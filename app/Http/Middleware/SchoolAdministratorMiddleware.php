<?php

namespace App\Http\Middleware;

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
            return new Response(view('Unauthorized')->with('role',7));
        }
        return $next($request);
    }
}
