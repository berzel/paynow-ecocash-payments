<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
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
        $corsHeaders = [
            'Access-Control-Max-Age' => '86400',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Headers' => 'Content-Type',
            'Access-Control-Allow-Methods' => 'POST, GET, PUT, DELETE, OPTIONS'
        ];

        $response = $next($request);

        foreach ($corsHeaders as $header => $value) {
            $response->headers->set($header, $value);
        }
        
        return $response;
    }
}
