<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Role as ControllersRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$role): Response
    {
        $roleUser = auth()->user()->role_user;
        if (in_array($roleUser, $role)) {
            return $next($request);
        }

        return redirect()->route(ControllersRole::redirectBasedOnRole($roleUser));
    }
}