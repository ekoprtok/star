<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InternalTransferController extends Controller {

    public function index() {
        return view('dashboard.internaltransfer.index');
    }

}
