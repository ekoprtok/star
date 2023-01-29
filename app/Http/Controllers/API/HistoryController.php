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
use Helper;

class HistoryController extends Controller {

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
                    <a href="javascript::void(0)" class="text-danger" onclick="process(\''.$value->id.'\', \'1\', \''.$value->from_id.'\', \''.$value->to_id.'\')">Rejected</a>
                    ';
                }else {
                    $value->action = '-';
                }
                $value->status    = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
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

    public function requestList(Request $request) {
        $draw       = $request->get('draw');
        $search     = $request->get('search')['value'];
        $offset     = $request->get('start') -1;
        $limit      = $request->get('length');

        $dataCount  = 2;
        $data       = [
            [
                'date'  => 'Jan 05 2022 11:22',
                'type'  => 'Packages',
                'desc'  => 'Package Regular',
                'file'  => 'download',
                'status'=> '<span class="badge bg-'.Helper::invoiceStatusClass(0).'">'.Helper::statusApproval(0).'</span>'
            ],
            [
                'date'  => 'Jan 04 2022 11:22',
                'type'  => 'Deposit',
                'desc'  => '$500',
                'file'  => 'download',
                'status'=> '<span class="badge bg-'.Helper::invoiceStatusClass(0).'">'.Helper::statusApproval(0).'</span>'
            ],
        ];

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true
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
                    <a href="javascript::void(0)" class="text-danger" onclick="process(\''.$value->id.'\', \'1\', \''.$value->user_wallet_id.'\')">Rejected</a>
                    ';
                }else {
                    $value->action = '-';
                }
                $value->status    = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
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
                        <a href="javascript::void(0);" class="text-danger" onclick="process(\''.$value->id.'\', \'1\', \''.$value->user_wallet_id.'\')">Rejected</a>
                        ';
                    }else {
                        $value->action = '-';
                    }
                    $value->status    = '<span class="badge bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::statusApproval($value->status).'</span>';
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

        $data   = TrxDailyChallenge::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->leftJoin('users as A', 'A.id', '=', 'trx_daily_challenges.user_id')
            ->leftJoin('packages as B', 'B.id', '=', 'trx_daily_challenges.package_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_daily_challenges.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {

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
