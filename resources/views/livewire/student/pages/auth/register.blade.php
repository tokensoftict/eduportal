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


}
?>


<div id="category-2-part" style="margin-bottom: 30px; height: auto; min-height: 70vh">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="category-form" style="margin-top: 20px; margin-bottom: 30px;">
                    <div class="form-title text-center">
                        <span>Sign Up</span>
                    </div>
                    <div class="main-form">
                        @livewire('front-end.signup')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
