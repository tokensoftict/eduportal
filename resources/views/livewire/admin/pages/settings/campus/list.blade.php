<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {
    public string $name = "";
    public $religions = null;

}
?>
@section('content_header')
    <h1>Campus List</h1>
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
                    <h3 class="card-title">Fees List</h3>
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
                            <td>#</td>
                            <td>Campus Name</td>
                            <td>School Fees</td>
                            <td>No of Installment</td>
                            <td>Created</td>
                            <td>Last Modified</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @php($count=0)
                        @foreach(\App\Models\Campus::all() as $fee)
                            <tr>
                                <td>{{++$count}}</td>
                                <td>{{$fee->name}}</td>
                                <td>{{number_format($fee->fees)}}</td>
                                <td>{{$fee->noOfInstalments}}</td>
                                <td>{{$fee?->created_at?->toDayDateTimeString()}}</td>
                                <td>{{$fee?->updated_at?->toDayDateTimeString()}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('campus.edit',$fee->id)}}" class="btn btn-primary">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>#</td>
                            <td>Campus Name</td>
                            <td>School Fees</td>
                            <td>No of Installment</td>
                            <td>Created</td>
                            <td>Last Modified</td>
                            <td>Actions</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

