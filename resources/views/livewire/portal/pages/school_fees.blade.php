<?php

use App\Classes\PaystackRepository;
use App\Classes\Settings;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('admin.app')] class extends Component {

    public $student;
    public $user;
    public $charges = 300;
    public array $paymentData;
    public  $asPaySchoolFee;
    public array $installments = [];

    public function mount()
    {
        $user = auth()->user();
        $this->student = Student::find($user->student_id);
        $this->paymentData = $this->student->campus->toArray();
        $this->paymentData = array_merge($this->paymentData, app(Settings::class)->all());
        $this->paymentData['amount'] = $this->paymentData['fees'];
        $this->asPaySchoolFee = Transaction::where('paymentable_type',\App\Models\Fee::class)
                ->where("paymentable_id", $this->paymentData['id'])
                ->where('transactionable_type', User::class)
                ->where('transactionable_id', auth()->id())
                ->where("status", 4)
                ->where('session', app(\App\Classes\Settings::class)->get("session"))
                ->first();
        for($i =1; $i <= $this->paymentData['noOfInstalments']; $i++) {
            $this->installments[$i] = [
                'amount' => ($this->paymentData['amount'] / $this->paymentData['noOfInstalments']),
                'name' => $this->ordinal($i)."'s installment",
                'id' => $i
            ];
        }
    }

    public function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

    public function generateTransaction()
    {
        $transaction = Transaction::create([
            'transactionId' => md5(time() . "-" . mt_rand(10000000, 1000000000000)),
            'transactionable_type' => User::class,
            'transactionable_id' => auth()->id(),
            'date' => date("Y-m-d"),
            'amount' => $this->charges + $this->paymentData["amount"],
            'currency' => "NGN",
            "country" => "Nigeria",
            "email" => $this->student->email,
            "phoneNumber" => $this->student->phone,
            "name" => auth()->user()->name,
            "semester" => "First",
            "gateway" => "PAYSTACK",
            "paymentable_type" => \App\Models\Fee::class,
            "paymentable_id" => $this->paymentData['id']
        ]);

        return $transaction->toArray();
    }


    public function confirmPayment($transactionId)
    {
        $confirm = PaystackRepository::validatePayStackPayment($transactionId, $this->paymentData['private_key']);
        if ($confirm["status"] == true) {
            $txn = Transaction::where('transactionId', $transactionId)->first();
            $txn->status = 4;
            $txn->save();

            return "success";
        }

        return "failed";
    }

}
?>

@section('content_header')
    <h1>{{ $student->name }}</h1>
@endsection



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Select Installment</strong></h3>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control" wire:model="installment">
                                @foreach($this->installments as $installment)
                                    <option value="{{ $installment['id'] }}">{{ $installment['name'] }} - {{ number_format($installment['amount'],2) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>School Fees Payment</strong></h3>
                </div>
                <div class="card-body">
                    @if(!$asPaySchoolFee)
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-left">Student Name</th>
                                <td class="text-right"><strong>{{ $student->name }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Phone Number</th>
                                <td class="text-right"><strong>{{ $student->phone }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Email Address</th>
                                <td class="text-right"><strong>{{ $student->email }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Current Session</th>
                                <td class="text-right">
                                    <strong>{{ app(\App\Classes\Settings::class)->get("session") }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Payment</th>
                                <td class="text-right"><strong>School Fee</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Amount</th>
                                <th class="text-right">(=N=) {{ number_format($paymentData['amount'],2) }}</th>
                            </tr>
                            <tr>
                                <th class="text-left">Paystack Charges</th>
                                <th class="text-right">(=N=) {{ number_format($charges,2) }}</th>
                            </tr>
                            <tr>
                                <th class="text-left">Total</th>
                                <th class="text-right">
                                    (=N=) {{ number_format(($paymentData['amount']+$charges),2) }}</th>
                            </tr>
                        </table>

                        <button wire:ignore type="button" id="payNow" class="btn btn-block btn-success mt-4">Pay
                            (=N=) {{ number_format(($paymentData['amount']+$charges),2) }} Now
                        </button>

                    @else
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-left">Student Name</th>
                                <td class="text-right"><strong>{{ $student->name }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Phone Number</th>
                                <td class="text-right"><strong>{{ $student->phone }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Email Address</th>
                                <td class="text-right"><strong>{{ $student->email }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Current Session</th>
                                <td class="text-right">
                                    <strong>{{ app(\App\Classes\Settings::class)->get("session") }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-left">Status</th>
                                <td class="text-right text-success"><strong>Paid</strong></td>
                            </tr>
                            <tr>
                                <th colspan="2"><a target="_blank" href="{{ route('student.download.application_receipt', $asPaySchoolFee->id) }}" class="btn btn-success btn-block">Download Receipt</a></th>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.paystack.co/v2/inline.js"></script>
@script
<script>
    $('#payNow').off('click');
    $('#payNow').on("click", function () {
        $(this).attr('disabled', 'disabled').html('Please wait..')
        @this.generateTransaction().then(function (response) {
            var handler = PaystackPop.setup({
                key: '{{ $paymentData['public_key'] }}', // This is your public key only!
                email: response['email'], // Customers email
                amount: response['amount'] * 100, // The amount charged, I like big money lol
                ref: response['transactionId'], // Generate a random reference number and put here",
                metadata: { // More custom information about the transaction
                    custom_fields: [
                        {
                            'payment_type': 'School Fee'
                        }
                    ]
                },
                callback: function (paystackResponse) {
                    $('#payNow').removeAttr("disabled").html("Confirming Payment Please wait....").attr('disabled', 'disabled');
                    @this.
                    confirmPayment(paystackResponse.reference).then(function (confirmResponse) {
                        if (confirmResponse === "success") {
                            alert("Payment confirmed successfully");
                            window.location.reload();
                        } else {
                            alert("Payment failed, please try again");
                            $('#payNow').removeAttr('disabled').html('Pay Now');
                        }
                    })
                },
                onClose: function () {
                    $('#payNow').removeAttr('disabled').html('Pay Now');
                }
            });
            // Payment Request Just Fired
            handler.openIframe();
        })
    })
</script>
@endscript
