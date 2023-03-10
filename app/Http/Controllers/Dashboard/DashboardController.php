<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller {

    public function index() {
        return view('dashboard.home');
    }

    public function users() {
        return view('dashboard.users.index');
    }

    public function tree() {
        return view('dashboard.users.tree');
    }

    public function balance() {
        return view('dashboard.users.balance');
    }

    public function adminTree() {
        return view('dashboard.users.adminTree');
    }

    public function detailUser(Request $request) {
        $id = $request->id;
        return view('dashboard.users.detailUser', compact('id'));
    }

    public function adminBalance() {
        return view('dashboard.users.balanceAdmin');
    }

}
