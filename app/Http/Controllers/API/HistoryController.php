<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;

class HistoryController extends Controller {

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

}
