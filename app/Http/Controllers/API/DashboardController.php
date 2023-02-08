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
use App\Models\TrxPackageRedeem;
use App\Models\TrxSocialEvent;
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
            'redeem'            => TrxPackageRedeem::where('status', '0')->count(),
            'daily_income'      => '0',
            'weekly_income'     => '0',
            'monthly_income'    => '0',
            'balance'           => $balance,
            'config'            => Helper::config()
        ]);
    }

    public function testimoni() {
        $data = TrxDailyChallenge::select('users.username', 'trx_daily_challenges.file_path')
                        ->leftJoin('daily_challenges', 'daily_challenges.id', '=', 'trx_daily_challenges.dialy_challenge_id')
                        ->leftJoin('users', 'users.id', '=', 'trx_daily_challenges.user_id')
                        ->where(['daily_challenges.isText' => '1', 'trx_daily_challenges.status' => '1'])
                        ->limit(10)->get();
        return response()->json($data);
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
        $redeem      = TrxPackageRedeem::where('user_id', $user->id)->leftJoin('packages', 'packages.id', '=', 'trx_package_redeems.package_id')->selectRaw('submitted_at, CONCAT(ramount,"~",name) as description, status, "Package Redeem" as type, NULL as file');
        $challeng    = TrxDailyChallenge::where('user_id', $user->id)->leftJoin('daily_challenges', 'daily_challenges.id', '=', 'trx_daily_challenges.dialy_challenge_id')->selectRaw('submitted_at, IF(daily_challenges.isText="1", file_path, "-") as description, status, "Daily Challenge" as type, IF(daily_challenges.isText="1", "-", file_path) as file');
        $socialEvent = TrxSocialEvent::where('user_id', $user->id)->selectRaw('submitted_at, description, status, "Social Event" as type, file_path as file');
        $data        = TrxPackage::where('trx_packages.user_id', $user_id)->leftJoin('packages', 'packages.id', '=', 'trx_packages.package_id')->selectRaw('trx_packages.submitted_at, packages.name as description, "1" as status, "Package" as type, NULL as file')
                        ->union($internal)
                        ->union($deposit)
                        ->union($withdraw)
                        ->union($challeng)
                        ->union($redeem)
                        ->union($socialEvent)
                        ->offset($offset)
                        ->limit($limit)
                        ->orderByDesc('submitted_at')
                        ->get();
        if ($data) {
            foreach ($data as $key => $value) {
                if ($value->type == 'Package Redeem') {
                    $dataAmount         = explode('~', $value->description);
                    $price              = Helper::format_harga((isset($dataAmount[0]) ? $dataAmount[0] : 0));
                    $desc               = (isset($dataAmount[1])) ? $dataAmount[1] : '';
                    $value->description = $price.' of '.$desc.' package';
                }else {
                    $value->description = ($value->type != 'Package' && $value->type != 'Daily Challenge' && $value->type != 'Social Event') ? Helper::format_harga($value->description) : $value->description;
                }
                $folder             = ($value->type == 'Social Event') ? 'socialEvent' : 'dailyChallenge';
                $value->file        = ($value->file) ? '<a href="'.asset('uploads/'.$folder.'/'.$value->file).'" target="_blank">'.$value->file.'</a>' : '-';
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
