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

    public array $student = [];

    public function mount()
    {
        $this->student = auth('student')->user()->toArray();
    }

}
?>

@section('title')
    My Account
@endsection


<div id="category-2-part">
    <div class="container">
        @if($student['status'] == true)
            <livewire:student.waiting-for-application />
        @else
            <livewire:student.registration.registration-wizard />
        @endif
    </div>
</div>
