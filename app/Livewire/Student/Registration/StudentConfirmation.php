<?php

namespace App\Livewire\Student\Registration;


use App\Classes\PaystackRepository;
use App\Classes\Settings;
use App\Mail\StudentAdmissionEmail;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentConfirmation extends StepComponent
{
    public $paymentData = [];
    public string $charges = "300";

    public function mount()
    {
        $this->paymentData = app(Settings::class)->all();
        $this->charges = PaystackRepository::calculateCharges($this->paymentData['application_fee']);
    }
    public function render()
    {
        return view('livewire.student.registration.student-confirmation');
    }


    public function generateTransaction()
    {
        $transaction = Transaction::create([
            'transactionId' => md5(time()."-".mt_rand(10000000, 1000000000000)),
            'transactionable_type' => Student::class,
            'transactionable_id' => auth('student')->id(),
            'date'=> date("Y-m-d"),
            'amount' => $this->charges + $this->paymentData["application_fee"],
            'currency' => "NGN",
            "country" =>"Nigeria",
            "email" => auth('student')->user()->email,
            "phoneNumber" => auth('student')->user()->phone,
            "name" => auth('student')->user()->name,
            "session" => "2024-2025",
            "semester" => "First",
            "gateway" => "PAYSTACK",
            "paymentable_type" => "Application fee",
            "paymentable_id" => NULL
        ]);

        return $transaction->toArray();
    }


    public function confirmPayment($transactionId)
    {
        $confirm = PaystackRepository::validatePayStackPayment($transactionId, $this->paymentData['private_key']);
        if($confirm["status"] === true) {
            $txn = Transaction::where('transactionId', $transactionId)->first();
            $txn->status = 1;
            $txn->save();
            $user = auth('student')->user();
            $user->status = true;
            $user->application_fee_transaction_id = $txn->id;
            $user->save();


            return "success";
        }

        return "failed";
    }


    public function back()
    {
        $this->previousStep();
    }
}
