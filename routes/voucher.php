<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;

Route::prefix('voucher')->group(function () {
    //Do not touch the next line, i don't know how i used it but printer works.
    Route::get('/v', [VoucherController::class, 'generateVoucher'])->name('voucher.generate');
    Route::post('/vs', [VoucherController::class, 'generateVoucherStream'])->name('voucher.generate.stream');
    Route::post('/delete_pdf', [VoucherController::class, 'deleteVoucherAfterStream'])->name('voucher.delete');
    Route::post('/delete_pdf_stream', [VoucherController::class, 'deleteVoucherAfterStreamWithoutRegistering'])->name('voucher.delete.stream');
});
