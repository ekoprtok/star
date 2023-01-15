<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DialyController extends Controller {

    public function index() {
        return response()->json([
            'data' => [
                [
                    'no'       => '1',
                    'dialy'    => 'Memberi review positif',
                    'action'   => '<a class="text-danger">delete</a>&nbsp;&nbsp;<a class="text-primary">edit</a>'
                ],
                [
                    'no'       => '2',
                    'dialy'    => 'Memberi review positif',
                    'action'   => '<a class="text-danger">delete</a>&nbsp;&nbsp;<a class="text-primary">edit</a>'
                ],
                [
                    'no'       => '3',
                    'dialy'    => 'Memberi review positif',
                    'action'   => '<a class="text-danger">delete</a>&nbsp;&nbsp;<a class="text-primary">edit</a>'
                ],
            ]
        ]);
    }
}
