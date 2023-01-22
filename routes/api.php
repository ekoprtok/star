<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CronJobController;
use App\Http\Controllers\API\DepositController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\DailyController;

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
    Route::post('/request-list', [HistoryController::class, 'requestList'])->name('request.list');
    Route::post('/deposit-list', [HistoryController::class, 'depositList'])->name('deposit.list');
    Route::post('/withdrawal-list', [HistoryController::class, 'withdrawalList'])->name('withdrawal.list');
    Route::post('/transaction-list', [HistoryController::class, 'trxHistory'])->name('transaction.list');
    Route::post('/internaltrf-list', [HistoryController::class, 'internaltrf'])->name('internaltrf.list');
    Route::post('/dialy-unapp-list', [HistoryController::class, 'blessingUnapp'])->name('dialy.unapp.list');
    Route::post('/admin-users-list', [HistoryController::class, 'users'])->name('admin.users.list');
    Route::post('/admin-package-list', [PackageController::class, 'packageList'])->name('admin.package.list');
    Route::post('/admin-daily-list', [DailyController::class, 'index'])->name('admin.daily.list');
    Route::post('/admin-daily-list-bles', [DailyController::class, 'blessing'])->name('admin.daily.listbles');
    Route::get('/product-list', [PackageController::class, 'index'])->name('product.list');
    Route::get('/product-list', [PackageController::class, 'index'])->name('product.list');
    Route::post('/logout', [AuthController::class, 'logout']);

    // form process
    Route::get('/admin-daily-process/{id}', [DailyController::class, 'formCrud'])->name('admin.daily.process');
    Route::get('/admin-daily-edit/{id}', [DailyController::class, 'getEdit'])->name('admin.daily.edit');
    Route::post('/admin-daily-process', [DailyController::class, 'formCrud'])->name('admin.daily.process');
});
