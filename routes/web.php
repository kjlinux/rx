<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('connexion');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/update_holiday', [DashboardController::class, 'updateHoliday'])->name('update.holiday');
    Route::get('/check_holiday', [DashboardController::class, 'checkHoliday'])->name('check.holiday');
    Route::post('/calculate_recipe', [DashboardController::class, 'calculateRecipe'])->name('calculate.recipe');

    require __DIR__ . '/auth.php';
    require __DIR__ . '/patient.php';
    require __DIR__ . '/prescriber.php';
    require __DIR__ . '/voucher.php';
    require __DIR__ . '/insight.php';
});
