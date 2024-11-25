<?php

namespace App\Livewire\Student;

use App\Classes\PaystackRepository;
use App\Classes\Settings;
use App\Mail\StudentAdmissionEmail;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class WaitingForApplication extends Component
{

    public $paymentData = [];
    public string $charges = "300";

    public function mount()
    {
        $this->paymentData = app(Settings::class)->all();
        $this->charges = PaystackRepository::calculateCharges($this->paymentData['acceptance_fee']);
    }

    public function generateTransaction()
    {
        $transaction = Transaction::create([
            'transactionId' => md5(time()."-".mt_rand(10000000, 1000000000000)),
            'transactionable_type' => Student::class,
            'transactionable_id' => auth('student')->id(),
            'date'=> date("Y-m-d"),
            'amount' => $this->charges + $this->paymentData["acceptance_fee"],
            'currency' => "NGN",
            "country" =>"Nigeria",
            "email" => auth('student')->user()->email,
            "phoneNumber" => auth('student')->user()->phone,
            "name" => auth('student')->user()->name,
            "session" => "2024-2025",
            "semester" => "First",
            "gateway" => "PAYSTACK",
            "paymentable_type" => "Acceptance fee",
            "paymentable_id" => NULL
        ]);

        return $transaction->toArray();
    }

    public function confirmPayment($transactionId)
    {
        $confirm = PaystackRepository::validatePayStackPayment($transactionId, $this->paymentData['private_key']);
        if($confirm["status"] == true) {
            $txn = Transaction::where('transactionId', $transactionId)->first();
            $txn->status = 4;
            $txn->save();
            $student = auth('student')->user();
            $student->status = 4;
            $student->acceptance_fee_transaction_id = $txn->id;
            $student->save();


            $student = auth('student')->user();
            $password  = Settings::generatePassword(trim(str_replace(' ','', $student->name)));
            $application_number = Settings::generationNumber($student->id);

            $user = new User();
            $user->name = $student->name;
            $user->email = $student->email;
            $user->student_id = $student->id;
            $user->application_number = $application_number;
            $user->email_verified_at = now();
            $user->password = $password;

            $data = [
                'title' => 'Your Portal Login Details',
                'body' => 'Dear <strong>'.$user->name.'</strong>,'.
                    '<p>We are thrilled to welcome you to '.app(Settings::class)->get('name').'! Your admission process is now complete, and you can access your student portal to manage your academic journey.</p> <p>Below are your login details:</p><br/>'.
                    '<ul><li><strong>Portal URL:</strong> '.route('index').'</li><li><strong>Application Number:</strong> '. $application_number .'</li><li><strong>Password:</strong> '. $password .'</li></ul>'.
                    '<p>To access the portal:</p> <ol> <li>Visit the portal using the provided URL.</li> <li>Log in with your username and temporary password.</li> <li>Change your password immediately to ensure the security of your account.</li> </ol> <p>If you encounter any issues while logging in or have questions, please contact our support team.<br/><br/>'.
                    'Warm regards,'
            ];

            $user->save();
            Mail::to($user->email)->send(new StudentAdmissionEmail($data));

            return "success";
        }

        return "failed";
    }

    public function render()
    {
        return view('livewire.student.waiting-for-application');
    }
}
