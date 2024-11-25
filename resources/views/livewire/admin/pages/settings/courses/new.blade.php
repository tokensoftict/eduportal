<?php

use App\Models\Course;
use App\Models\Religion;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public string $name = "";
    public string $description = "";
    public string $prefix = "";
    public $id;

    public function mount()
    {
        if (isset($this->id)) {
            $course = Course::find($this->id);
            $this->name = $course->name;
            $this->description = $course->description;
            $this->prefix = $course->prefix;
        }
    }

    public function store()
    {
        $this->validate(['name' => "required"]);

        if (isset($this->id)) {
            $course = Course::find($this->id);
            $course->name = $this->name;
            $course->description = $this->description;
            $course->prefix = $this->prefix;
        } else {
            $course = new Course([
                'name' => $this->name,
                'description' => $this->description,
                'prefix' => $this->prefix
            ]);
        }

        $course->save();
        return $this->redirect(route('courses.index'), false);
    }

}
?>

@section('title','New Course')

@section('content_header')
    <h1>Add a Religion</h1>
@stop

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">New Course</h3>
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
                            <label for="name">Course Prefix (e.g Bsc):</label>
                            <input type="text" wire:model="prefix" class="form-control" name="prefix"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Course Name:</label>
                            <input type="text" wire:model="name" class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Description:</label>
                            <textarea class="form-control" wire:model="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
