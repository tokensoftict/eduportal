<div id="category-2-part" style="margin-bottom: 30px;">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Student Data Preview Page</h5>
                <h6 class="card-subtitle mb-2 text-muted">Please confirm the information below before continue</h6>
                <div class="card-body">
                    <h3 class="mb-2">Student Bio Data Details</h3>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                Full name : <br/>
                                <h6>{{ $student->name }}</h6>
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
                                        <th>{{ $student?->first_sitting_grade['examType'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>First Sitting Exam Number</th>
                                        <th>{{ $student?->first_sitting_grade['examNumber'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>First Sitting Exam Year</th>
                                        <th>{{ $student?->first_sitting_grade['examYear'] }}</th>
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
                                    @foreach($student?->first_sitting_grade as $key => $sitting)
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
                                        <th>{{ $student?->first_sitting_grade['examType'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>First Sitting Exam Number</th>
                                        <th>{{ $student?->first_sitting_grade['examNumber'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>First Sitting Exam Year</th>
                                        <th>{{ $student?->first_sitting_grade['examYear'] }}</th>
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
                                    @foreach($student?->first_sitting_grade as $key => $sitting)
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
                    <h3 class="mb-2">Document(s) Uploaded</h3>
                    <table class="table table-bordered">
                        @foreach($student->document_uploaded as $key => $document)
                            <tr>
                                <th>{{ \App\Models\DocumentUpload::find($document['type'])->name }}</th>
                                <td class="text-right"><a target="_blank" href="{{ asset("storage/".$document['filename']) }}">Download File</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="button" wire:click="back" class="btn btn-danger btn-lg">Back</button>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" wire:click="store" class="btn btn-success btn-lg">Save Changes and Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
