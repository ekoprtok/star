<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller {

    public function index() {
        return view('landing.index');
    }

    public function maintenance() {
        return view('landing.maintenance');
    }

    public function news() {
        return view('landing.news');
    }

    public function help() {
        return view('landing.help');
    }

    public function contact() {
        return view('landing.contact');
    }

    public function about() {
        return view('landing.about');
    }

}
