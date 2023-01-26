<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackagesController extends Controller {

    public function index() {
        return view('dashboard.packages.index');
    }

    public function package() {
        return view('dashboard.packages.admin_package');
    }

    public function packageForm(Request $request) {
        $id = $request->id;
        return view('dashboard.packages.admin_package_form', compact('id'));
    }

    public function my() {
        return view('dashboard.packages.my_packages');
    }

    public function percentageForm(Request $request) {
        $package_id = $request->id;
        return view('dashboard.packages.percentage_form', compact('package_id'));
    }

}
