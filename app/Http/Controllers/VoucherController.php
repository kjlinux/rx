<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VoucherController extends Controller
{
    //
    static function generateVoucher(array $data)
    {
        $pdf = Pdf::loadView('voucher', compact('data'));
        $pdf->setPaper('a4', 'portrait');
        $filename =  $data['slug'].'.pdf';
        $pdf->save(storage_path('app/public/' . $filename));

        return response()->json(['pdf_url' => asset('v/' . $filename), 'voucher_id' => $data['slug']]);
        // return $pdf->stream('voucher.pdf');
    }

    public function deleteVoucherAfterStream(Request $request)
    {
        $filePath = storage_path('app/public/'.$request->voucher.'.pdf');

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return response()->json();
    }
}
