<?php

namespace App\Livewire\Student\Registration;


use App\Models\AlevelSubject;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentAlevelSubjects extends StepComponent
{
    public array $aLevelSubjects = [];
    public array $subjects = [];
    public string $selectedSubject = '';


    public function mount()
    {
        $user = auth('student')->user();
        $this->aLevelSubjects = $user->a_level_subjects ?? [];
        $this->subjects = AlevelSubject::query()->pluck('name', 'id')->toArray();
    }


    public function addSubject()
    {
        foreach ($this->aLevelSubjects as $key => $value) {
            if ($value == $this->selectedSubject) {
                $this->selectedSubject = "";
                return;
            }
        }

        $this->aLevelSubjects[] = $this->selectedSubject;
        $this->selectedSubject = "";
    }


    public function removeSubject($id)
    {
        foreach ($this->aLevelSubjects as $key => $value) {
            if ($value == $id) {
                unset($this->aLevelSubjects[$key]);
            }
        }
    }

    public function render()
    {
        return view('livewire.student.registration.student-alevel-subjects');
    }

    public function store()
    {
        $user = auth('student')->user();
        $user->a_level_subjects = $this->aLevelSubjects ?? [];
        $user->save();
        $this->nextStep();
    }

    public function back()
    {
        $this->previousStep();
    }
}
