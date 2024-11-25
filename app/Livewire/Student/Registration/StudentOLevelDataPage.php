<?php

namespace App\Livewire\Student\Registration;


use App\Models\Subject;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentOLevelDataPage extends StepComponent
{
    public array $subjects = [];
    public array $firstSitting = [];
    public array $secondSitting = [];
    public string $sittings = "1";

    public array $first_sittings_compulsory, $second_sittings_compulsory = [];

    public function mount()
    {
        $user = auth('student')->user();
        $this->first_sittings_compulsory = $user?->course?->compulsory ?? [];
        $this->second_sittings_compulsory = $user?->course?->compulsory ?? [];
        $this->subjects = Subject::query()->where('status', 1)->get()->toArray();
        $this->sittings = $user->no_of_sittings;

        $cacheFirstSitting = $this->first_sittings_compulsory;
        $cacheSecondSitting = $this->second_sittings_compulsory;

        $storeFirstSitting = $user->first_sitting_grade ?? [];
        foreach ($storeFirstSitting as $key => $sitting) {
            if(is_numeric($key)) {
                $this->firstSitting[$key]['subject'] = $sitting['subject'];
                $this->firstSitting[$key]['grade'] = $sitting['grade'];
            } else {
                $this->firstSitting[$key] = $sitting;
            }
        }

        $storeSecondSitting = $user->second_sitting_grade ?? [];
        foreach ($storeSecondSitting as $key => $sitting) {
            if(is_numeric($key)) {
                $this->secondSitting[$key]['subject'] = $sitting['subject'];
                $this->secondSitting[$key]['grade'] = $sitting['grade'];
            } else {
                $this->secondSitting[$key] = $sitting;
            }
        }

        for($i = 1; $i <= 9; $i++) {
            $compulsory = null;
            if (isset($cacheFirstSitting[count($cacheFirstSitting) - 1])) {
                $compulsory = $cacheFirstSitting[count($cacheFirstSitting) - 1];
                unset($cacheFirstSitting[count($cacheFirstSitting) - 1]);
            }
            foreach ($this->subjects as $subject) {
                if (!is_null($compulsory) and $compulsory == $subject['id']) {
                    $this->firstSitting[$i]['subject'] = $subject['id'];
                    $compulsory = null;
                }
            }
        }
        for($i = 1; $i <= 9; $i++) {
            $compulsory = null;
            if (isset($cacheSecondSitting[count($cacheSecondSitting) - 1])) {
                $compulsory = $cacheSecondSitting[count($cacheSecondSitting) - 1];
                unset($cacheSecondSitting[count($cacheSecondSitting) - 1]);
            }
            foreach ($this->subjects as $subject) {
                if (!is_null($compulsory) and $compulsory == $subject['id']) {
                    $this->secondSitting[$i]['subject'] = $subject['id'];
                    $compulsory = null;
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.student.registration.student-o-level-data-page');
    }

    public function back()
    {
        $this->previousStep();
    }

    public function store()
    {
        $user = auth('student')->user();
        $user->first_sitting_grade = $this->firstSitting;
        if($this->sittings == "2") {
            $user->second_sitting_grade = $this->secondSitting;
        } else {
            $user->second_sitting_grade = [];
        }

        $user->no_of_sittings = $this->sittings;

        $user->save();

        $this->nextStep();
    }
}
