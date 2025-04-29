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
    public $asPayInstallment;

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
                    <h3 class="card-title"><strong>Payment Receipt(s)</strong></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <!--
                        <tr>
                            <th class="text-left">Application Form</th>
                            <td class="text-right"><a href="#" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                        </tr>
                        -->
                        <tr>
                            <th class="text-left">Application Form Receipt</th>
                            <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt',$this->student->application_fee_transaction_id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                        </tr>
                        <tr>
                            <th class="text-left">Acceptance Payment Receipt</th>
                            <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt', $this->student->acceptance_fee_transaction_id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                        </tr>
                        @if($this->asPaySchoolFee || $this->asPayInstallment)
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
                                <th>{{ $fee['label'] }} Reciept</th>
                                <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt',$check->id) }}" class="btn btn-primary">Download {{ $fee['label'] }} Reciept</a></td>
                            </tr>
                            @php
                                }
                                    }
                                    }
                            @endphp
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

