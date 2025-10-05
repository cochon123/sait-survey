<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user is authenticated and profile is not completed
        if ($user && !$user->profile_completed) {
            // Don't redirect if already on profile completion page
            if (!$request->routeIs('profile.complete') && !$request->routeIs('profile.complete.store')) {
                return redirect()->route('profile.complete');
            }
        }

        return $next($request);
    }
}
