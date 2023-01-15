<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller {

    public function index() {
        return response()->json([
            'data' => [
                [
                    'name' => 'Regular',
                    'donation' => '$100',
                    'fee'      => '$10',
                    'total'    => '$110'
                ],
                [
                    'name' => 'Advance',
                    'donation' => '$1000',
                    'fee'      => '$10',
                    'total'    => '$1100'
                ],
                [
                    'name' => 'Premium',
                    'donation' => '$10000',
                    'fee'      => '$10',
                    'total'    => '$10750'
                ],
                [
                    'name' => 'Solitaire',
                    'donation' => '$100000',
                    'fee'      => '$10',
                    'total'    => '$105000'
                ],
            ]
        ]);
    }

    public function packageList() {
        return response()->json([
            'data' => [
                [
                    'name'     => 'Regular',
                    'level'    => '1',
                    'donation' => '$100',
                    'fee'      => '$10',
                    'value'    => '$110',
                    'dialy'    => '$0.135',
                    'action'   => '<a class="text-danger">delete</a>&nbsp;&nbsp;<a class="text-primary">edit</a>'
                ],
                [
                    'name'     => 'Advance',
                    'level'    => '2',
                    'donation' => '$1000',
                    'fee'      => '$10',
                    'value'    => '$1100',
                    'dialy'    => '$0.135',
                    'action'   => '<a class="text-danger">delete</a>&nbsp;&nbsp;<a class="text-primary">edit</a>'
                ],
                [
                    'name'     => 'Premium',
                    'level'    => '3',
                    'donation' => '$10000',
                    'fee'      => '$10',
                    'value'    => '$10750',
                    'dialy'    => '$0.135',
                    'action'   => '<a class="text-danger">delete</a>&nbsp;&nbsp;<a class="text-primary">edit</a>'
                ],
                [
                    'name'     => 'Solitaire',
                    'level'    => '4',
                    'donation' => '$100000',
                    'fee'      => '$10',
                    'value'    => '$105000',
                    'dialy'    => '$0.135',
                    'action'   => '<a class="text-danger">delete</a>&nbsp;&nbsp;<a class="text-primary">edit</a>'
                ],
            ]
        ]);
    }
}
