<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriberController;

Route::prefix('prescriber')->group(function (){
    Route::get('/new_prescriber', [PrescriberController::class, 'new_prescriber'])->name('prescriber.new');
    Route::get('/update_prescriber', [PrescriberController::class, 'update_prescriber'])->name('prescriber.update');
    Route::get('/payed_prescriber', [PrescriberController::class, 'payed_prescriber'])->name('prescriber.payed');
    Route::post('/record_prescriber', [PrescriberController::class, 'recordPrescriber'])->name('prescriber.record');
    Route::post('/register', [PrescriberController::class, 'displayRegister'])->name('prescriber.register');
    Route::post('/informations', [PrescriberController::class, 'displayPrescriberInformations'])->name('prescriber.informations');
    Route::post('/update_prescriber_record', [PrescriberController::class, 'updatePrescriberRecord'])->name('prescriber.update.record');
    Route::get('/refresh_datatable', [PrescriberController::class, 'dataTableRefresh'])->name('prescriber.refresh');
    Route::post('/delete_prescriber', [PrescriberController::class, 'deletePrescriber'])->name('prescriber.delete');
    Route::get('/refresh_datatable_payment', [PrescriberController::class, 'dataTableRefreshPayment'])->name('prescriber.refresh.payment');
    Route::post('/confirm_prescriber_payment', [PrescriberController::class, 'confirmPrescriberPayment'])->name('prescriber.confirm.payment');
});