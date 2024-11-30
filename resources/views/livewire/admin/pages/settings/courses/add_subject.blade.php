<?php

use App\Models\Course;
use App\Models\Religion;
use App\Models\Subject;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public array $selected_subjects = [];
    public $id;
    public array $compulsory;

    public function mount()
    {
        if (!isset($this->id)) {
            return $this->redirect(route('courses.index'), false);
        }

        $course = Course::find($this->id);

        if (!$course) {
            return $this->redirect(route('courses.index'), false);
        }

        foreach (Subject::where('status', 1)->orderBy('name', 'ASC')->get() as $subject) {
            if(in_array($subject->id, ($course->compulsory ?? []))) {
                $this->selected_subjects[$subject->id] = true;
            } else {
                $this->selected_subjects[$subject->id] = false;
            }
        }

        $this->compulsory = $course->compulsory ?? [];
    }


    public function store()
    {
        $subject = [];

        foreach ($this->selected_subjects as $key => $value) {
            if($value) {
                $subject[] = $key;
            }
        }

        $course = Course::find($this->id);

        $course->compulsory = $subject;
        $course->save();

        return $this->redirect(route('courses.add_subject', $course->id), false);

    }

}
?>

@section('title','New Course')

@section('content_header')
    <h1>Add Compulsory Subjects</h1>
@stop

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add Compulsory Subjects</h3>
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
                        <div class="row">
                            @csrf
                            @php
                                $allsubjects = \App\Models\Subject::where('status', 1)->orderBy('name', 'ASC')->get()->chunk(3);
                                $count = 1;
                            @endphp
                            @foreach($allsubjects as $subjects)
                                <div class="col-4">
                                    @foreach($subjects as $subject)
                                        <input type="checkbox" @if(in_array($subject->id, $compulsory)) checked @endif  value="{{ $subject->id }}"
                                               wire:model="selected_subjects.{{ $subject->id }}">
                                        {{ $subject->name }} <br/>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
