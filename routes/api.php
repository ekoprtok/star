<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CronJobController;
use App\Http\Controllers\API\DepositController;
use App\Http\Controllers\API\WithdrawController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\DailyController;
use App\Http\Controllers\API\InternalTransferController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\RankController;
use App\Http\Controllers\API\SocialEventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/testimoni', [DashboardController::class, 'testimoni'])->name('landing.testimoni');
Route::post('/tree-list', [DashboardController::class, 'tree'])->name('request.tree');
Route::post('/admin-tree-list', [DashboardController::class, 'adminTree'])->name('request.admin.tree');
Route::post('/check-username', [DashboardController::class, 'checkUsername'])->name('check.username');

Route::prefix('cron')->group(function () {
    Route::get('/loop-trx-rank', [CronJobController::class, 'loopTrxRank'])->name('cron.loop.trx.rank');
    Route::get('/loop-end-donation', [CronJobController::class, 'endOfDonation'])->name('cron.loop.end.donation');
    Route::get('/loop-kindnes-down', [CronJobController::class, 'kindnesMeterDownline'])->name('cron.loop.kindnes.down');
    Route::get('/loop-rate-dif', [CronJobController::class, 'rateDiff'])->name('cron.loop.rate.diff');
});

Route::get('/cron', [CronJobController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // list data
    Route::post('/request-list', [DashboardController::class, 'requestList'])->name('request.list');
    Route::post('/deposit-list', [HistoryController::class, 'depositList'])->name('deposit.list');
    Route::post('/withdrawal-list', [HistoryController::class, 'withdrawalList'])->name('withdrawal.list');
    Route::post('/transaction-list', [HistoryController::class, 'trxHistory'])->name('transaction.list');
    Route::post('/internaltrf-list', [HistoryController::class, 'internaltrf'])->name('internaltrf.list');
    Route::post('/dialy-unapp-list', [HistoryController::class, 'blessingUnapp'])->name('dialy.unapp.list');
    Route::post('/dashboard-balance', [HistoryController::class, 'balance'])->name('dashboard.balance.list');
    Route::post('/admin-users-list', [HistoryController::class, 'users'])->name('admin.users.list');
    Route::post('/admin-redeem-list', [HistoryController::class, 'redeemList'])->name('admin.redeem.list');
    Route::post('/admin-package-list', [PackageController::class, 'packageList'])->name('admin.package.list');
    Route::post('/admin-daily-list', [DailyController::class, 'index'])->name('admin.daily.list');
    Route::post('/admin-daily-list-bles', [HistoryController::class, 'blessing'])->name('admin.daily.listbles');
    Route::post('/admin-social-event-list', [HistoryController::class, 'socialEventList'])->name('admin.social.event.list');
    Route::get('/daily-list', [DailyController::class, 'dailyChallenge'])->name('daily.list');
    Route::post('/rank-list', [RankController::class, 'index'])->name('admin.rank.list');

    // admin proses redeem
    Route::post('/admin-redeem-process', [PackageController::class, 'adminProcessRedeem'])->name('admin.redeem.process');

    // my package
    Route::get('/product-list/{id}', [PackageController::class, 'index'])->name('product.list');
    Route::get('/product-list', [PackageController::class, 'index'])->name('product.list');
    Route::get('/product-redeem-info', [PackageController::class, 'redeemInfo'])->name('product.redeem.info');
    Route::post('/product-redeem-process', [PackageController::class, 'redeemProcess'])->name('product.redeem.process');

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // form process
    // daily challenge
    Route::get('/admin-daily-edit/{id}', [DailyController::class, 'getEdit'])->name('admin.daily.edit');
    Route::post('/admin-daily-process', [DailyController::class, 'formCrud'])->name('admin.daily.process');
    Route::delete('/admin-daily-delete', [DailyController::class, 'dailyDelete'])->name('admin.daily.delete');

    // package
    Route::post('/admin-package-process', [PackageController::class, 'formCrud'])->name('admin.package.process');
    Route::get('/admin-package-edit/{id}', [PackageController::class, 'getEdit'])->name('admin.package.edit');
    Route::delete('/admin-package-delete', [PackageController::class, 'packageDelete'])->name('admin.package.delete');
    Route::post('/admin-package-gift-process', [PackageController::class, 'formGift'])->name('admin.package.gift.process');

    // dashboard
    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // user
    Route::post('/package-buy', [PackageController::class, 'packageBuy'])->name('package.buy');

    // deposit
    Route::post('/deposit-process', [DepositController::class, 'process'])->name('deposit.process');
    Route::post('/deposit-upload-image', [DepositController::class, 'uploadImage'])->name('deposit.uploadImage');
    Route::post('/deposit-admin-process', [DepositController::class, 'adminProcess'])->name('admin.deposit.process');

    // withdraw
    Route::post('/withdraw-process', [WithdrawController::class, 'process'])->name('withdraw.process');
    Route::post('/withdraw-admin-process', [WithdrawController::class, 'adminProcess'])->name('admin.withdraw.process');

    // internal transfer
    Route::post('/internal-process', [InternalTransferController::class, 'process'])->name('internal.process');
    Route::post('/internal-admin-process', [InternalTransferController::class, 'adminProcess'])->name('admin.internal.process');

    // daily
    Route::post('/claim-daily-blessing', [DailyController::class, 'dailyBlessing'])->name('daily.blessing.process');
    Route::post('/claim-daily-challenge-process', [DailyController::class, 'dailyChClaim'])->name('daily.challange.process');
    Route::post('/admin-daily-challenge-process', [DailyController::class, 'adminProcess'])->name('admin.daily.challange.process');

    // profile
    Route::post('/change-password-process', [ProfileController::class, 'changePassword'])->name('change.password.process');
    Route::post('/wallet-address-process', [ProfileController::class, 'walletAddressForm'])->name('wallet.address.process');
    Route::get('/wallet-address-get', [ProfileController::class, 'walletAddressGet'])->name('wallet.address.get');
    Route::get('/2fa-request', [ProfileController::class, 'authenticatorRequest'])->name('2fa.request');
    Route::get('/2fa-check', [ProfileController::class, 'authenticatorCheck'])->name('2fa.check');
    Route::get('/2fa-deactivate', [ProfileController::class, 'authenticatorUnactive'])->name('2fa.deactivate');

    // rank
    Route::delete('/rank-delete', [RankController::class, 'rankDelete'])->name('admin.rank.delete');
    Route::post('/rank-process', [RankController::class, 'rankProcess'])->name('admin.rank.process');
    Route::get('/rank-edit/{id}', [RankController::class, 'rankEdit'])->name('admin.rank.edit');

    // social event
    Route::post('/social-event-process', [SocialEventController::class, 'process'])->name('social.event.process');
    Route::post('/admin-social-event-process', [SocialEventController::class, 'processAdmin'])->name('admin.social.event.process');
    Route::post('/social-event-upload-image', [SocialEventController::class, 'uploadImage'])->name('social.event.uploadImage');
});
