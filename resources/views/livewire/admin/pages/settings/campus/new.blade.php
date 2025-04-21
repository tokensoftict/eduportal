<?php

use App\Models\Fee;
use App\Models\Religion;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public string $name = "";
    public string $fees = "";
    public string $noOfInstalments ="";
    public $id;

    public function mount()
    {
        if (isset($this->id)) {
            $fee =\App\Models\Campus::find($this->id);
            $this->name = $fee->name;
            $this->fees = $fee->fees;
            $this->noOfInstalments = $fee->noOfInstalments;
        }
    }

    public function store()
    {
        $this->validate(['name' => "required", 'fees' => 'required|numeric', 'noOfInstalments' => 'required|numeric']);


        if (isset($this->id)) {
            $fee = \App\Models\Campus::find($this->id);
            $fee->name = $this->name;
            $fee->fees = $this->fees;
            $this->noOfInstalments = $fee->noOfInstalments;
        } else {
            $fee = new \App\Models\Campus([
                'name' => $this->name,
                'fees' => $this->fees,
                'noOfInstalments' => $this->noOfInstalments
            ]);
        }

        $fee->save();
        return $this->redirect(route('campus.index'), false);
    }

}
?>

@section('title','Add New Campus')

@section('content_header')
    <h1>New Campus</h1>
@stop

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Campus</h3>
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
                            <label for="name">Campus Name:</label>
                            <input type="text" wire:model="name" class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Campus School Fee:</label>
                            <input type="text" wire:model="fees" class="form-control" name="fees"/>
                        </div>
                        <div class="form-group">
                            <label for="name">No of installment(s):</label>
                            <input type="text" wire:model="noOfInstalments" class="form-control" name="noOfInstalments"/>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
