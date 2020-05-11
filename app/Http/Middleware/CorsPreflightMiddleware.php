<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsPreflightMiddleware
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
        if ($request->method() === 'OPTIONS') {
            return response()->json(null);
        }
        
        return $next($request);
    }
}
