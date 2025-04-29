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
    public $campus;
    public array $paymentData = [];
    public  $asPaySchoolFee;
    public $asPayInstallment;
    public array $installments = [];
    public string $paymentOption = "full";

    public function mount()
    {
        $this->user = auth()->user();
        $this->student = Student::find($this->user->student_id);
        $this->campus = $this->student->campus;
        if(is_null($this->student->fees_log)) {
            //generate fees log
            if(is_null($this->student->campus_id)) {
                $this->student->campus_id = 1;
                $this->student->save();
                $this->student->fresh();
            }

            $campus = $this->student->campus;
            $schoolFees = $campus->fees;
            $installments = $campus->noOfInstalments;
            $paymentLogs = [];
            for($i =1; $i <= $installments; $i++) {
                $paymentLogs[] = [
                    'payment_id' => $i,
                    'label' => $this->ordinal($i)."'s installment",
                    'amount' =>  ($schoolFees / $installments),
                    'status' => false
                ];
            }

            $paymentLogs[] = [
                'payment_id' => $i,
                'label' => "Full Payment",
                'amount' => $schoolFees,
                'status' => false
            ];

            $this->student->fees_log = json_encode($paymentLogs);
            $this->student->save();
            $this->student->fresh();
        }

        $fees = json_decode($this->student->fees_log, true);
        $totalPay = 0;
        foreach ($fees as $fee) {
            if($fee['status']) {
                $totalPay+=$fee['amount'];
            }
        }

        if($totalPay == $this->student->campus->fees) {
            $this->asPaySchoolFee = true;
            $this->asPayInstallment = false;
        } else if($totalPay > 0) {
            $this->asPayInstallment = true;
            $this->asPaySchoolFee = false;
            foreach ($fees as $fee) {
                if($fee['label'] == "Full Payment") continue;
                $check = Transaction::where('paymentable_type',\App\Models\Fee::class)
                    ->where("paymentable_id",  \App\Models\Fee::find(1)->id)
                    ->where('transactionable_type', User::class)
                    ->where('transactionable_id', auth()->id())
                    ->where("status", 4)
                    ->where('session', app(\App\Classes\Settings::class)->get("session"))
                    ->where('transaction_reference', $fee['payment_id'])
                    ->first();
                if(!$check) {
                    $settings = app(Settings::class)->all();
                    $this->paymentData = array_merge([
                        "transaction_reference" => $fee['payment_id'],
                        "amount" => $fee['amount'],
                        "id" =>  \App\Models\Fee::find(1)->id,
                        "description" => $fee['label'],
                    ], $settings);
                    break;
                }
            }
        } else {
            $this->asPayInstallment = false;
            $this->asPaySchoolFee = false;
        }

    }


    public function savePaymentOption()
    {
        $fees = json_decode($this->student->fees_log, true);
        $this->paymentData = [];
        if($this->paymentOption == "full") {
            foreach ($fees as $fee) {
                if($fee['label'] == "Full Payment") {
                    $settings = app(Settings::class)->all();
                    $this->paymentData = array_merge([
                        "transaction_reference" => $fee['payment_id'],
                        "amount" => $fee['amount'],
                        "id" =>  \App\Models\Fee::find(1)->id,
                        "description" => $fee['label']
                    ], $settings);
                    break;
                }
            }
        } else {
            foreach ($fees as $fee) {
                if($fee['label'] == "Full Payment") continue;
                $check = Transaction::where('paymentable_type',\App\Models\Fee::class)
                    ->where("paymentable_id",  \App\Models\Fee::find(1)->id)
                    ->where('transactionable_type', User::class)
                    ->where('transactionable_id', auth()->id())
                    ->where("status", 4)
                    ->where('session', app(\App\Classes\Settings::class)->get("session"))
                    ->where('transaction_reference', $fee['payment_id'])
                    ->first();
                if(!$check) {
                    $settings = app(Settings::class)->all();
                    $this->paymentData = array_merge([
                        "transaction_reference" => $fee['payment_id'],
                        "amount" => $fee['amount'],
                        "id" =>  \App\Models\Fee::find(1)->id,
                        "description" => $fee['label'],
                    ], $settings);
                    break;
                }
            }
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
            'transaction_reference' => $this->paymentData['transaction_reference'],
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

            $fees = json_decode($this->student->fees_log, true);
            foreach ($fees as $key => $fee) {
                if($fee['payment_id'] ==  $txn->transaction_reference){
                    $fees[$key]['status'] = true;
                }
            }
            $this->student->fees_log = json_encode($fees);
            $this->student->save();
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
                    <h3 class="card-title">School Fees Payment</h3>
                </div>
                @if($this->asPaySchoolFee)
                    <div class="card-body">
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
                            @php
                                $fees = json_decode($this->student->fees_log, true);
                                foreach ($fees as $key => $fee) {
                                    if($fee['status'] == true) {
                                         $check = Transaction::where('paymentable_type',\App\Models\Fee::class)
                                    ->where("paymentable_id",  \App\Models\Fee::find(1)->id)
                                    ->where('transactionable_type', User::class)
                                    ->where('transactionable_id', auth()->id())
                                    ->where("status", 4)
                                    ->where('session', app(\App\Classes\Settings::class)->get("session"))
                                    ->where('transaction_reference', $fee['payment_id'])
                                    ->first();
                                         if($check) {
                            @endphp
                            <tr>
                                <th colspan="2"><a target="_blank" href="{{ route('student.download.application_receipt',$check->id) }}" class="btn btn-success btn-block">Download {{ $fee['label'] }} Reciept</a></th>
                            </tr>
                            @php
                                }
                                    }
                                    }
                            @endphp
                        </table>
                    </div>
                @else
                    @if(count($this->paymentData) == 0 and $this->asPayInstallment == false)
                        <form wire:submit="savePaymentOption">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="studentId">Application Number</label>
                                    <input type="text" disabled value="{{ $this->user->application_number }}" class="form-control" id="studentId">
                                </div>

                                <div class="form-group">
                                    <label for="studentName">Student Name</label>
                                    <input type="text"  disabled value="{{ $this->user->name }}" class="form-control" id="studentName" placeholder="Enter Student Name">
                                </div>

                                <!-- Payment Option -->
                                <div class="form-group">
                                    <label>Payment Option</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="fullPayment" wire:model="paymentOption" name="paymentOption" value="full" checked>
                                        <label for="fullPayment" class="custom-control-label">Full Payment</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="installmentPayment" wire:model="paymentOption" name="paymentOption" value="installment">
                                        <label for="installmentPayment" class="custom-control-label">Pay in {{ $this->campus->noOfInstalments }} Installments</label>
                                    </div>
                                </div>

                                <div id="installmentDetails" style="display: none;">
                                    <div class="text-muted">
                                        @foreach(json_decode($this->student->fees_log, 1) as $feeLog)
                                            @if($feeLog['label'] !== "Full Payment" and $feeLog['status'] === false)
                                                <strong> {!!  $feeLog['label'] ." - ₦". number_format($feeLog['amount'])  !!}</strong><br/>
                                            @endif
                                        @endforeach
                                        <br/>
                                    </div>
                                </div>

                                <!-- Fee Summary -->
                                <div class="form-group">
                                    <label for="amountToPay">Amount to Pay</label>
                                    <input type="text" class="form-control" id="amountToPay" readonly value="₦{{ number_format($this->campus->fees, 2) }}">
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block">Proceed to Payment</button>
                            </div>
                        </form>
                    @else
                        <div class="card-body">
                            <form>
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
                                        <th class="text-left">Payment Option</th>
                                        <td class="text-right"><strong>{{ $this->paymentData['description'] }}</strong></td>
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
                                <button  onclick="return makePayment()" type="button" id="payNow" class="btn btn-block btn-success mt-4">Pay
                                    (=N=) {{ number_format(($paymentData['amount']+$charges),2) }} Now
                                </button>
                                <a href="{{ route('portal.school_fees') }}" class="btn btn-block btn-danger">Cancel Payment</a>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>

    </div>
    <script src="https://js.paystack.co/v2/inline.js"></script>
    @if(count($this->paymentData) == 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fullPayment = document.getElementById('fullPayment');
                const installmentPayment = document.getElementById('installmentPayment');
                const installmentDetails = document.getElementById('installmentDetails');
                const amountToPay = document.getElementById('amountToPay');

                function updatePaymentDetails() {
                    if (installmentPayment.checked) {
                        installmentDetails.style.display = 'block';
                        amountToPay.value = "₦{{ number_format(($this->campus->fees/$this->campus->noOfInstalments), 2) }}";
                    } else {
                        installmentDetails.style.display = 'none';
                        amountToPay.value = "₦{{ number_format($this->campus->fees, 2) }}";
                    }
                }

                fullPayment.addEventListener('change', updatePaymentDetails);
                installmentPayment.addEventListener('change', updatePaymentDetails);
            });
        </script>
    @endif
    <script>
        function makePayment(btn) {
            $(btn).attr('disabled', 'disabled').html('Please wait..')
            @this.generateTransaction().then(function (response) {
                var handler = PaystackPop.setup({
                    key: '{{  $settings = app(Settings::class)->all()['public_key'] }}', // This is your public key only!
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
        }
    </script>
</div>

