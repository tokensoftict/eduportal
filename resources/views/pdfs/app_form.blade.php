<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Payment Receipt</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-size: 9pt;
            background-color: #fff;
        }

        #products {
            width: 90%;
        }
        #products th, #products td {
            padding-top:5px;
            padding-bottom:5px;

        }
        #products tr td {
            font-size: 8pt;
        }

        #printbox {
            width: 98%;
            margin: 5pt;
            padding: 5px;
            margin: 0px auto;
            text-align: justify;
        }

        .inv_info tr td {
            padding-right: 10pt;
        }

        .product_row {
            margin: 15pt;
        }

        .stamp {
            margin: 5pt;
            padding: 3pt;
            border: 3pt solid #111;
            text-align: center;
            font-size: 20pt;
            color:#000;
        }

        .text-center {
            text-align: center;
        }
        @page {
            footer: page-footer;
        }
    </style>
</head>
<body>
<div id="printbox">
    <table width="80%" align="center">
        <tr>
            <td width="100%" valign="top" align="center">
                <p>&nbsp;</p>
                <h1 align="center" style="text-align: center;margin-top: 40px" >{{ app(\App\Classes\Settings::class)->get('name') }}</h1>
                <h2 align="center" style="text-align: center;margin-top: 10px;">SESSION : {{ app(\App\Classes\Settings::class)->get("session") }}</h2>
                <h2 align="center" style="text-align: center;margin-top: 10px; color: red">STUDENT APPLICATION FORM</h2>
            </td>
        </tr>
    </table>
    <br/>
    <h3 class="mb-2">Bio Data </h3>
    <table class="table table-bordered" width="100%">
        <tbody>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td width="50%">
                            Full name : <br/>
                            <h6>{{ $student?->name ?? "" }}</h6>
                        </td>
                        <td width="50%" align="right">
                            @php
                                $passport = NULL;
                                               if(\App\Classes\Settings::checkForPassport(($student?->document_uploaded ?? []))){
                                                   $mypassport = \App\Classes\Settings::checkForPassport(($student?->document_uploaded ?? []));
                                                   $passport =  asset("storage/".(explode("&&&&",$mypassport['filename'])[0]));
                                               }
                            @endphp
                            @if($passport !== NULL)
                                <img src="{{ $passport }}" class="img-bordered" width="50" height="50"/>
                            @endif
                        </td>
                    </tr>
                </table>
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
                <h6>{{ $student->email }}</h6>
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
    <br/>
    <h3 class="mb-2">O-Level Details</h3>
    <table class="table table-bordered" width="100%">
        <tr>
            <th align="left">Number Of Sittings</th>
            <th align="left">{{ $student->no_of_sittings }}</th>
        </tr>
    </table>
    <br/>
    @if($student->no_of_sittings == "2")
        <div class="row mt-3">
            <div class="col-sm-6 col-12">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th align="left">First Sitting Exam Type</th>
                        <th align="left">{{ $student?->first_sitting_grade['examType'] ?? "" }}</th>
                    </tr>
                    <tr>
                        <th align="left">First Sitting Exam Number</th>
                        <th align="left">{{ $student?->first_sitting_grade['examNumber'] ?? "" }}</th>
                    </tr>
                    <tr>
                        <th align="left">First Sitting Exam Year</th>
                        <th align="left">{{ $student?->first_sitting_grade['examYear'] ?? "" }}</th>
                    </tr>
                </table>
                <table class="table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th align="left">Subjects</th>
                        <th align="left">Grades</th>
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
                <table class="table table-bordered" width="100%">

                    <tr>
                        <th align="left">Second Sitting Exam Type</th>
                        <th align="left">{{ $student?->second_sitting_grade['examType'] }}</th>
                    </tr>
                    <tr>
                        <th align="left">Second Sitting Exam Number</th>
                        <th align="left">{{ $student?->second_sitting_grade['examNumber'] }}</th>
                    </tr>
                    <tr>
                        <th align="left">Second Sitting Exam Year</th>
                        <th align="left">{{ $student?->second_sitting_grade['examYear'] }}</th>
                    </tr>
                </table>
                <table class="table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th align="left">Subjects</th>
                        <th align="left">Grades</th>
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
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th align="left">First Sitting Exam Type</th>
                        <th align="left">{{ $student?->first_sitting_grade['examType'] ?? "" }}</th>
                    </tr>
                    <tr>
                        <th align="left">First Sitting Exam Number</th>
                        <th align="left">{{ $student?->first_sitting_grade['examNumber'] ?? "" }}</th>
                    </tr>
                    <tr>
                        <th align="left">First Sitting Exam Year</th>
                        <th align="left">{{ $student?->first_sitting_grade['examYear'] ?? "" }}</th>
                    </tr>
                </table>
                <table class="table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th align="left" align="left">Subjects</th>
                        <th align="left" align="left">Grades</th>
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
    <br/>
    <h3 class="mb-2">Student A-Level Details</h3>
    <table width="100%" class="table table-bordered">
        <thead>
        <tr>
            <th align="right">#</th>
            <th align="right">Subject</th>
        </tr>
        </thead>
        <tbody>
        @foreach($student->a_level_subjects as $aLevelSubject)
            <tr>
                @php
                    $sub = \App\Models\Subject::find($aLevelSubject);
                @endphp
                <td align="right">{{ $loop->iteration }}</td>
                <td align="right">{{ $sub->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    <h3 class="mb-2">My Document(s)</h3>
    <table class="table table-bordered" width="100%">
        @foreach(($student?->document_uploaded ?? []) as $key => $document)
            <tr>
                <th align="left">{{ \App\Models\DocumentUpload::find($document['type'])->name }}</th>
            </tr>
        @endforeach
    </table>
</div>

<htmlpagefooter name="page-footer">
    <table width="100%"><tr><td style="font-size: 18px; padding-bottom: 20px;" align="right">Powered by Zenith Academy</td></tr></table>
</htmlpagefooter>
</body>
</html>
