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

    public function internalTrf() {
        return view('dashboard.history.internaltrf');
    }

    public function dialyUnapp() {
        return view('dashboard.history.dialyUnapp');
    }

    public function dialyBlessing() {
        return view('dashboard.history.dialyBlessing');
    }

    public function redeemList() {
        return view('dashboard.history.redeem');
    }

    public function socialEvent() {
        return view('dashboard.history.socialEvent');
    }

}
