<?php

use App\Classes\PaystackRepository;
use App\Classes\Settings;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Student;
use App\Models\Transaction;

new #[Layout('admin.app')]class extends Component {
    public string $name = "";
    public $general_subject = null;
    public Student $student;
    public $transactions;
    public array $paymentData;

    public function mount()
    {
        $this->transactions = Transaction::query()
            ->whereIn('paymentable_type', ['Application fee'])
            ->where('transactionable_type', Student::class)
            ->where('transactionable_id', $this->student->id)
            ->where('status', 0)
            ->orderBy('id', 'desc')
            ->get();
    }


    public function re_query($ref)
    {
        $this->paymentData = app(Settings::class)->all();
        $confirm = PaystackRepository::validatePayStackPayment($ref, $this->paymentData['private_key']);
        if ($confirm["status"] === true) {
            $txn = Transaction::where('transactionId', $ref)->first();
            $txn->status = 1;
            $txn->save();
            $this->student->status = true;
            $this->student->application_fee_transaction_id = $txn->id;
            $this->student->save();

            $this->js("alert('Transaction updated successful!');  window.location.reload();");
        } else {
            $this->js("alert('Transaction failed - reason ".$confirm['message']['data']['status']."!')");
        }
    }
    }
?>
@section('content_header')
    <h1>Paystack Transaction List</h1>
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
        $('.delete-confirm').on('click', function (e) {
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
                    <h3 class="card-title">Transaction List</h3>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert"
                           aria-label="close">&times;</a> {{ session()->get('success') }}
                    </div>
                @endif
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
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Email Address</td>
                            <td>Amount</td>
                            <td>Transaction Type</td>
                            <td>Phone Number</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($this->transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>{{ $transaction->email }}</td>
                                <td>{{ number_format($transaction->amount, 2) }}</td>
                                <td>{{ $transaction->paymentable_type }}</td>
                                <td>{{ $transaction->phoneNumber }}</td>
                                <td>
                                    <button type="button" wire:click="re_query('{{ $transaction->transactionId }}')"
                                            class="btn btn-success btn-sm" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="re_query" class="fa fa-spin fa-spinner"
                                              role="status"></span>
                                        Re-Query
                                    </button>
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

