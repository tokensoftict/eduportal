<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use PDF;
class HomeController extends Controller
{

    public function index()
    {
        return view('frontpage.index');
    }

    public function about()
    {
        return view('frontpage.about');
    }

    public function contact()
    {
        return view('frontpage.contact');
    }

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

}
