<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller {

    public function index() {
        return view('dashboard.activity.index');
    }

}
