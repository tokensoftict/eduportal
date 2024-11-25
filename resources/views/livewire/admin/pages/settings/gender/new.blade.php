<?php

use App\Models\Gender;
use App\Models\Religion;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public string $name = "";
    public $id;

    public function mount()
    {
        if (isset($this->id)) {
            $religion = Gender::find($this->id);
            $this->name = $religion->name;
        }
    }

    public function store()
    {
        $this->validate(['name' => "required"]);

        if (isset($this->id)) {
            $religion = Gender::find($this->id);
            $religion->name = $this->name;
        } else {
            $religion = new Gender([
                'name' => $this->name
            ]);
        }

        $religion->save();
        return $this->redirect(route('genders.index'), false);
    }

}
?>

@section('title','Add a Religion')

@section('content_header')
    <h1>Add a Gender</h1>
@stop

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add a Gender</h3>
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
                        <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
