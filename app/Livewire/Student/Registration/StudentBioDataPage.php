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

    protected $messages = [
        'data.country_id.required' => 'Please select country',
        'data.state_id.required' => 'Please select state',
        'data.gender_id.required' => 'Gender field is required',
        'data.religion_id.required' => 'Religion field is required',
        'data.local_govt_id.required' => 'Local Govt field is required',
        'data.disability.required' => 'Disability State is required',

        'data.nature_disability.required' => 'nature of disability is required',
        'data.blood_group.required' => 'Blood group is required',
        'data.place_of_birth.required' => 'Place of birth field is required',
        'data.contact_address.required' => 'Contact Address field is required',
        'data.dob.required' => 'Date of Birth field is required',
        'data.phone.required' => 'Phone is required',

        'data.nin.required' => 'NIN of disability is required',
        'data.guardian_name.required' => 'Guardian name is required',
        'data.guardian_address.required' => 'Guardian Address field is required',
        'data.guardian_phone.required' => 'Guardian Phone field is required',
        'data.guardian_email.required' => 'Guardian Email field is required',
        'data.guardian_relationship.required' => 'Guardian Relationship is required',


        'data.kin_name.required' => 'Kin name is required',
        'data.kin_address.required' => 'Kin address is required',
        'data.kin_relationship.required' => 'Kin Relationship field is required',
        'data.kin_phone_no.required' => 'Kin Phone field is required',
        'data.kin_email.required' => 'kin Email field is required',
    ];

    protected function rules()
    {
        $data = [
            'data.country_id' => 'required',
            'data.state_id' => 'required',
            'data.gender_id' => 'required',
            'data.religion_id' => 'required',
            'data.local_govt_id' => 'required',
            'data.disability' => 'required',
        ];

        if($this->data['disability'] == "Yes") {
            $data['data.nature_disability'] = "required";
        }

        $data['data.blood_group'] = "required";
        $data['data.place_of_birth'] = "required";
        $data['data.contact_address'] = "required";
        $data['data.dob'] = "required";
        $data['data.phone'] = "required";
        $data['data.nin'] = "required";
        $data['data.guardian_name'] = "required";
        $data['data.guardian_address'] = "required";
        $data['data.guardian_phone'] = "required";
        $data['data.guardian_email'] = "required";
        $data['data.guardian_relationship'] = "required";

        $data['data.kin_name'] = "required";
        $data['data.kin_relationship'] = "required";
        $data['data.kin_address'] = "required";
        $data['data.kin_phone_no'] = "required";
        $data['data.kin_email'] = "required";

        return $data;
    }

    public function mount()
    {

        $student = auth('student')->user()->toArray();

        $this->data['country_id'] =  $this->data['country_id'] ?? ($student['country_id'] ?? config('app.DEFAULT_COUNTRY_ID'));
        $this->data['state_id'] =  $this->data['state_id'] ?? $student['state_id'];
        $this->data['gender_id'] =  $this->data['gender_id'] ?? $student['gender_id'];
        $this->data['religion_id'] =  $this->data['religion_id'] ?? $student['religion_id'];
        $this->data['local_govt_id'] =  $this->data['local_govt_id'] ?? $student['local_govt_id'];
        $this->data['disability'] =  $this->data['disability'] ?? ($student['disability']);
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
        $this->validate();

        $student = auth('student')->user();

        $student->update($this->data);

        $this->nextStep();
    }
}
