<?php

namespace App\Listeners;

use App\Classes\Settings;
use App\Mail\StudentAdmissionEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StudentAdmitted
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(\App\Events\StudentAdmitted $event): void
    {
        $student = $event->student;
        $data = [
            'title' => 'Congratulations! You Have Been Admitted',
            'body' => '<p>Dear '.$student->name.'</p><p>Congratulations! We are pleased to inform you that you have been admitted to <b>'.app(Settings::class)->get('name').'</b> for the <b>'.$student->course->name.'</b></p>'.
                'Your hard work and dedication have earned you a place in our institution, and we are excited to welcome you to our community of learners and achievers.'.
                '<p>Once again, congratulations! We are thrilled to have you join us and look forward to supporting you throughout your academic journey.</p>'.
                '<br/>'.
                '<br/>'.
                'Warm regards,'

        ];

        Mail::to($event->student->email)->send(new StudentAdmissionEmail($data));
    }
}
