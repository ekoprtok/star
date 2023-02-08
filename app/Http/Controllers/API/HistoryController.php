<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxIntTransfer;
use App\Models\TrxWithdrawal;
use App\Models\TrxDeposit;
use App\Models\User;
use App\Models\TrxDailyChallenge;
use App\Models\TrxDailyBlessing;
use App\Models\TrxPackage;
use App\Models\TrxPackageRedeem;
use App\Models\TrxSocialEvent;
use Helper;

class HistoryController extends Controller {

    public function redeemList(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = TrxPackageRedeem::select('trx_package_redeems.*', 'A.email', 'B.name')->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_package_redeems.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_package_redeems.package_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_package_redeems.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                if ($value->status == '0') {
                    $value->action    = '
                        <a href="javascript::void(0)" onclick="process(\''.$value->id.'\', \''.$value->user_id.'\', \'1\')">Approve</a>
                            &nbsp;
                            &nbsp;
                        <a href="javascript::void(0)" class="text-danger" onclick="process(\''.$value->id.'\', \''.$value->user_id.'\', \'2\')">Reject</a>
                    ';
                }else {
                    $value->action = '-';
                }
                $value->ramount = Helper::format_harga($value->ramount);
                $value->status  = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
            }
        }

        $dataCount = TrxPackageRedeem::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_package_redeems.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_package_redeems.package_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function trxhistory(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = TrxPackage::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_packages.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_packages.package_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_packages.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->package_type = Helper::packageType($value->package_type);
            }
        }

        $dataCount = TrxPackage::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_packages.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_packages.package_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function internaltrf(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data = TrxIntTransfer::select('C.email as email_from', 'C.id as from_id', 'D.id as to_id', 'D.email as email_to', 'trx_int_transfers.*')->where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.id', '=', 'trx_int_transfers.user_wallet_id')
            ->leftJoin('user_wallets as B', 'B.id', '=', 'trx_int_transfers.to_wallet_id')
            ->leftJoin('users as C', 'C.id', '=', 'A.user_id')
            ->leftJoin('users as D', 'D.id', '=', 'B.user_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_int_transfers.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                if ($value->status == '0') {
                    $value->action    = '
                    <a href="javascript::void(0)" onclick="process(\''.$value->id.'\', \'1\', \''.$value->from_id.'\', \''.$value->to_id.'\')">Approve</a>
                    &nbsp;
                    &nbsp;
                    <a href="javascript::void(0)" class="text-danger" onclick="process(\''.$value->id.'\', \'2\', \''.$value->from_id.'\', \''.$value->to_id.'\')">Reject</a>
                    ';
                }else {
                    $value->action = '-';
                }
                $value->amount  = Helper::format_harga($value->amount);
                $value->status  = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
            }
        }

        $dataCount = TrxIntTransfer::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.id', '=', 'trx_int_transfers.user_wallet_id')
            ->leftJoin('user_wallets as B', 'B.id', '=', 'trx_int_transfers.to_wallet_id')
            ->leftJoin('users as C', 'C.id', '=', 'A.user_id')
            ->leftJoin('users as D', 'D.id', '=', 'B.user_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function blessing(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = TrxDailyBlessing::select('trx_daily_blessings.*', 'A.email', 'B.name')->where(function ($query) use ($search) {
            $query->where('A.email', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_daily_blessings.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_daily_blessings.package_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_daily_blessings.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->amount = Helper::format_harga($value->amount);
            }
        }

        $dataCount = TrxDailyBlessing::where(function ($query) use ($search) {
            $query->where('A.email', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_daily_blessings.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_daily_blessings.package_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function depositList(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = TrxDeposit::select('trx_deposits.*', 'B.email', 'A.user_id')->where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.id', '=', 'trx_deposits.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_deposits.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->file_path = '<a href="'.asset('uploads/deposit/'.$value->file_path).'" target="_blank">'.$value->file_path.'</a>';
                if ($value->status == '0') {
                    $value->action    = '
                    <a href="javascript::void(0)" onclick="process(\''.$value->id.'\', \'1\', \''.$value->user_wallet_id.'\')">Approve</a>
                    &nbsp;
                    &nbsp;
                    <a href="javascript::void(0)" class="text-danger" onclick="process(\''.$value->id.'\', \'2\', \''.$value->user_wallet_id.'\')">Reject</a>
                    ';
                }else {
                    $value->action = '-';
                }
                $value->amount  = Helper::format_harga($value->amount);
                $value->status  = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
            }
        }

        $dataCount = TrxDeposit::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.user_id', '=', 'trx_deposits.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function socialEventList(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = TrxSocialEvent::select('trx_social_events.*', 'B.email')->where(function ($query) use ($search) {
            $query->where('B.email', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as B', 'B.id', '=', 'trx_social_events.user_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_social_events.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->file_path = '<a href="'.asset('uploads/socialEvent/'.$value->file_path).'" target="_blank">'.$value->file_path.'</a>';
                if ($value->status == '0') {
                    $value->action    = '
                    <a href="javascript::void(0)" onclick="process(\''.$value->id.'\', \'1\')">Approve</a>
                    &nbsp;
                    &nbsp;
                    <a href="javascript::void(0)" class="text-danger" onclick="process(\''.$value->id.'\', \'2\')">Reject</a>
                    ';
                }else {
                    $value->action = '-';
                }
                $value->description = '<a href="javascript:void(0);" title="'.$value->description.'">Hover to see</span>';
                $value->status      = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
            }
        }

        $dataCount = TrxSocialEvent::where(function ($query) use ($search) {
            $query->where('B.email', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as B', 'B.id', '=', 'trx_social_events.user_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function withdrawalList(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data = TrxWithdrawal::select('trx_withdrawals.*', 'B.email', 'A.user_id')->where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.id', '=', 'trx_withdrawals.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_withdrawals.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                foreach ($data as $key => $value) {
                    if ($value->status == '0') {
                        $value->action    = '
                            <a href="javascript::void(0);" onclick="process(\''.$value->id.'\', \'1\', \''.$value->user_wallet_id.'\')">Approve</a>
                            &nbsp;
                            &nbsp;
                            <a href="javascript::void(0);" class="text-danger" onclick="process(\''.$value->id.'\', \'2\', \''.$value->user_wallet_id.'\')">Reject</a>
                        ';
                    }else {
                        $value->action = '-';
                    }
                    $value->amount_f  = Helper::format_harga($value->amount);
                    $value->status_f  = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
                }
            }
        }

        $dataCount = TrxWithdrawal::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.id', '=', 'trx_withdrawals.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function blessingUnapp(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data   = TrxDailyChallenge::select('trx_daily_challenges.*', 'A.email', 'B.name', 'C.name as challenge', 'C.isText')->where(function ($query) use ($search) {
            $query->where('A.email', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_daily_challenges.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_daily_challenges.package_id')
            ->leftJoin('daily_challenges as C', 'C.id', '=', 'trx_daily_challenges.dialy_challenge_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_daily_challenges.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->proof = ($value->isText == '0') ? '<a href="'.asset('uploads/dailyChallenge/'.$value->file_path).'" target="_blank">'.$value->file_path.'</a>' : $value->file_path;
                if ($value->status == '0') {
                    $value->action    = '
                        <a href="javascript::void(0);" onclick="process(\''.$value->id.'\', \'1\')">Approve</a>
                        &nbsp;
                        &nbsp;
                        <a href="javascript::void(0);" class="text-danger" onclick="process(\''.$value->id.'\', \'2\')">Reject</a>
                    ';
                }else {
                    $value->action = '-';
                }

                $value->isText = ($value->isText == '0') ? 'Social Event' : 'Testimoni';
                $value->status = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
            }
        }

        $dataCount = TrxDailyChallenge::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_daily_challenges.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_daily_challenges.package_id')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function users(Request $request) {
        $draw       = $request->get('draw');
        $search     = $request->get('search')['value'];
        $offset     = $request->get('start') -1;
        $limit      = $request->get('length');

        $data       = User::where(function ($query) use ($search) {
            $query->where('email', 'LIKE', '%' . $search . '%');
        })->where('role', '!=', '9')->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->created_at_f    = Helper::format_date($value->created_at);
                $value->referral_code_f = ($value->referral_code) ? $value->referral_code : '-';
                $value->status_f        = '<span class="badge bg-'.Helper::statusUserClass(($value->email_verified_at) ? 1 : 0).'">'.Helper::statusUser(($value->email_verified_at) ? 1 : 0).'</span>';
            }
        }

        $dataCount = User::where(function ($query) use ($search) {
            $query->where('email', 'LIKE', '%' . $search . '%');
        })->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true
        ]);
    }

}
