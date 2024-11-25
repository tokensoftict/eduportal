<?php

namespace App\Livewire\Student\Registration;

use App\Models\Student;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentDataPreview extends StepComponent
{
    public  $student;

    public function mount()
    {
        $this->student = auth('student')->user();
    }

    public function render()
    {
        return view('livewire.student.registration.student-data-preview');
    }

    public function back()
    {
        $this->previousStep();
    }

    public function store()
    {
        $this->nextStep();
    }
}
