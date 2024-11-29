<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {


}
?>
@section('content_header')
    <h1>Student List</h1>
@stop

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@section('js')
    <script>
        $(function () {

            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });


        $('.delete-confirm').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this data!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                    )
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        });

    </script>
@endsection


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Students List</h3>
                </div>
                @if (session()->has('success'))
                    <div  class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>E-Mail</td>
                            <td>Mobile</td>
                            <td>Course</td>
                            <td>Status</td>
                            <td>Matriculation Number</td>
                            <td>Modified</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @php($count=0)
                        @foreach(\App\Models\Student::all() as $student)
                            <tr>
                                <td>{{++$count}}</td>
                                <td>{{$student?->name ?? ""}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td>{{$student?->course?->name ?? ""}}</td>
                                <td>
                                    <strong class="{{ \App\Classes\Settings::ApplicationStatusLabel($student->status) }}">{{ \App\Classes\Settings::ApplicationStatus($student->status) }}</strong>
                                </td>
                                <td>
                                    @if($student->status == 4)
                                        {{ \App\Models\User::where('student_id', $student->id)->first()?->application_number }}
                                    @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($student->updated_at)->toDayDateTimeString() }}</td>
                                <td>
                                 <a href="{{ route('student.show', $student->id) }}" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
