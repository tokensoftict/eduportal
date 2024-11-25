<?php

namespace App\Http\Controllers\Admin;


use App\Events\StudentAdmitted;
use App\Events\StudentRejected;
use App\Models\Student;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{


    public function admit_student(Student $student)
    {
        if($student->status == "2")
            return back()->with('success', 'Student has been admitted successfully');

        $student->status = 2;
        $student->save();
        event(new StudentAdmitted($student->fresh()));
        return back()->with('success', 'Student has been admitted successfully');
    }


    public function reject_student(Student $student)
    {
        if($student->status == "3")
            return back()->with('success', 'Student has been rejected successfully');

        $student->status = 3;
        $student->save();
        event(new StudentRejected($student->fresh()));
        return back()->with('success', 'Student has been rejected successfully');
    }
}
