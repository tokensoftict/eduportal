<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

new #[Layout('frontpage.layout.main')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();
        $redirect = session('url.intended', false);

        if($redirect) {
            $this->redirect($redirect);
        } else {
            $this->redirect(route("student.dashboard"));
        }
    }
}
?>

@section('title')
    WELCOME TO EDUCATION
@endsection

<div id="category-2-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3" style="height: 75vh">
                <div class="category-form" style="margin-top: 20px; margin-bottom: 30px;">
                    <div class="form-title text-center">
                        <span>Login</span>
                    </div>
                    @if(\session()->has('status'))
                        <h6  class="text-success text-center">{{ \session()->get('status') }}</h6>
                    @endif
                    <div class="main-form">
                        <form  wire:submit="login">
                            <div class="singel-form">
                                <div class="singel-form">
                                    <input type="email"  wire:model.defer="form.user_name" placeholder="Email Address">
                                    @error('user_name') <br/><span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="singel-form">
                                    <input type="password"  wire:model.defer="form.password" placeholder="Password">
                                    @error('password') <br/><span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <a href="{{ route('student.password.request') }}">Forgot Password</a>
                            </div>
                            <div class="singel-form">
                                <button class="main-btn" type="submit" wire:target="login" wire:loading.attr="disabled">Login
                                    <span wire:loading wire:target="login" class="fa fa-spin fa-spinner" role="status"></span>
                                </button>
                            </div>
                            <div align="center" class="mt-1">New Register ? <a href="{{ route('student.register') }}">Register Now</a> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

