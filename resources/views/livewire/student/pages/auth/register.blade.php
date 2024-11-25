<?php

use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

new #[Layout('frontpage.layout.main')] class extends Component {
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
        DB::transaction(function () {
            $this->validate();

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => $this->password,
            ];


            $student = Student::create($data);
            auth('student')->attempt(['email' => $this->email, 'password' => $this->password]);
            event(new Registered($student));


        });

    }

}
?>


<div id="category-2-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="category-form" style="margin-top: 20px; margin-bottom: 30px;">
                    <div class="form-title text-center">
                        <span>Sign Up</span>
                    </div>

                    <div class="main-form">
                        <form  wire:submit="sign_up">
                            <div class="singel-form">
                                <input type="text" wire:model.defer="name" placeholder="Your Full Name">
                                @error('name') <br/><span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="singel-form">
                                <input type="email" wire:model.defer="email" placeholder="Your Email Address">
                                @error('email') <br/><span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="singel-form">
                                <input type="text" wire:model.defer="phone" placeholder="Your Phone">
                                @error('phone') <br/><span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="singel-form">
                                <input type="password" wire:model.defer="password" placeholder="Password">
                                @error('password') <br/><span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="singel-form">
                                <input type="password" wire:model.defer="password_confirmation" placeholder="Confirm Password">
                                @error('password_confirmation') <br/><span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="singel-form">
                                <button class="main-btn" type="submit" wire:target="sign_up" wire:loading.attr="disabled">Register Now
                                    <span wire:loading wire:target="sign_up" class="fa fa-spin fa-spinner" role="status"></span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div align="center" class="mt-1">Already a user ? <a href="{{ route('student.login') }}">Login here</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
