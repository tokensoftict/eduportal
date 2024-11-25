<?php

use App\Models\Fee;
use App\Models\Religion;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public string $name = "";
    public string $amount = "";
    public $id;

    public function mount()
    {
        if (isset($this->id)) {
            $fee =Fee::find($this->id);
            $this->name = $fee->name;
            $this->amount = $fee->amount;
        }
    }

    public function store()
    {
        $this->validate(['name' => "required", 'amount' => 'required|numeric']);

        if (isset($this->id)) {
            $fee = Fee::find($this->id);
            $fee->name = $this->name;
            $fee->amount = $this->amount;
        } else {
            $fee = new Fee([
                'name' => $this->name,
                'amount' => $this->amount
            ]);
        }

        $fee->save();
        return $this->redirect(route('fees.index'), false);
    }

}
?>

@section('title','Add a Religion')

@section('content_header')
    <h1>New Fee</h1>
@stop

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">New Fee</h3>
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
                            <input type="text" wire:model="name" class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Amount:</label>
                            <input type="text" wire:model="amount" class="form-control" name="amount"/>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
