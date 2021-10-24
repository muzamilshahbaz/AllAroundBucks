<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('index');
        }
    }

    function index()
    {
        $title = 'AllAroundBucks - A Platform for Learning & Earning';
        return view('pages.home',compact('title'));
    }
}
