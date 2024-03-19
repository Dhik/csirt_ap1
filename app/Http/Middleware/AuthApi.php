<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // Example middleware logic
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (empty($token)) {
            // Token not found in headers, try getting it from the URL
            $token = $request->query('token');
        }

        // Validate and authenticate based on the $token

        return $next($request);
    }

}
