<?php

namespace App\Http\Middleware;

use Closure;

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
        $response = $next($request);

        // Allow all origins
        $response->header('Access-Control-Allow-Origin', '*');

        // Allow the following methods
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        // Allow the following headers
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
}