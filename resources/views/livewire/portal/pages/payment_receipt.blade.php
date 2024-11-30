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

    public function mount()
    {
        $user = auth()->user();
        $this->student = Student::find($user->student_id);
        $this->paymentData = \App\Models\Fee::find(1)->toArray();
        $this->paymentData = array_merge($this->paymentData, app(Settings::class)->all());
        $this->asPaySchoolFee = Transaction::where('paymentable_type',\App\Models\Fee::class)
                ->where("paymentable_id", $this->paymentData['id'])
                ->where('transactionable_type', User::class)
                ->where('transactionable_id', auth()->id())
                ->where("status", 4)
                ->where('session', app(\App\Classes\Settings::class)->get("session"))
                ->first();
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
                            <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt',$student->application_fee_transaction_id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                        </tr>
                        <tr>
                            <th class="text-left">Acceptance Payment Receipt</th>
                            <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt', $student->acceptance_fee_transaction_id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                        </tr>
                        @if($this->asPaySchoolFee)
                            <tr>
                                <th class="text-left">School Fees Receipt</th>
                                <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt', $this->asPaySchoolFee->id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

