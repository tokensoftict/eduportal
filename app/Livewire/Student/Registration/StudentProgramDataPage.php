<?php

namespace App\Livewire\Student\Registration;


use App\Models\Course;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentProgramDataPage extends StepComponent
{


    public array $courses = [];
    public string $selectedCourse = "";


    public function mount() {
        $this->courses = Course::query()->get()->toArray();
        $this->selectedCourse = auth('student')->user()?->course_id;
    }

    public function render()
    {
        return view('livewire.student.registration.student-program-data-page');
    }


    public function back()
    {
        $this->previousStep();
    }


    public function store()
    {
        $user = auth('student')->user();

        $user->course_id = $this->selectedCourse;
        $user->save();

        $this->nextStep();
    }
}
