<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::prefix('patient')->group(function (){
    Route::get('/new_patient', [PatientController::class, 'newPatient'])->name('patient.new');
    Route::get('/update_patient', [PatientController::class, 'updatePatient'])->name('patient.update');
    Route::get('/payed_patient', [PatientController::class, 'payedPatient'])->name('patient.payed');
    Route::post('/record_examination', [PatientController::class, 'recordExamination'])->name('patient.record');
    Route::post('/price_calculator', [PatientController::class, 'priceCalculator'])->name('patient.price.calculator');
    Route::post('/register', [PatientController::class, 'displayRegister'])->name('patient.register');
    Route::post('/informations', [PatientController::class, 'displayPatientInformations'])->name('patient.informations');
    Route::post('/update_patient_record', [PatientController::class, 'updatePatientRecord'])->name('patient.update.record');
    Route::get('/refresh_datatable', [PatientController::class, 'dataTableRefresh'])->name('patient.refresh');
    Route::post('/delete_patient', [PatientController::class, 'deletePatient'])->name('patient.delete');
    Route::get('/refresh_datatable_payment', [PatientController::class, 'dataTableRefreshPayment'])->name('patient.refresh.payment');
    Route::post('/confirm_patient_payment', [PatientController::class, 'confirmPatientPayment'])->name('patient.confirm.payment');
});