<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    public function changePassword() {
        return view('dashboard.profile.changePassword');
    }

}
