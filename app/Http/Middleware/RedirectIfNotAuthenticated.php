<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {

        if (!Auth::guard($guard)->check()) {
            // Redirect based on the guard
            if ($guard === 'admin') {
                return redirect()->route('admin.login');
            }

            if ($guard === 'student') {
                return redirect()->route('student.login');
            }

            // Default to web guard
            return redirect()->route('login');
        }

        return $next($request);
    }

}
