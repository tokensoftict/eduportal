<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

new #[Layout('frontpage.layout.main')] class extends Component {
    public string $email = '';

    /**
     * Handle an incoming authentication request.
     */
    public function forgot_password(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker('student')->sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $status = Lang::get($status);
            $this->addError('email', $status);
            return;
        }

        $this->reset('email');
        session()->flash('status', Lang::get($status));
    }
}
?>

@section('title')
   FORGOT PASSWORD
@endsection

<div id="category-2-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3" style="height: 75vh">
                <div class="category-form" style="margin-top: 20px; margin-bottom: 30px;">
                    <div class="form-title text-center">
                        <span>Forgot Password</span>
                    </div>
                    <div class="main-form">
                        @if(\session()->has('status'))
                            <h6  class="text-success text-center">{{ \session()->get('status') }}</h6>
                        @endif
                        <form wire:submit="forgot_password">
                            <p class="text-body-tertiary mb-2 text-center">Enter your email below and we will <br
                                    class="d-md-none"/>send you <br class="d-none d-xxl-block"/>a reset link</p>
                            <div class="singel-form">
                                <div class="singel-form">
                                    <input type="email" wire:model="email"
                                           placeholder="Your Email Address">
                                    @error('email') <br/><span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="singel-form">
                                <button class="main-btn" type="submit" wire:target="sign_up"
                                        wire:loading.attr="disabled">Send
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

