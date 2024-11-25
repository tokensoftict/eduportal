<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function logout()
    {
        auth('student')->logout();
        session()->flash('status', "You have been logged out successfully!");
        return redirect()->route('student.login');
    }
}
