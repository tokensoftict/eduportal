<?php

namespace App\Livewire\FrontEnd;

use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Signup extends Component
{
    public string $name;
    public string $email;
    public string $phone;
    public string $password;
    public string $password_confirmation;

    protected $rules = [
        'name' => 'required|max:255|', //regex:/^[A-Z\s]+$/
        'email' => 'required|email|unique:students,email',
        'phone' => 'required|min:11|max:11|unique:students,phone',
        'password' => 'required|min:6|confirmed',
    ];


    public function sign_up()
    {
        DB::transaction(function() {
            $this->validate();

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => $this->password,
            ];

            $student  = Student::create($data);
            auth('student')->login($student);
            event(new Registered($student));

            session()->flash('success', "Register Successfully, Please check your email to activate your account");
        });

    }
    public function render()
    {
        return view('livewire.front-end.signup');
    }
}
