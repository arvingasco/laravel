<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.index');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function personalContact()
    {
        return view('home.personalContact');
    }

    public function about()
    {
        return view('home.about');
    }
}
