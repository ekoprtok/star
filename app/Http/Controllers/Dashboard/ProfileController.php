<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    public function changePassword() {
        return view('dashboard.profile.changePassword');
    }

    public function wallet() {
        return view('dashboard.profile.wallet');
    }

    public function authenticator() {
        return view('dashboard.profile.authenticator');
    }

    public function otp() {
        return view('dashboard.profile.otp');
    }

}
