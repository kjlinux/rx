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
});