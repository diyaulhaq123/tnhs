<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return abort(404); // Redirect to 404 if user is not authenticated
        }

        // Check if the user has the specified role
        if (!Auth::user()->hasRole($role)) {
            return abort(404); // Redirect to 404 if user does not have the role
        }
        return $next($request);
    }
}
