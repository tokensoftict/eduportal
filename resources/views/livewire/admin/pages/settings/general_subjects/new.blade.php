<?php

use App\Models\Gender;
use App\Models\Religion;
use App\Models\Subject;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public string $name = "";
    public $id;

    public function mount()
    {
        if (isset($this->id)) {
            $subject = Subject::find($this->id);
            $this->name = $subject->name;
        }
    }

    public function store()
    {
        $this->validate(['name' => "required"]);

        if (isset($this->id)) {
            $subject = Subject::find($this->id);
            $subject->name = $this->name;
        } else {
            $subject = new Subject([
                'name' => $this->name
            ]);
        }

        $subject->save();
        return $this->redirect(route('general_subjects.index'), false);
    }

}
?>

@section('title','Add a Religion')

@section('content_header')
    <h1>Add a Subject</h1>
@stop

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add a Subject</h3>
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
