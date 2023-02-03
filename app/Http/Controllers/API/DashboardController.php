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
use App\Models\Notification;
use Helper;

class DashboardController extends Controller {

    public function index(Request $request) {
        $id         = $request->id;
        $userWallet = UserWallet::where('user_id', $id)->first();
        $balance    = ($userWallet) ? Helper::format_harga($userWallet->rbalance_amount) : Helper::format_harga(0);
        $notif_data = Notification::where(['to_user_id' => $id, 'is_read' => '0'])->limit(5)->get();
        if ($notif_data) {
            foreach ($notif_data as $key => $value) {
                $value->created_at_f = $value->created_at->diffForHumans();
            }
        }
        return response()->json([
            'daily_challenge'   => TrxDailyChallenge::where('status', '0')->count(),
            'deposit'           => TrxDeposit::where('status', '0')->count(),
            'withdraw'          => TrxWithdrawal::where('status', '0')->count(),
            'internal_transfer' => TrxIntTransfer::where('status', '0')->count(),
            'member'            => User::where('role', '!=', '9')->count(),
            'notification_count'=> count($notif_data),
            'notification'      => $notif_data,
            'daily_income'      => '0',
            'weekly_income'     => '0',
            'monthly_income'    => '0',
            'balance'           => $balance,
        ]);
    }

    public function requestList(Request $request) {
        $draw        = $request->get('draw');
        $search      = $request->get('search')['value'];
        $offset      = $request->get('start') -1;
        $limit       = $request->get('length');

        $user_id     = $request->user_id;
        $user        = User::find($user_id);
        $userWallet  = UserWallet::where('user_id', $user->id)->first();
        $deposit     = TrxDeposit::where('user_wallet_id', $userWallet->id)->selectRaw('submitted_at, amount as description, status, "Deposit" as type, file_path as file');
        $withdraw    = TrxWithdrawal::where('user_wallet_id', $userWallet->id)->selectRaw('submitted_at, amount as description, status, "Withdrawal" as type, NULL as file');
        $internal    = TrxIntTransfer::where('user_wallet_id', $userWallet->id)->selectRaw('submitted_at, amount as description, status, "Internal Transfer" as type, NULL as file');
        $data        = TrxPackage::where('trx_packages.user_id', $user_id)->leftJoin('packages', 'packages.id', '=', 'trx_packages.package_id')->selectRaw('trx_packages.submitted_at, packages.name as description, "1" as status, "Package" as type, NULL as file')
                        ->union($internal)
                        ->union($deposit)
                        ->union($withdraw)
                        ->offset($offset)
                        ->limit($limit)
                        ->orderByDesc('submitted_at')
                        ->get();
        if ($data) {
            foreach ($data as $key => $value) {
                $value->description = ($value->type != 'Package') ? Helper::format_harga($value->description) : $value->description;
                $value->file        = ($value->file) ? '<a href="'.asset('uploads/deposit/'.$value->file).' target="_blank">'.$value->file.'</a>' : '-';
                $value->status      = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
            }
        }

        $dataCount     = TrxPackage::where('trx_packages.user_id', $user_id)->leftJoin('packages', 'packages.id', '=', 'trx_packages.package_id')->selectRaw('trx_packages.submitted_at, packages.name as description, "1" as status, "Package" as type, NULL as file')
                        ->union($internal)
                        ->union($deposit)
                        ->union($withdraw)
                        ->count();


        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true
        ]);
    }

}
