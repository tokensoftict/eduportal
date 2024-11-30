<?php

namespace App\Livewire\Portal\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginComponent extends Component
{
    #[Layout('admin.app')]
    public function render()
    {
        return view('livewire.portal.auth.login-component');
    }
}
