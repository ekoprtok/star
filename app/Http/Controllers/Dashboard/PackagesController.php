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

    public function packageAdd() {
        return view('dashboard.packages.admin_package_add');
    }

    public function my() {
        return view('dashboard.packages.my_packages');
    }

}
