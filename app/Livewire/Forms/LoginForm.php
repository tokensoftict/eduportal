<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Form;

class LoginForm extends Form
{
    #[Rule('required|string')]
    public string $user_name = '';

    #[Rule('required|string')]
    public string $password = '';

    #[Rule('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        if (filter_var($this->user_name, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $this->user_name, 'password' => $this->password];
        } else {
            $credentials = ['username' => $this->user_name, 'password' => $this->password];
        }

        if (! Auth::guard('student')->attempt($credentials, $this->remember)) {
            throw ValidationException::withMessages([
                'user_name' => 'These credentials do not match our records.',
            ]);
        }
    }

}
