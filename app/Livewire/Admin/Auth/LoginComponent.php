<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginComponent extends Component
{
    #[Layout('admin.app')]
    public function render()
    {
        return view('livewire.admin.auth.login-component');
    }
}
