<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RankController extends Controller {

    public function index() {
        return view('dashboard.rank.index');
    }

    public function form(Request $request) {
        $id = $request->id;
        return view('dashboard.rank.form', compact('id'));
    }

}
