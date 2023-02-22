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
use App\Models\UserPackage;
use App\Models\Member;
use App\Models\Rank;
use App\Models\OwnerWallet;
use App\Models\UserWalletHistory;
use App\Models\OwnerWalletHistory;
use App\Models\OwnerWalletRealHistory;
use Carbon\Carbon;
use Helper;

class DashboardController extends Controller {

    public function index(Request $request) {
        $startDate      = ($request->startDate) ? $request->startDate :  null;
        $endDate        = ($request->endDate) ? $request->endDate : null;
        $id             = $request->id;
        $userWallet     = UserWallet::where('user_id', $id)->first();
        $userData       = User::find($id);
        $username       = ($userData) ? $userData->username : '';
        $rankId         = ($userData) ? $userData->rank_id : '';
        $dataRank       = Rank::find($rankId);
        $rank           = ($dataRank) ? $dataRank->name : '-';
        $balance        = ($userWallet) ? Helper::format_harga($userWallet->rbalance_amount) : Helper::format_harga(0);
        $balance_r      = ($userWallet) ? $userWallet->rbalance_amount : 0;
        $balance_avai   = 0;
        if ($userWallet) {
            $trxInternal  = TrxIntTransfer::selectRaw('SUM(amount) as pending')->where(['status' => '0', 'user_wallet_id' => $userWallet->id])->first();
            $trxWd        = TrxWithdrawal::selectRaw('SUM(amount) as pending')->where(['status' => '0', 'user_wallet_id' => $userWallet->id])->first();
            $balance_avai = $userWallet->rbalance_amount - ($trxInternal->pending + $trxWd->pending);
        }
        $notif_data     = Notification::where(['to_user_id' => $id, 'is_read' => '0'])->orderByDesc('created_at')->limit(5)->get();
        if ($notif_data) {
            foreach ($notif_data as $key => $value) {
                $value->created_at_f = $value->created_at->diffForHumans();
            }
        }

        if ($startDate && $endDate) {
            $dataDepo   = OwnerWalletRealHistory::selectRaw('SUM(amount) as amount')->whereIn('type', ['1'])->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->first();
            $dataDonate = OwnerWalletHistory::selectRaw('SUM(amount) as amount')->where('type', '1')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->first();
            $dataWD     = OwnerWalletRealHistory::selectRaw('SUM(amount) as amount')->where('type', '2')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->first();
            $dataBonus  = OwnerWalletHistory::selectRaw('SUM(amount) as amount')->whereIn('type', ['4','5','6','7','8','9','10'])->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->first();
            $wSystem    = ($dataDepo ? $dataDepo->amount : 0) - ($dataDonate ? $dataDonate->amount : 0) - ($dataWD ? $dataWD->amount : 0) + ($dataBonus ? $dataBonus->amount : 0);
            $wAdmin     = ($dataDonate ? $dataDonate->amount : 0);
        }else {
            $dataDepo   = OwnerWalletRealHistory::selectRaw('SUM(amount) as amount')->whereIn('type', ['1'])->first();
            $dataDonate = OwnerWalletHistory::selectRaw('SUM(amount) as amount')->where('type', '1')->first();
            $dataWD     = OwnerWalletRealHistory::selectRaw('SUM(amount) as amount')->where('type', '2')->first();
            $dataBonus  = OwnerWalletHistory::selectRaw('SUM(amount) as amount')->whereIn('type', ['4','5','6','7','8','9','10'])->first();
            $wSystem    = ($dataDepo ? $dataDepo->amount : 0) - ($dataDonate ? $dataDonate->amount : 0) - ($dataWD ? $dataWD->amount : 0) + ($dataBonus ? $dataBonus->amount : 0);
            $wAdmin     = ($dataDonate ? $dataDonate->amount : 0);
        }
        return response()->json([
            'daily_challenge'   => TrxDailyChallenge::where('status', '0')->count(),
            'deposit'           => TrxDeposit::where('status', '0')->count(),
            'withdraw'          => TrxWithdrawal::where('status', '0')->count(),
            'internal_transfer' => TrxIntTransfer::where('status', '0')->count(),
            'member'            => User::where('role', '0')->count(),
            'notification_count'=> count($notif_data),
            'notification'      => $notif_data,
            'redeem'            => TrxPackageRedeem::where('status', '0')->count(),
            'social_event'      => TrxSocialEvent::where('status', '0')->count(),
            'balance'           => $balance,
            'balance_r'         => $balance_r,
            'balance_available' => Helper::format_harga($balance_avai),
            'balance_avail_r'   => $balance_avai,
            'config'            => Helper::config(),
            'username'          => $username,
            'rank'              => $rank,
            't_deposit'         => Helper::format_harga(($dataDepo ? $dataDepo->amount : 0)),
            't_system'          => Helper::format_harga($wSystem),
            't_admin'           => Helper::format_harga($wAdmin),
            't_donate'          => Helper::format_harga(($dataDonate ? $dataDonate->amount : 0)),
            't_wd'              => Helper::format_harga(($dataWD ? $dataWD->amount : 0)),
            't_bonus'           => Helper::format_harga(($dataBonus ? $dataBonus->amount : 0)),
        ]);
    }

    public function adminTree(Request $request) {
        if ($request->id) {
            $where = ['parent_id' => $request->id];
        }else {
            if ($request->parent_id == '-') {
                $where = ['parent_id'   => null];
            }else {
                $where = ['user_id'   => $request->parent_id];
            }
        }
        $select = ['members.user_id as id', 'members.parent_id', 'users.username as text'];
        $data   = Member::select($select)->where($where)->leftJoin('users', 'users.id', '=', 'members.user_id')->get();
        if ($data) {
            foreach ($data as $key => $value) {
                $value->link = route('dashboard.admin.detail.user', ['id' => $value->id]);
                $this->setChildAdmin($select, $value);
            }
        }
        return response()->json($data);
    }

    public function tree(Request $request) {
        if ($request->id) {
            $where = ['parent_id' => $request->id];
        }else {
            $where = ['user_id'   => $request->parent_id];
        }
        $select = ['members.user_id as id', 'members.parent_id', 'users.username as text'];
        $data   = Member::select($select)->where($where)->leftJoin('users', 'users.id', '=', 'members.user_id')->get();
        if ($data) {
            foreach ($data as $key => $value) {
                $this->setChild($select, $value);
            }
        }
        return response()->json($data);
    }

    public function setChild($select, $value) {
        $subWhere         = ['parent_id' => $value->id];
        $haveChild        = Member::select($select)->leftJoin('users', 'users.id', '=', 'members.user_id')->where($subWhere)->get();
        $value->state     = ($haveChild->count() > 0) ? 'closed' : 'open';
        $value->children  = $haveChild;

        if ($value->children) {
            foreach ($value->children as $k => $v) {
                $this->setChild($select, $v);
            }
        }
    }

    public function setChildAdmin($select, $value) {
        $subWhere         = ['parent_id' => $value->id];
        $haveChild        = Member::select($select)->leftJoin('users', 'users.id', '=', 'members.user_id')->where($subWhere)->get();
        $value->state     = ($haveChild->count() > 0) ? 'closed' : 'open';
        $value->children  = $haveChild;

        if ($value->children) {
            foreach ($value->children as $k => $v) {
                $v->link = route('dashboard.admin.detail.user', ['id' => $v->id]);
                $this->setChildAdmin($select, $v);
            }
        }
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
        $deposit     = TrxDeposit::where('user_wallet_id', $userWallet->id)->selectRaw('submitted_at, CONCAT_WS("~", amount,received_amount,notes) as description, status, "Deposit" as type, file_path as file');
        $withdraw    = TrxWithdrawal::where('user_wallet_id', $userWallet->id)->selectRaw('submitted_at, CONCAT_WS("~", amount,net_amount,withdrawal_fee) as description, status, "Withdrawal" as type, NULL as file');
        $internal    = TrxIntTransfer::where('user_wallet_id', $userWallet->id)
                            ->leftJoin('user_wallets', 'user_wallets.id', '=', 'trx_int_transfers.to_wallet_id')
                            ->leftJoin('users', 'users.id', '=', 'user_wallets.user_id')
                            ->selectRaw('trx_int_transfers.submitted_at, CONCAT(trx_int_transfers.amount,"~",users.email) as description, trx_int_transfers.status, "Internal Transfer" as type, NULL as file');
        $redeem      = TrxPackageRedeem::where('user_id', $user->id)->leftJoin('packages', 'packages.id', '=', 'trx_package_redeems.package_id')->selectRaw('submitted_at, CONCAT(ramount,"~",name) as description, status, "Package Redeem" as type, NULL as file');
        $challeng    = TrxDailyChallenge::where('user_id', $user->id)->leftJoin('daily_challenges', 'daily_challenges.id', '=', 'trx_daily_challenges.dialy_challenge_id')->selectRaw('submitted_at, CONCAT_WS("~", daily_challenges.name, amount) as description, status, "Daily Challenge" as type, IF(daily_challenges.isText="1", "-", file_path) as file');
        $data        = TrxSocialEvent::where('user_id', $user->id)->selectRaw('submitted_at, description, status, "Social Event" as type, file_path as file')
        // $data        = TrxPackage::where('trx_packages.user_id', $user_id)->leftJoin('packages', 'packages.id', '=', 'trx_packages.package_id')->selectRaw('trx_packages.submitted_at, packages.name as description, "~" as status, "Package" as type, NULL as file')
                        ->union($internal)
                        ->union($deposit)
                        ->union($withdraw)
                        ->union($challeng)
                        ->union($redeem)
                        // ->union($socialEvent)
                        ->offset($offset)
                        ->limit($limit)
                        ->orderByDesc('submitted_at')
                        ->get();
        if ($data) {
            foreach ($data as $key => $value) {
                if ($value->type == 'Package Redeem' || $value->type == 'Internal Transfer') {
                    $dataAmount         = explode('~', $value->description);
                    $price              = Helper::format_harga((isset($dataAmount[0]) ? $dataAmount[0] : 0));
                    $desc               = (isset($dataAmount[1])) ? $dataAmount[1] : '';
                    $value->description = $price.' '.($value->type == 'Internal Transfer' ? 'to' : 'of').' '.$desc.($value->type == 'Internal Transfer' ? '' : ' package');
                }elseif($value->type == 'Deposit') {
                    $dataAmount         = explode('~', $value->description);
                    $price              = Helper::format_harga((isset($dataAmount[0]) ? $dataAmount[0] : 0));
                    $received           = Helper::format_harga((isset($dataAmount[1]) ? $dataAmount[1] : 0));
                    $desc               = isset($dataAmount[2]) ? $dataAmount[2] : '';
                    $value->description = $price.($value->status == '1' ? ' (received : '.$received.') '.$desc : '');
                }elseif($value->type == 'Withdrawal') {
                    $dataAmount         = explode('~', $value->description);
                    $amount             = Helper::format_harga((isset($dataAmount[0]) ? $dataAmount[0] : 0));
                    $received           = Helper::format_harga((isset($dataAmount[1]) ? $dataAmount[1] : 0), '$', 3);
                    $fee                = Helper::format_harga((isset($dataAmount[2]) ? $dataAmount[2] : 0), '$', 3);
                    $value->description = $amount.' (net: '.$received.', fee: '.$fee.')';
                }elseif($value->type == 'Daily Challenge') {
                    $dataAmount         = explode('~', $value->description);
                    $desc               = (isset($dataAmount[0]) ? $dataAmount[0] : '-');
                    $amount             = Helper::format_harga((isset($dataAmount[1]) ? $dataAmount[1] : 0));
                    $value->description = $desc.' ('.$amount.')';
                }else {
                    $value->description = ($value->type != 'Package' && $value->type != 'Daily Challenge' && $value->type != 'Social Event') ? Helper::format_harga($value->description) : $value->description;
                }
                $folder             = ($value->type == 'Social Event') ? 'socialEvent' : ($value->type == 'Deposit' ? 'deposit' : 'dailyChallenge');
                $value->file        = ($value->file) ? '<a href="javascript:void(0)" onclick="modalPop(\''.asset('uploads/'.$folder.'/'.$value->file).'\')">'.$value->file.'</a>' : '-';
                $value->status      = ($value->status != '~') ? '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>' : '-';
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

    public function checkUsername(Request $request) {
        $user       = User::where('referral_code', $request->uname)->count();
        $haveActive = true;
        // if ($user > 0) {
        //     $userRef    = User::where('referral_code', $request->uname)->first();
        //     $check      = UserPackage::where(['user_id' => $userRef->id, 'status' => '1'])->count();
        //     $haveActive = ($check > 0) ? true : false;
        // }

        return response()->json([
            'exist'     => ($user > 0) ? (($haveActive) ? true : false) : false,
            'message'   => ($user > 0) ? (($haveActive) ? '' : 'Referral code have no donate yet') : 'Referral code does not exist yet',
        ]);
    }

    public function adminBalance(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = OwnerWalletHistory::select('owner_wallet_histories.*', 'users.email as user')->where(function ($query) use ($search) {
            $query->where('trx_at', 'LIKE', '%' . $search . '%');
        })->leftJoin('users', 'users.id', '=', 'owner_wallet_histories.trx_user_id')->orderByDesc('trx_at')
            ->offset($offset)
            ->limit($limit)
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->type   = Helper::typeTrx($value->type);
                $value->amount = '<span class="text-'.($value->status == 'in' ? 'success' : 'danger').'">'.($value->status == 'in' ? '+' : '-').Helper::format_harga($value->amount).'</span>';
            }
        }

        $dataCount = OwnerWalletHistory::where(function ($query) use ($search) {
            $query->where('trx_at', 'LIKE', '%' . $search . '%');
        })->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function adminBalanceReal(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = OwnerWalletRealHistory::select('owner_wallet_real_histories.*', 'users.email as user')->where(function ($query) use ($search) {
            $query->where('trx_at', 'LIKE', '%' . $search . '%');
        })->leftJoin('users', 'users.id', '=', 'owner_wallet_real_histories.trx_user_id')->orderByDesc('trx_at')
            ->offset($offset)
            ->limit($limit)
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->type   = Helper::typeTrx($value->type);
                $value->amount = '<span class="text-'.($value->status == 'in' ? 'success' : 'danger').'">'.($value->status == 'in' ? '+' : '-').Helper::format_harga($value->amount).'</span>';
            }
        }

        $dataCount = OwnerWalletRealHistory::where(function ($query) use ($search) {
            $query->where('trx_at', 'LIKE', '%' . $search . '%');
        })->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function adminBalanceWallet() {
        $data = OwnerWallet::first();
        return response()->json([
            'owner_balance'     => Helper::format_harga(($data ? $data->rbalance_amount : 0)),
            'owner_balance_r'   => Helper::format_harga(($data ? $data->rbalance_amount_real : 0)),
        ]);
    }

}
