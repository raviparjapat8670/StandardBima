<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    // Check if the user is authenticated (logged in)
    if (Auth::check()) {
        // If logged in, continue with the request
        return $next($request);
    }

    // If not logged in, redirect to the login page
    return redirect()->route('admin.login')->withErrors(['error'=>'You must be logged in to access this page.']);
    }
}
