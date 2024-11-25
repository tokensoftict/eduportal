<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;
use \Illuminate\Support\Facades\Lang;

new #[Layout('frontpage.layout.main')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::broker('student')->reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => bcrypt($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', Lang::get($status));

            return;
        }

        Session::flash('status', Lang::get($status));

        $this->redirectRoute('student.login');
    }
}; ?>

@section('title')
    RESET PASSWORD
@endsection

<div id="category-2-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3" style="height: 75vh">
                <div class="category-form" style="margin-top: 20px; margin-bottom: 30px;">
                    <div class="form-title text-center">
                        <span>Reset Password</span>
                    </div>
                    <div class="main-form">
                        <form wire:submit="resetPassword">
                            @if(\session()->has('status'))
                                <h6  class="text-success text-center">{{ \session()->get('status') }}</h6>
                            @endif
                            <p class="text-body-tertiary text-center">Type your new password</p>
                            <div class="singel-form">
                                <div class="singel-form">
                                    <input  wire:model="email" id="email" type="email" required autofocus autocomplete="username" placeholder="Email" />
                                    @error('email') <br/><span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="singel-form">
                                    <input  wire:model="password" id="password" type="password" required name="password" placeholder="New Password" autocomplete="new-password" />
                                    @error('password')
                                    <span  class="d-block text-danger small mb-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="singel-form">
                                    <input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required placeholder="Confirm Password" autocomplete="new-password" />
                                    @error('password_confirmation')
                                    <span class="d-block text-danger small mb-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="singel-form">
                                <button class="main-btn" type="submit" wire:target="sign_up"
                                        wire:loading.attr="disabled">Reset Password
                                    <span wire:loading wire:target="sign_up" class="fa fa-spin fa-spinner"
                                          role="status"></span>
                                </button>
                            </div>
                            <div align="center" class="mt-1"><a href="{{ route('student.login') }}">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
