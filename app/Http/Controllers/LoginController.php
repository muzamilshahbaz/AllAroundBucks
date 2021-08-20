<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    function login(Request $request)
    {
       $request->validate([
            'login'=>'required',
            'password'=>'required'
        ]);


                $user = User::where('email','=', $request->login)->first();

            if ($user) {

                if (Hash::check($request->password, $user->password)) {

                    if($user->status == 'enable')
                    {
                        $request->session()->put('LoggedUser', $user->user_id);

                        if($user->user_role != NULL)
                        {

                            if($user->user_role == 'Seller' ||  $user->user_role == 'Trainer')
                            {
                             return redirect('dashboard');
                            }

                            elseif($user->user_role == 'Buyer')
                            {
                             return redirect('hiredirect');
                            }

                            elseif($user->user_role == 'Student')
                            {
                             return redirect('courses');
                            }
                        }
                        else
                        {
                            return redirect('roleName')->with('fail', 'To continue to working with AllAroundBucks, you must select the user role and username.');
                        }

                    } else{

                        return redirect('verifyaccount')->with('fail','Your Account is not Verified yet, check your mailbox to verify.');

                    }


                } else {
                    return back()->with('fail','Invalid Password');
                }



            } else {
                return back()->with('fail','No account found for this email.');
            }
    }


    protected function registeredOrLoginUser($data)
    {

        $user = User::where('email','=', $data->email)->first();
        if(!$user)
        {
            // $request->validate([
            //     'user_role'=>'required',
            //     'username'=>'required|alpha|min:8|max:16|unique:users',
            // ]);
            $user = new User;
            $user->name = $data->name;

            $user->provider_id = $data->id;

            $user->email = $data->email;
            $user->username = $data->email;

            $user->save();

        }


        session()->put('LoggedUser', $user->user_id);


    }



    function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    function handleGoogleCallBack()
    {
        $user = Socialite::driver('google')->user();

        $this->registeredOrLoginUser($user);

        //return redirect('roleName');
        $LogUser = User::where('user_id', '=', session('LoggedUser'))->first();
        if($LogUser->user_role != NULL)
        {

            if($LogUser->user_role == 'Seller' ||  $LogUser->user_role == 'Trainer')
            {
             return redirect('dashboard');
            }

            elseif($LogUser->user_role == 'Buyer')
            {
             return redirect('hiredirect');
            }

            elseif($LogUser->user_role == 'Student')
            {
             return redirect('courses');
            }
        }
        else
        {
            return redirect('roleName')->with('fail', 'To continue to working with AllAroundBucks, you must select the user role and username.');
        }



    }



}
