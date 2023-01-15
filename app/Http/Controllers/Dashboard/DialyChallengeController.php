<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DialyChallengeController extends Controller {

    public function index() {
        return view('dashboard.dialy.index');
    }

    public function form() {
        return view('dashboard.dialy.form');
    }

}
