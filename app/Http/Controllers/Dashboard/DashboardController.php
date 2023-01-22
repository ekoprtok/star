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

}
