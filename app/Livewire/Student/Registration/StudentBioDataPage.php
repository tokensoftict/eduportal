<?php

namespace App\Livewire\Student\Registration;

use App\Models\Country;
use App\Models\Gender;
use App\Models\LocalGovt;
use App\Models\Religion;
use App\Models\State;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentBioDataPage extends StepComponent
{
    public array $nationalites = [];
    public array $states = [];
    public array $genders = [];
    public array $religions = [];
    public array $lgas = [];


    public array $data = [];

    public function mount()
    {

        $student = auth('student')->user()->toArray();

        $this->data['country_id'] =  $this->data['country_id'] ?? ($student['country_id'] ?? config('app.DEFAULT_COUNTRY_ID'));
        $this->data['state_id'] =  $this->data['state_id'] ?? $student['state_id'];
        $this->data['gender_id'] =  $this->data['gender_id'] ?? $student['gender_id'];
        $this->data['religion_id'] =  $this->data['religion_id'] ?? $student['religion_id'];
        $this->data['local_govt_id'] =  $this->data['local_govt_id'] ?? $student['local_govt_id'];
        $this->data['disability'] =  $this->data['disability'] ?? $student['disability'];
        $this->data['nature_disability'] =  $this->data['nature_disability'] ?? $student['nature_disability'];
        $this->data['blood_group'] =  $this->data['blood_group'] ?? $student['blood_group'];
        $this->data['place_of_birth'] =  $this->data['place_of_birth'] ?? $student['place_of_birth'];
        $this->data['contact_address'] =  $this->data['contact_address'] ?? $student['contact_address'];
        $this->data['dob'] =  $this->data['dob'] ??  $student['dob'];
        $this->data['phone'] =  $this->data['phone'] ??  $student['phone'];
        $this->data['nin'] =  $this->data['nin'] ?? $student['nin'];


        $this->data['guardian_name'] =  $this->data['guardian_name'] ?? $student['guardian_name'];
        $this->data['guardian_address'] =  $this->data['guardian_address'] ?? $student['guardian_address'];
        $this->data['guardian_phone'] =  $this->data['guardian_phone'] ?? $student['guardian_phone'];
        $this->data['guardian_email'] =  $this->data['guardian_email'] ?? $student['guardian_email'];
        $this->data['guardian_relationship'] =  $this->data['guardian_relationship'] ?? $student['guardian_relationship'];


        $this->data['kin_name'] =  $this->data['kin_name'] ?? $student['kin_name'];
        $this->data['kin_relationship'] =  $this->data['kin_relationship'] ?? $student['kin_relationship'];
        $this->data['kin_address'] =  $this->data['kin_address'] ?? $student['kin_address'];
        $this->data['kin_phone_no'] =  $this->data['kin_phone_no'] ?? $student['kin_phone_no'];
        $this->data['kin_email'] =  $this->data['kin_email'] ?? $student['kin_email'];



        $this->nationalites = Country::query()->pluck('name', 'id')->toArray();
        $this->states = State::query()->where('country_id', $this->data['country_id'])->pluck('name', 'id')->toArray();
        $this->genders = Gender::query()->pluck('name', 'id')->toArray();
        $this->religions = Religion::query()->pluck('name', 'id')->toArray();
        $this->lgas = LocalGovt::query()->where('state_id', $this->data['state_id'])->pluck('name', 'id')->toArray();


    }
    public function render()
    {
        $this->lgas = LocalGovt::query()->where('state_id', $this->data['state_id'])->pluck('name', 'id')->toArray();
        $this->states = State::query()->where('country_id', $this->data['country_id'])->pluck('name', 'id')->toArray();

        return view('livewire.student.registration.student-bio-data-page');
    }


    public function store()
    {
        $student = auth('student')->user();

        $student->update($this->data);

        $this->nextStep();
    }
}
