<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyChallengeController extends Controller {

    public function index() {
        return view('dashboard.daily.index');
    }

    public function form(Request $request) {
        $id = $request->id;
        return view('dashboard.daily.form', compact('id'));
    }

    public function blessing() {
        return view('dashboard.daily.blessing');
    }

    public function form_blessing() {
        return view('dashboard.daily.form_blessing');
    }

}
