<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function home()
    {
        $title = 'AllAroundBucks - A Platform for Learning & Earning';
        return view('pages.home', compact('title'));
    }

    public function howitworks()
    {
        $title = 'How it Works - AllAroundBucks';
        return view('pages.howitworks', compact('title'));
    }

    public function signin()
    {
        $title = 'Sign in - AllAroundBucks';
        return view('pages.signin', compact('title'));
    }

    public function signup()
    {
        $title = 'Sign up - AllAroundBucks';
        return view('pages.signup' , compact('title'));
    }



}
