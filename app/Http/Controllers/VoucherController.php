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

    static function generateVoucherStream(Request $request)
    {
        $data = array();
        $data['id'] = $request->id;
        $data['date'] = convertToDateString($request->date);
        $data['time'] = $request->time;
        $data['name'] = $request->name;
        $data['forenames'] = $request->forename;
        $data['amount_to_pay'] = is_null($request->after_discount) ?  $request->total_amount : $request->after_discount;
        $data['payed'] = is_null($request->payed_amount) ? 0 : $request->payed_amount;
        $data['left_to_pay'] = is_null($request->payed_amount) ? 0 : $request->left_to_pay;
        $data['amount_to_pay_in_letters'] = capitalizeWords(nummberToLetters($data['amount_to_pay']));
        $data['examination'] = getExaminationsNames($request->examination);
        $data['slug'] = $request->slug;

        $pdf = Pdf::loadView('voucher', compact('data'));
        $pdf->setPaper('a4', 'portrait');
        $filename =  $data['slug'].'.pdf';
        $pdf->save(storage_path('app/public/' . $filename));

        return response()->json(['pdf_url' => asset('v/' . $filename)]);
    }

    public function deleteVoucherAfterStream(Request $request)
    {
        $filePath = storage_path('app/public/'.$request->voucher.'.pdf');

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return response()->json();
    }

    public function deleteVoucherAfterStreamWithoutRegistering(Request $request)
    {
        $filePath = storage_path('app/public/'.$request->slug.'.pdf');

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return response()->json();
    }
}
