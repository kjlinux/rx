<?php

use App\Http\Controllers\InsightController;
use Illuminate\Support\Facades\Route;

Route::prefix('insight')->group(function () {
    Route::get('/insights', [InsightController::class, 'insights'])->name('insights');
    Route::post('/insights_drawer', [InsightController::class, 'drawer'])->name('insights.drawer');
});