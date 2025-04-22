<?php

namespace App\Livewire\Student\Registration;


use App\Models\Campus;
use App\Models\Course;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentProgramDataPage extends StepComponent
{


    public array $courses = [];
    public array $campuses = [];
    public string $selectedCourse = "";
    public string $selectedCampus = "";


    public function mount() {
        $this->courses = Course::query()->get()->toArray();
        $this->campuses = Campus::query()->get()->toArray();
        $this->selectedCourse = auth('student')->user()?->course_id ?? "";
        $this->selectedCampus = auth('student')->user()?->campus_id ?? "";
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
        $this->validate(['selectedCourse' => 'required', 'selectedCampus' => 'required']);
        $user = auth('student')->user();

        $user->course_id = $this->selectedCourse;
        $user->campus_id = $this->selectedCampus;
        $user->save();

        $this->nextStep();
    }
}
