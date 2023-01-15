<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller {

    public function transaction() {
        return view('dashboard.history.transaction');
    }

    public function deposit() {
        return view('dashboard.history.deposit');
    }

    public function withdrawal() {
        return view('dashboard.history.withdrawal');
    }

}
