<?php

namespace App\Http\Controllers\Student;

use App\Classes\Settings;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Transaction;
use PDF;
class DownloadController extends Controller
{

    /**
     * @param Transaction $transaction
     * @return mixed
     */
    public function downloadApplicationReceipt(Transaction $transaction)
    {
        ini_set('memory_limit','48M');

        $pdf = PDF::loadView("pdfs.payment",['payment' => $transaction]);
        $pdf->getMpdf()->SetWatermarkText(strtoupper("Paid"));
        $pdf->getMpdf()->showWatermarkText = true;

        return $pdf->stream('payment.pdf');
    }


    /**
     * @param Student $student
     * @return mixed
     */
    public function downloadApplicationForm(Student $student)
    {
        ini_set('memory_limit','48M');
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetWatermarkText('DRAFT');
            $mpdf->showWatermarkText = true;
        }];

        $pdf = PDF::loadView("pdfs.app_form",['student' => $student]);


        return $pdf->stream('payment.pdf');
    }
}
