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
Route::get('/cron', [CronJobController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // list data
    Route::post('/request-list', [DashboardController::class, 'requestList'])->name('request.list');
    Route::post('/deposit-list', [HistoryController::class, 'depositList'])->name('deposit.list');
    Route::post('/withdrawal-list', [HistoryController::class, 'withdrawalList'])->name('withdrawal.list');
    Route::post('/transaction-list', [HistoryController::class, 'trxHistory'])->name('transaction.list');
    Route::post('/internaltrf-list', [HistoryController::class, 'internaltrf'])->name('internaltrf.list');
    Route::post('/dialy-unapp-list', [HistoryController::class, 'blessingUnapp'])->name('dialy.unapp.list');
    Route::post('/admin-users-list', [HistoryController::class, 'users'])->name('admin.users.list');
    Route::post('/admin-package-list', [PackageController::class, 'packageList'])->name('admin.package.list');
    Route::post('/admin-daily-list', [DailyController::class, 'index'])->name('admin.daily.list');
    Route::post('/admin-daily-list-bles', [DailyController::class, 'blessing'])->name('admin.daily.listbles');
    // my package
    Route::get('/product-list/{id}', [PackageController::class, 'index'])->name('product.list');
    Route::get('/product-list', [PackageController::class, 'index'])->name('product.list');
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

    // package percentage
    Route::get('/admin-package-percentage/{id}', [PackageController::class, 'getPercentage'])->name('admin.package.percentage.list');
    Route::post('/admin-package-percentage-process', [PackageController::class, 'percentageProcess'])->name('admin.package.percentage.process');
    Route::delete('/admin-package-percentage-delete', [PackageController::class, 'percentageDelete'])->name('admin.package.percentage.delete');
    Route::get('/admin-package-percentage-edit', [PackageController::class, 'percentageEdit'])->name('admin.package.percentage.edit');

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

    // daily blessing
    Route::post('/internal-admin-process', [DailyController::class, 'dailyBlessing'])->name('daily.blessing.process');
});
