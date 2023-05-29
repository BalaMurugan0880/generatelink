<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated and has one of the required roles
        if ($user && in_array($user->role->slug, $roles)) {
            // User has one of the required roles, allow access
            return $next($request);
        }

        // User does not have the required role, deny access
        abort(403, 'Unauthorized');
    }
}
