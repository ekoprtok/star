<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PackagesController;
use App\Http\Controllers\Dashboard\DepositController;
use App\Http\Controllers\Dashboard\WithdrawalController;
use App\Http\Controllers\Dashboard\InternalTransferController;
use App\Http\Controllers\Dashboard\HistoryController;
use App\Http\Controllers\Dashboard\DailyChallengeController;
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

Route::get('/', function () {
    return redirect(route('login'));
})->name('landing');

Route::get('/help', [LandingController::class, 'help'])->name('landing.help');
Route::get('/contact', [LandingController::class, 'contact'])->name('landing.contact');
Route::get('/news', [LandingController::class, 'news'])->name('landing.news');

Auth::routes(['verify' => true]);

Route::prefix('dashboard')->middleware(['auth','verified'])->group(function () {
    Route::get('/landing', [LandingController::class, 'index'])->name('landing.backup');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/about', [LandingController::class, 'about'])->name('landing.about');
});

Route::prefix('packages')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'index'])->name('dashboard.packages');
});

Route::prefix('my-packages')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'my'])->name('dashboard.mypackages');
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

Route::prefix('internal-trf')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [HistoryController::class, 'internalTrf'])->name('dashboard.internaltrf');
});

Route::prefix('withdrawal-request')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [HistoryController::class, 'withdrawal'])->name('dashboard.withdrawal.request');
});

Route::prefix('dialy-request')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [HistoryController::class, 'dialyUnapp'])->name('dashboard.dialy.request');
});

Route::prefix('admin-package')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'package'])->name('admin.package');
});

Route::prefix('admin-package-form')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [PackagesController::class, 'packageForm'])->name('admin.package.form');
    Route::get('/percentage/{id}', [PackagesController::class, 'percentageForm'])->name('admin.package.percentage.form');
});

Route::prefix('admin-daily')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [DailyChallengeController::class, 'index'])->name('admin.daily');
    Route::get('/form', [DailyChallengeController::class, 'form'])->name('admin.daily.form');
});

Route::prefix('admin-blessing')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [DailyChallengeController::class, 'blessing'])->name('admin.daily.blessing');
    Route::get('/form', [DailyChallengeController::class, 'form_blessing'])->name('admin.daily.blessing.form');
});

Route::prefix('admin-users')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'users'])->name('dashboard.users');
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
