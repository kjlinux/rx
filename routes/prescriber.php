<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriberController;

Route::prefix('prescriber')->group(function (){
    Route::get('/new_prescriber', [PrescriberController::class, 'new_prescriber'])->name('prescriber.new');
    Route::get('/update_prescriber', [PrescriberController::class, 'update_prescriber'])->name('prescriber.update');
    Route::get('/payed_prescriber', [PrescriberController::class, 'payed_prescriber'])->name('prescriber.payed');
});