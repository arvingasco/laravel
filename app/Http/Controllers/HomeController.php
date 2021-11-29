<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        // Auth::id();
        return view('home.index');
    }

    public function contact() {
        return view('home.contact');
    }

    public function about() {
        return view('home.about');
    }
}
