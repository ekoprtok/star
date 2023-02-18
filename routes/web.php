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
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RankController;
use App\Http\Controllers\Dashboard\SocialEventController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return redirect(route('login'));
// })->name('landing');

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/help', [LandingController::class, 'help'])->name('landing.help');
Route::get('/contact', [LandingController::class, 'contact'])->name('landing.contact');
Route::get('/news', [LandingController::class, 'news'])->name('landing.news');
Route::get('/about', [LandingController::class, 'about'])->name('landing.about');

Auth::routes(['verify' => true]);

Route::prefix('dashboard')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('admin-tree')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DashboardController::class, 'adminTree'])->name('dashboard.tree.admin');
});

Route::prefix('detail-user')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/{id}', [DashboardController::class, 'detailUser'])->name('dashboard.admin.detail.user');
});

Route::prefix('balance')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DashboardController::class, 'balance'])->name('dashboard.balance');
});

Route::prefix('team-tree')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DashboardController::class, 'tree'])->name('dashboard.team.tree');
});

Route::prefix('packages')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [PackagesController::class, 'index'])->name('dashboard.packages');
});

Route::prefix('change-password')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [ProfileController::class, 'changePassword'])->name('dashboard.change.password');
});

Route::prefix('wallet-address')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [ProfileController::class, 'wallet'])->name('dashboard.wallet.address');
});

Route::prefix('authenticator')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [ProfileController::class, 'authenticator'])->name('dashboard.authenticator');
});

Route::prefix('otp')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [ProfileController::class, 'otp'])->name('dashboard.otp');
});

Route::prefix('my-packages')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [PackagesController::class, 'my'])->name('dashboard.mypackages');
});

Route::prefix('deposit')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DepositController::class, 'index'])->name('dashboard.deposit');
});

Route::prefix('withdrawal')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [WithdrawalController::class, 'index'])->name('dashboard.withdrawal');
});

Route::prefix('internaltransfer')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [InternalTransferController::class, 'index'])->name('dashboard.internaltransfer');
});

Route::prefix('transaction-history')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'transaction'])->name('dashboard.history.transaction');
});

Route::prefix('deposit-request')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'deposit'])->name('dashboard.deposit.request');
});

Route::prefix('internal-trf')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'internalTrf'])->name('dashboard.internaltrf');
});

Route::prefix('withdrawal-request')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'withdrawal'])->name('dashboard.withdrawal.request');
});

Route::prefix('social-event-request')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'socialEvent'])->name('dashboard.social.event.request');
});

Route::prefix('dialy-request')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'dialyUnapp'])->name('dashboard.dialy.request');
});

Route::prefix('dialy-blessing')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'dialyBlessing'])->name('dashboard.dialy.blessing');
});

Route::prefix('redeem-list')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [HistoryController::class, 'redeemList'])->name('dashboard.package.redeem');
});

Route::prefix('social-event')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [SocialEventController::class, 'index'])->name('dashboard.social.event');
});

Route::prefix('admin-package')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [PackagesController::class, 'package'])->name('admin.package');
    Route::get('/form', [PackagesController::class, 'packageForm'])->name('admin.package.form');
});

Route::prefix('admin-daily')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DailyChallengeController::class, 'index'])->name('admin.daily');
    Route::get('/form', [DailyChallengeController::class, 'form'])->name('admin.daily.form');
});

Route::prefix('admin-blessing')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DailyChallengeController::class, 'blessing'])->name('admin.daily.blessing');
    Route::get('/form', [DailyChallengeController::class, 'form_blessing'])->name('admin.daily.blessing.form');
});

Route::prefix('admin-users')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [DashboardController::class, 'users'])->name('dashboard.users');
});

Route::prefix('admin-rank')->middleware(['auth','verified','checkLogin'])->group(function () {
    Route::get('/', [RankController::class, 'index'])->name('admin.rank');
    Route::get('/form', [RankController::class, 'form'])->name('admin.rank.form');
});

Route::get('/activity', [ActivityController::class, 'index'])->name('dashboard.activity');

// mailing
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
