<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

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
        $draw       = $request->get('draw');
        $search     = $request->get('search')['value'];
        $offset     = $request->get('start') -1;
        $limit      = $request->get('length');

        $dataCount  = 2;
        $data       = [
            [
                'date'      => 'Jan 05 2022 11:22',
                'from'      => 'User1@test.com',
                'to'        => 'User2@test.com',
                'amount'    => '$100',
                'action'=> '<a class="text-danger">Reject</a>&nbsp;<a class="text-success">Approve</a>'
            ],
            [
                'date'      => 'Jan 05 2022 11:22',
                'from'      => 'User2@test.com',
                'to'        => 'User1@test.com',
                'amount'    => '$120',
                'action'=> '<a class="text-danger">Reject</a>&nbsp;<a class="text-success">Approve</a>'
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
        $draw       = $request->get('draw');
        $search     = $request->get('search')['value'];
        $offset     = $request->get('start') -1;
        $limit      = $request->get('length');

        $dataCount  = 2;
        $data       = [
            [
                'date'  => 'Jan 05 2022 11:22',
                'user'  => 'Jhon',
                'amount'=> Helper::format_harga(10000),
                'file'  => 'download',
                'status'=> '<span class="badge bg-'.Helper::invoiceStatusClass(0).'">'.Helper::statusApproval(0).'</span>',
                'action'=> '<a class="text-danger">Reject</a>&nbsp;<a class="text-success">Approve</a>'
            ],
            [
                'date'  => 'Jan 04 2022 11:22',
                'user'  => 'Dhoe',
                'amount'=> Helper::format_harga(500),
                'file'  => 'download',
                'status'=> '<span class="badge bg-'.Helper::invoiceStatusClass(0).'">'.Helper::statusApproval(0).'</span>',
                'action'=> '<a class="text-danger">Reject</a>&nbsp;<a class="text-success">Approve</a>'
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

    public function withdrawalList(Request $request) {
        $draw       = $request->get('draw');
        $search     = $request->get('search')['value'];
        $offset     = $request->get('start') -1;
        $limit      = $request->get('length');

        $dataCount  = 2;
        $data       = [
            [
                'date'  => 'Jan 05 2022 11:22',
                'user'  => 'Jhon',
                'amount'=> Helper::format_harga(10000),
                'action'=> '<a class="text-danger">Reject</a>&nbsp;<a class="text-success">Approve</a>'
            ],
            [
                'date'  => 'Jan 04 2022 11:22',
                'user'  => 'Deposit',
                'amount'=> Helper::format_harga(500),
                'action'=> '<a class="text-danger">Reject</a>&nbsp;<a class="text-success">Approve</a>'
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
