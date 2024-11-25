<?php

use App\Classes\Settings;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {
    public array $data = [];

    public function mount()
    {
        $settings = app(Settings::class);
        $this->data = $settings->all();
    }

    public function store()
    {
        $settings = app(Settings::class);
        $settings->put($this->data);
    }
}
?>

@section('title','System Settings')

@section('content_header')
    <h1>System Settings</h1>
@stop


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">System Settings</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <div class="card-body">
                    <form method="post" wire:submit.prevent="store">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" wire:model="data.name" class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Address:</label>
                            <input type="text" wire:model="data.address" class="form-control" name="address"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Application Fee:</label>
                            <input type="text" wire:model="data.application_fee" class="form-control"
                                   name="application_fee"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Acceptance Fee:</label>
                            <input type="text" wire:model="data.acceptance_fee" class="form-control" name="acceptance_fee"/>
                        </div>
                        <h3>Paystack Settings</h3>
                        <div class="form-group">
                            <label for="name">Private Key:</label>
                            <input type="text" wire:model="data.private_key" class="form-control" name="private_key"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Public Key:</label>
                            <input type="text" wire:model="data.public_key" class="form-control" name="public_key"/>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

