<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    function savePersonalInfo(Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $request->validate([
            'email'=>'email',
            'username'=>'alpha_num|min:8|max:16'
        ]);

        $user->email = $request->email;
        $user->username = $request->username;

       $query =  $user->update();

       if ($query) {
           return redirect('settings')->with('success', 'Changes Saved');
       } else {
           return back()->with('fail', 'Something went wrong.');
       }

    }

    function changePassword(Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        if($request->password == $user->password)
        {
            return back()->with('fail', 'You entered your current password. In order to change the password, please write a different password.');
        }
        else
        {
            $request->validate([
                'password'=>'required|min:6|max:50',
                'confirm_password'=>'required|min:6|max:50|same:password'
            ]);

            $user->password = Hash::make($request->password);

            $query =  $user->update();

            if ($query) {
                return redirect('settings')->with('success', 'Password has been changed.');
            } else {
                return back()->with('fail', 'Something went wrong.');
            }
        }
    }
}
