<?php

namespace App\Http\Middleware;

use App\Models\Student;
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

        if($request->segment(3) and is_numeric($request->segment(3))) {
            auth('student')->loginUsingId($request->segment(3));
            auth('student')->setUser(Student::find($request->segment(3)));

        }

        return $next($request);
    }
}
