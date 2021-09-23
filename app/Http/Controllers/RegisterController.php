<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Seller;
use App\Models\Buyer;
use App\Models\Student;
use App\Models\Trainer;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\VerifyEmail;
use App\Models\UserRole;
use Softon\LaravelFaceDetect\Facades\FaceDetect;

class RegisterController extends Controller
{

    function register(Request $request)
    {
        $request->validate([

            'name'=>'required|regex:/^[\pL\s\-]+$/u',
            'email'=>'required|email|unique:users',
            // 'profile_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'password'=>'required|min:6|max:50',
            'confirm_password'=>'required|min:6|max:50|same:password',
            // 'checkbox'=>'required'
        ]);



        // $profileImage =  $request->file('profile_img');

        // $profileImageName = $request->email.'.'.$profileImage->extension();
        // $profileImage->move(public_path('assets\users\userprofile'), $profileImageName);

            $user = new User;
            $user->name = $request->name;

            $user->username = $request->email;
            $user->email = $request->email;
            // $user->profile_img = $profileImageName;
            $user->password = Hash::make($request->password);
            $verifyCode = rand (10000, 99999);
            $allUsers = User::all();

            foreach($allUsers as $allUser)
            {
                if($allUser->verify_code == $verifyCode)
                {
                    $verifyCode = rand (10000, 99999);
                }
            }


           $user->verify_code = $verifyCode;

            $query = $user->save();


            // $code = [
            //     'userID'=>$user->user_id,
            //     'vCode'=>$user->verify_code
            // ];
            // Mail::to($user->email)->send(new VerifyEmail($code));

            if ($query) {
                # code...
                return redirect('verifyaccount')->with('success','Check Your Email, paste the 5-digit code and verify your account. You will not be allowed to Login until you verify your email address.');
               // return back()->with('success','You have been successfully registered with AutumnBucks, Log in to continue with your account');

            } else {
                # code...
                return back()->with('fail','Something went wrong...Try Again');
            }

    }

    function verifyaccount()
    {
        // $user = User::find($user_id)->first();
        // $user->status = 'enable';
        $title = 'Verify Your Account ';
        return view('verifyaccount', compact('title'));

    }

    function verify(Request $request)
    {
        $users = User::all();
        foreach($users as $user)
        {
            if($user->verify_code == $request->verify_code)
            {
                $userStatus = User::where('verify_code',$request->verify_code)->first();
                $userStatus->status = 'enable';
                $userStatus->update();

                $request->session()->put('LoggedUser', $user->user_id);
                return redirect('roleName');

            }

        }
        return back()->with('fail','Wrong Verification Code');

    }

    function roleName()
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }

        $title = 'Select Role and Username';
        $pageName = 'Select Role and Username';
        $roles = UserRole::all();
        return view('pages.roleAndUsername' , $data, compact('title', 'pageName', 'roles'));

    }

    function roleAndUsername(Request $request, $user_id)
    {
       $user = User::find($user_id);

        $request->validate([
            'user_role'=>'required',
            'username'=>'required|alpha_num|min:8|max:16|unique:users'
        ]);

        $user->user_role = $request->user_role;
        $user->username = $request->username;

        $query = $user->update();

        if($user->user_role == 'Seller')
        {
            $seller = new Seller;

           $seller->user_id = $user->user_id;
            $seller->seller_username = $user->username;

            $seller->save();
        }

        elseif ($user->user_role == 'Buyer') {

            $buyer = new Buyer;
            $buyer->user_id = $user->user_id;
            $buyer->buyer_username = $user->username;

            $buyer->save();

        }

        elseif ($user->user_role == 'Trainer') {

            $trainer = new Trainer;
            $trainer->user_id = $user->user_id;
            $trainer->trainer_username = $user->username;

            $trainer->save();

        }

        elseif ($user->user_role == 'Student') {

            $student = new Student;
            $student->user_id = $user->user_id;
            $student->student_username = $user->username;

            $student->save();

        }

        if ($query) {
            # code...
            if($user->user_role == 'Seller' ||  $user->user_role == 'Trainer')
            {
             return redirect('dashboard')->with('success', 'Congratulations!! You have completed your registeration process, now you can continue with AllAroundBucks.');
            }

            elseif($user->user_role == 'Buyer')
            {
             return redirect('hiredirect')->with('success', 'Congratulations!! You have completed your registeration process, now you can continue with AllAroundBucks.');
            }

            elseif($user->user_role == 'Student')
            {
             return redirect('courses')->with('success', 'Congratulations!! You have completed your registeration process, now you can continue with AllAroundBucks.');
            }

        } else {
            # code...
            return back()->with('fail','Something went wrong...Try Again');
        }

    }


}
