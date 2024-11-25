<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
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

        return $pdf->stream('payment.pdf');
    }
}
