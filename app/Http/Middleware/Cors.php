<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Call the next middleware and get the response
        $response = $next($request);

        // Set the CORS headers on the response
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");
        $response->headers->set("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, Accept, X-Token-Auth, Authorization, Access-Control-Request-Method");

        return $response;
    }

}

