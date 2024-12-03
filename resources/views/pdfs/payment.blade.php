<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Payment Receipt</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-size: 9pt;
            background-color: #fff;
        }

        #products {
            width: 90%;
        }
        #products th, #products td {
            padding-top:5px;
            padding-bottom:5px;

        }
        #products tr td {
            font-size: 8pt;
        }

        #printbox {
            width: 98%;
            margin: 5pt;
            padding: 5px;
            margin: 0px auto;
            text-align: justify;
        }

        .inv_info tr td {
            padding-right: 10pt;
        }

        .product_row {
            margin: 15pt;
        }

        .stamp {
            margin: 5pt;
            padding: 3pt;
            border: 3pt solid #111;
            text-align: center;
            font-size: 20pt;
            color:#000;
        }

        .text-center {
            text-align: center;
        }

        @page {
            footer: page-footer;
        }
    </style>
</head>
<body>

<div id="printbox">
    <table width="80%" align="center">
        <tr>
            <td width="100%" valign="top" align="center">
                <p>&nbsp;</p>
                <h1 align="center" style="text-align: center;margin-top: 40px" >{{ app(\App\Classes\Settings::class)->get('name') }}</h1>
                <h2 align="center" style="text-align: center;margin-top: 10px;">SESSION : {{ $payment->session }}</h2>
                <h2 align="center" style="text-align: center;margin-top: 10px; color: red">PAYMENT RECEIPT</h2>
            </td>
        </tr>
    </table>

    <br/>

    <table width="80%" align="center"  id="products" border="1">
        <tr>
            <td><b>NAME</b></td><th>{{ $payment->name }}</th>
        </tr>
        <tr>
            <td><b>PAYMENT FOR</b></td><th>
                @if(is_null($payment->paymentable_id))
                    {{ strtoupper($payment->paymentable_type) }}
                @else
                    @php
                        $paymentt = \App\Models\Fee::find($payment->paymentable_id)->name
                    @endphp
                    {{ strtoupper($paymentt) }}
                @endif
            </th>
        </tr>
        <tr>
            <td><b>DATE</b></td><th>{{ $payment->created_at }}</th>
        </tr>
        <tr>
            <td><b>AMOUNT</b></td><th>{{ number_format($payment->amount,2) }}</th>
        </tr>
        <tr>
            <td><b>PHONE NUMBER</b></td><th>{{ $payment->phoneNumber }}</th>
        </tr>
        <tr>
            <td><b>EMAIL ADDRESS</b></td><th>{{ $payment->email }}</th>
        </tr>
    </table>
</div>
<htmlpagefooter name="page-footer">
    <table width="100%"><tr><td style="font-size: 18px; padding-bottom: 20px;" align="right">Powered by Zenith Academy</td></tr></table>
</htmlpagefooter>
</body>
</html>
