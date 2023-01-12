<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/help', [LandingController::class, 'help'])->name('landing.help');
Route::get('/contact', [LandingController::class, 'contact'])->name('landing.contact');
Route::get('/news', [LandingController::class, 'news'])->name('landing.news');

Auth::routes(['verify' => true]);

Route::prefix('dashboard')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::prefix('deposit')->middleware('auth')->group(function () {
//     Route::get('/', [DepositController::class, 'index'])->name('dashboard.deposit');
//     Route::get('/form', [DepositController::class, 'form'])->name('dashboard.deposit.form');
// });

Route::get('/activity', [ActivityController::class, 'index'])->name('dashboard.activity');

// mailing
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
