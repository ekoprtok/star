<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxIntTransfer;
use App\Models\TrxWithdrawal;
use App\Models\TrxDeposit;
use Helper;

class HistoryController extends Controller {

    public function trxhistory(Request $request) {
        $draw       = $request->get('draw');
        $search     = $request->get('search')['value'];
        $offset     = $request->get('start') -1;
        $limit      = $request->get('length');

        $dataCount  = 2;
        $data       = [
            [
                'date'      => 'Jan 05 2022 11:22',
                'user'      => 'User 1',
                'product'   => 'Premium'
            ],
            [
                'date'      => 'Feb 01 2021 11:22',
                'user'      => 'User 2',
                'product'   => 'Advance'
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

    public function internaltrf(Request $request) {
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

        $data = TrxIntTransfer::select('C.email as email_from', 'D.email as email_to', 'trx_int_transfers.*')->where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.user_id', '=', 'trx_int_transfers.user_wallet_id')
            ->leftJoin('user_wallets as B', 'B.user_id', '=', 'trx_int_transfers.to_wallet_id')
            ->leftJoin('users as C', 'C.id', '=', 'A.user_id')
            ->leftJoin('users as D', 'D.id', '=', 'B.user_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_int_transfers.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }

        $dataCount = TrxIntTransfer::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.user_id', '=', 'trx_int_transfers.user_wallet_id')
            ->leftJoin('user_wallets as B', 'B.user_id', '=', 'trx_int_transfers.to_wallet_id')
            ->leftJoin('users as C', 'C.id', '=', 'A.user_id')
            ->leftJoin('users as D', 'D.id', '=', 'B.user_id')
            ->orderByDesc('trx_int_transfers.created_at')
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
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

        $data = TrxDeposit::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.user_id', '=', 'trx_deposits.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_deposits.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }

        $dataCount = TrxDeposit::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.user_id', '=', 'trx_deposits.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->orderByDesc('trx_deposits.created_at')
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
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

        $data = TrxWithdrawal::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.user_id', '=', 'trx_withdrawals.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('trx_withdrawals.created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }

        $dataCount = TrxWithdrawal::where(function ($query) use ($search) {
            $query->where('amount', 'LIKE', '%' . $search . '%');
        })->leftJoin('user_wallets as A', 'A.user_id', '=', 'trx_withdrawals.user_wallet_id')
            ->leftJoin('users as B', 'B.id', '=', 'A.user_id')
            ->orderByDesc('trx_withdrawals.created_at')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function blessingUnapp() {
        return response()->json([
            'data' => [
                [
                    'date'     => 'Jan 12 2002 11:11',
                    'user'     => 'user 1',
                    'type'     => 'daily',
                    'daily'    => 'Memberi review positif',
                    'action'   => '<a class="text-danger">reject</a>&nbsp;&nbsp;<a class="text-primary">approve</a>'
                ],
                [
                    'date'     => 'Jan 12 2002 11:12',
                    'user'     => 'user 2',
                    'type'     => 'blessing',
                    'daily'    => 'Memberi review positif',
                    'action'   => '<a class="text-danger">reject</a>&nbsp;&nbsp;<a class="text-primary">approve</a>'
                ],
                [
                    'date'     => 'Jan 12 2002 11:13',
                    'user'     => 'user 3',
                    'type'     => 'blessing',
                    'daily'    => 'Memberi review positif',
                    'action'   => '<a class="text-danger">reject</a>&nbsp;&nbsp;<a class="text-primary">approve</a>'
                ],
            ]
        ]);
    }

    public function users() {
        return response()->json([
            'data' => [
                [
                    'registered_at'     => 'Jan 12 2002 11:11',
                    'email'             => 'email1@email.com',
                    'referral'          => 'OS3451'
                ],
                [
                    'registered_at'     => 'Jan 12 2002 10:11',
                    'email'             => 'email@email.com',
                    'referral'          => 'OS3452'
                ],
                [
                    'registered_at'     => 'Jan 12 2002 12:11',
                    'email'             => 'email2@email.com',
                    'referral'          => 'OS3453'
                ],
            ]
        ]);
    }

}
