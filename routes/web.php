<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PackagesController;
use App\Http\Controllers\Dashboard\DepositController;
use App\Http\Controllers\Dashboard\WithdrawalController;
use App\Http\Controllers\Dashboard\InternalTransferController;
use App\Http\Controllers\Dashboard\HistoryController;
use App\Http\Controllers\Dashboard\DialyChallengeController;
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

Route::prefix('packages')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'index'])->name('dashboard.packages');
});

Route::prefix('deposit')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [DepositController::class, 'index'])->name('dashboard.deposit');
});

Route::prefix('withdrawal')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [WithdrawalController::class, 'index'])->name('dashboard.withdrawal');
});

Route::prefix('internaltransfer')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [InternalTransferController::class, 'index'])->name('dashboard.internaltransfer');
});

Route::prefix('transaction-history')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [HistoryController::class, 'transaction'])->name('dashboard.history.transaction');
});

Route::prefix('deposit-request')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [HistoryController::class, 'deposit'])->name('dashboard.deposit.request');
});

Route::prefix('withdrawal-request')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [HistoryController::class, 'withdrawal'])->name('dashboard.withdrawal.request');
});

Route::prefix('admin-package')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'package'])->name('admin.package');
});

Route::prefix('admin-package-add')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'packageAdd'])->name('admin.package.add');
});

Route::prefix('admin-dialy')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [DialyChallengeController::class, 'index'])->name('admin.dialy');
    Route::get('/form', [DialyChallengeController::class, 'form'])->name('admin.dialy.form');
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
