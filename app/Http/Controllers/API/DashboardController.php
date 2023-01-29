<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxIntTransfer;
use App\Models\TrxWithdrawal;
use App\Models\TrxDeposit;
use App\Models\User;
use App\Models\TrxDailyChallenge;
use App\Models\TrxPackage;
use App\Models\UserWallet;
use Helper;

class DashboardController extends Controller {

    public function index(Request $request) {
        $id         = ($request->id) ? Helper::decrypt($request->id) : '';
        $userWallet = UserWallet::where('user_id', $id)->first();
        $balance    = ($userWallet) ? Helper::format_harga($userWallet->rbalance_amount) : Helper::format_harga(0);
        return response()->json([
            'daily_challenge'   => TrxDailyChallenge::where('status', '0')->count(),
            'deposit'           => TrxDeposit::where('status', '0')->count(),
            'withdraw'          => TrxWithdrawal::where('status', '0')->count(),
            'member'            => User::where('role', '!=', '9')->count(),
            'daily_income'      => '0',
            'weekly_income'     => '0',
            'monthly_income'    => '0',
            'balance'           => $balance,
        ]);
    }

}
