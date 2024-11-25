<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function registration_successful()
    {
        return view('student.auth.registration_successful');
    }

}
