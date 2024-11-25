<?php

namespace App\Listeners;

use App\Classes\Settings;
use App\Mail\StudentAdmissionEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StudentRejected
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
    public function handle(\App\Events\StudentRejected $event): void
    {
        $student = $event->student;
        $data = [
            'title' => 'Admission Decision',
            'body' => '<p>Thank you for applying to '.app(Settings::class)->get('name').'. We truly appreciate the time and effort you invested in your application.</p>'.
                 '<p>After careful consideration, we regret to inform you that we are unable to offer you admission to '.$student->course->name.' at this time. Please know that this decision was not an easy one, as we received many highly qualified applications.</p>'.
                '<p>We encourage you to continue pursuing your academic goals and wish you the very best in your future endeavors.</p>'.
                '<p>If you have any questions or would like feedback on your application, please feel free to reach out to us</p>'.
                '<br/>'.
                '<br/>'.
                'Warm regards,'

        ];

        Mail::to($event->student->email)->send(new StudentAdmissionEmail($data));
    }
}
