<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


    public function loginprocess(Request $request)
    {
        if(!$request->isMethod('post')) return redirect()->route('admin.login');

        if (! Auth::guard('admin')->attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withInput()->withErrors(['email' => "Invalid email or password"]);
        }

        Session::regenerate();
        return redirect()->route('admin.dashboard');
    }

}
