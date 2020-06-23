<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;

class InstructorMiddleware
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
        if($request->user() && $request->user()->role != 4 || $request->user()->role != 5)
        {
            return new Response(view('admin.unauthorized.index')->with('role','Instructor'));
        }
        return $next($request);
    }
}
