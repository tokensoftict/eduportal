<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AutoLoginUserWhenVerifyingEmailAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->has("expires") and $request->has('signature') and !Session::has("url.intended")) {
            auth()->logout();
            auth('student')->logout();
            auth('admin')->logout();
            Session::put("url.intended", $request->fullUrl());
        }

        return $next($request);
    }
}
