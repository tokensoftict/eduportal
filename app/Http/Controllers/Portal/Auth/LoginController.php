<?php

namespace App\Http\Controllers\Portal\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


    public function loginprocess(Request $request)
    {
        if(!$request->isMethod('post')) return redirect()->route('portal.index');

        if (! \auth()->attempt($request->only(['application_number', 'password']))) {
            return redirect()->back()->withInput()->withErrors(['application_number' => "Invalid Application Number or Password combination"]);
        }

        \auth('student')->loginUsingId(auth()->user()->student_id);
        \auth('student')->setUser(Student::find(auth()->user()->student_id));

        Session::regenerate();
        return redirect()->route('portal.dashboard');
    }


    public function logout()
    {
        \auth()->logout();
        \auth('student')->logout();
        return redirect()->route('portal.index');
    }
}
