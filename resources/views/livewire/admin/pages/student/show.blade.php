<?php

use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public Student $student;

}
?>

@section('content_header')
    <h1>{{ $student->name }}</h1>
@stop

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $student->name }}</h3>
                    @if($student->status < 4 and $student->status > 0)
                        <div class="card-tools">
                            <a onclick="return confirm('Are you sure you want admit this student, this can not be reversed')" href="{{ route("student.admit", $student->id) }}" class="btn btn-success btn-sm">Admit</a>
                            <a onclick="return confirm('Are you sure you want reject this student, this can not be reversed')" href="{{ route("student.reject", $student->id) }}" class="btn btn-danger btn-sm">Rejected</a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div  class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div  class="alert alert-error">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="col-sm-10 offset-sm-1">
                        <h3 class="mb-2">Student Bio Data Details</h3>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            Full name : <br/>
                                            <h6>{{ $student?->name ?? "" }}</h6>
                                            <hr/>
                                            Status : <span class="{{ \App\Classes\Settings::ApplicationStatusLabel($student->status) }}">{{ \App\Classes\Settings::ApplicationStatus($student->status) }}</span>
                                        </div>
                                        @php
                                            $passport = NULL;
                                               if(isset($student?->document_uploaded[1])){
                                                   $passport =  asset("storage/".(explode("&&&&",$student?->document_uploaded[1]['filename'])[0]));
                                               }
                                        @endphp
                                        @if($passport !== NULL)
                                            <div class="col-12 col-sm-6 text-right">
                                                <img src="{{ $passport }}" class="img-bordered" width="150" height="150"/>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    Nationality : <br/>
                                    <h6>{{ $student?->country?->name }}</h6>
                                </td>
                                <td>
                                    State : <br/>
                                    <h6>{{ $student?->state?->name }}</h6>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    Sex : <br/>
                                    <h6>{{ $student?->gender?->name }}</h6>
                                </td>
                                <td>
                                    LGA : <br/>
                                    <h6>{{ $student?->local_govt?->name }}</h6>
                                </td>
                                <td>
                                    Religion : <br/>
                                    <h6>{{ $student?->religion?->name }}</h6>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    Place of Birth : <br/>
                                    <h6>{{ $student?->place_of_birth }}</h6>
                                </td>
                                <td>
                                    Contact Address : <br/>
                                    <h6>{{ $student?->contact_address }}</h6>
                                </td>
                                <td>
                                    Date Of Birth : <br/>
                                    <h6>{{ $student?->dob }}</h6>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Email Address : <br/>
                                    <h6>{{ $student?->email }}</h6>
                                </td>
                                <td>
                                    Phone Number : <br/>
                                    <h6>{{ $student?->phone }}</h6>
                                </td>
                                <td>
                                    Disability : <br/>
                                    <h6>{{ $student?->disability }}</h6>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Nature of Disability : <br/>
                                    <h6>{{ $student?->nature_disability }}</h6>
                                </td>
                                <td>
                                    NIN : <br/>
                                    <h6>{{ $student?->nin }}</h6>
                                </td>
                                <td>
                                    Blood Group : <br/>
                                    <h6>{{ $student?->blood_group }}</h6>
                                </td>
                            </tr>
                            <tr><td colspan="3"><h4>Guardian Details</h4></td></tr>
                            <tr>
                                <td>
                                    Name : <br/>
                                    <h6>{{ $student?->guardian_name }}</h6>
                                </td>
                                <td>
                                    Address : <br/>
                                    <h6>{{ $student?->guardian_address }}</h6>
                                </td>
                                <td>
                                    Phone Number : <br/>
                                    <h6>{{ $student?->guardian_phone }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Relationship
                                    : <br/>
                                    <h6>{{ $student?->guardian_relationship }}</h6>
                                </td>
                                <td colspan="2">
                                    Email Address : <br/>
                                    <h6>{{ $student?->guardian_email }}</h6>
                                </td>
                            </tr>
                            <tr><td colspan="3"><h4>Next Of Kin Details</h4></td></tr>
                            <tr>
                                <td>
                                    Name : <br/>
                                    <h6>{{ $student?->kin_name }}</h6>
                                </td>
                                <td>
                                    Address : <br/>
                                    <h6>{{ $student?->kin_address }}</h6>
                                </td>
                                <td>
                                    Phone Number : <br/>
                                    <h6>{{ $student?->kin_phone_no }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email Address : <br/>
                                    <h6>{{ $student?->kin_email }}</h6>
                                </td>
                                <td colspan="2">
                                    Relationship : <br/>
                                    <h6>{{ $student?->kin_relationship }}</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h3 class="mb-2">Student O-Level Details</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>Number Of Sittings</th>
                                <th>{{ $student->no_of_sittings }}</th>
                            </tr>
                        </table>
                        @if($student->no_of_sittings == "2")
                            <div class="row mt-3">
                                <div class="col-sm-6 col-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>First Sitting Exam Type</th>
                                            <th>{{ $student?->first_sitting_grade['examType'] ?? "" }}</th>
                                        </tr>
                                        <tr>
                                            <th>First Sitting Exam Number</th>
                                            <th>{{ $student?->first_sitting_grade['examNumber'] ?? "" }}</th>
                                        </tr>
                                        <tr>
                                            <th>First Sitting Exam Year</th>
                                            <th>{{ $student?->first_sitting_grade['examYear'] ?? "" }}</th>
                                        </tr>
                                    </table>
                                    <table class="table  table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Subjects</th>
                                            <th>Grades</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(($student?->first_sitting_grade ?? []) as $key => $sitting)
                                            @if(is_numeric($key))
                                                <tr>
                                                    <td>{{ \App\Models\Subject::find($student?->first_sitting_grade[$key]['subject'])->name }}</td>
                                                    <td>{{ $student?->first_sitting_grade[$key]['grade'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <table class="table table-bordered">

                                        <tr>
                                            <th>Second Sitting Exam Type</th>
                                            <th>{{ $student?->second_sitting_grade['examType'] }}</th>
                                        </tr>
                                        <tr>
                                            <th>Second Sitting Exam Number</th>
                                            <th>{{ $student?->second_sitting_grade['examNumber'] }}</th>
                                        </tr>
                                        <tr>
                                            <th>Second Sitting Exam Year</th>
                                            <th>{{ $student?->second_sitting_grade['examYear'] }}</th>
                                        </tr>
                                    </table>
                                    <table class="table  table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Subjects</th>
                                            <th>Grades</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($student?->second_sitting_grade as $key => $sitting)
                                            @if(is_numeric($key))
                                                <tr>
                                                    <td>{{ \App\Models\Subject::find($student?->second_sitting_grade[$key]['subject'])->name }}</td>
                                                    <td>{{ $student?->second_sitting_grade[$key]['grade'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="row mt-3">
                                <div class="col-sm-12 col-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>First Sitting Exam Type</th>
                                            <th>{{ $student?->first_sitting_grade['examType'] ?? "" }}</th>
                                        </tr>
                                        <tr>
                                            <th>First Sitting Exam Number</th>
                                            <th>{{ $student?->first_sitting_grade['examNumber'] ?? "" }}</th>
                                        </tr>
                                        <tr>
                                            <th>First Sitting Exam Year</th>
                                            <th>{{ $student?->first_sitting_grade['examYear'] ?? "" }}</th>
                                        </tr>
                                    </table>
                                    <table class="table  table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Subjects</th>
                                            <th>Grades</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(($student?->first_sitting_grade ?? []) as $key => $sitting)
                                            @if(is_numeric($key))
                                                <tr>
                                                    <td>{{ \App\Models\Subject::find($student?->first_sitting_grade[$key]['subject'])->name }}</td>
                                                    <td>{{ $student?->first_sitting_grade[$key]['grade'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif


                        <h3 class="mb-2">Student A-Level Details</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-right">Subject</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(($student->a_level_subjects ?? []) as $aLevelSubject)
                                <tr>
                                    @php
                                        $sub = \App\Models\AlevelSubject::find($aLevelSubject);
                                    @endphp
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-right">{{ $sub->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <h3 class="mb-2">Document(s) Uploaded</h3>
                        <table class="table table-bordered">
                            @foreach($student->document_uploaded as $key => $document)
                                <tr>
                                    <th>{{ \App\Models\DocumentUpload::find($document['type'])->name }}</th>

                                    <td class="text-right">
                                        <a target="_blank" href="{{ asset("storage/".( explode("&&&&", $document['filename'])[0] ?? "" )) }}">Download File</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
