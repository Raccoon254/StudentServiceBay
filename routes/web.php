<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('welcome'); });
Route::get('/two-factor', [ProfileController::class, 'twoFactorForm'])->name('two-factor.form');
Route::post('/two-factor', [ProfileController::class, 'twoFactorVerify'])->name('two-factor.verify');

Route::middleware(['auth', 'verified', 'two_factor_auth'])->group(function () {
    //scam.index
    Route::get('/scam', [ScamController::class, 'index'])->name('scam.index');

    Route::get('/dashboard', [ProfileController::class, 'dash'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
