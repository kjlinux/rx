<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VoucherController extends Controller
{
    //
    static function generateVoucher(array $data){
        $pdf = Pdf::loadView('voucher', $data);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('voucher.pdf');
    }
}
