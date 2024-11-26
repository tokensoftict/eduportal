<div>

    @if(\session()->has('success'))
        <h6  class="text-success text-center">{{ \session()->get('success') }}</h6>
    @endif

    <form @if(\session()->has('success')) style="display: none;"  @endif  wire:submit.prevent="sign_up">
        <div class="singel-form">
            <input type="text"  wire:model.defer="firstname" placeholder="Surname">
            @error('firstname') <br/><span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="singel-form">
            <input type="text"  wire:model.defer="lastname" placeholder="Firstname">
            @error('lastname') <br/><span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="singel-form">
            <input type="text"  wire:model.defer="middlename" placeholder="Middlename">
            @error('middlename') <br/><span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="singel-form">
            <input type="email"  wire:model.defer="email" placeholder="Email Address">
            @error('email') <br/><span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="singel-form">
            <input type="text"  wire:model.defer="phone" placeholder="Phone">
            @error('phone') <br/><span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="singel-form">
            <input type="password"  wire:model.defer="password" placeholder="Password">
            @error('password') <br/><span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="singel-form">
            <input type="password"  wire:model.defer="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation') <br/><span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="singel-form">
            <button class="main-btn" type="submit" wire:target="sign_up" wire:loading.attr="disabled">Register Now
                <span wire:loading wire:target="sign_up" class="fa fa-spin fa-spinner" role="status"></span>
            </button>
        </div>
        <div align="center" class="mt-1">Already a user ? <a href="{{ route('student.login') }}">Login here</a> </div>
    </form>
</div>
