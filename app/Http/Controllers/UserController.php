<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Course;
use App\Models\PaidProject;
use App\Models\Seller;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\UserRole;
use Illuminate\Support\Facades\File;

//use Illuminate\View\Component;

class UserController extends Controller
{

    function dashboard()
    {
        $allUser = User::all();

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }


            $pageName = ' Dashboard';
            $title = $user -> user_role.$pageName;
            if($user->user_role == 'Seller')
            {
                $seller = Seller::where('user_id', $user->user_id)->first();
                $project = PaidProject::where('seller_id', $seller->seller_id);
                $projects = $project->latest()->take(10)->get();
                return view('userprofile.sellerdashboard', $data, compact('title','pageName','seller', 'projects'));

            }
            elseif($user->user_role == 'Trainer')
            {
                $trainer = Trainer::where('user_id', $user->user_id)->first();
                return view('userprofile.trainerdashboard', $data, compact('title','pageName','trainer'));

            }
    }

        function hiredirect()
        {
            $allUser = User::all();
            $allSeller = Seller::all();

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

            $pageName = 'Hire Directly !!';
            $title = 'Hire Freelancer';

            return view('userprofile.hiredirect', $data, compact('title','pageName', 'allUser','allSeller'));

        }


    function profile()
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $title =  $user->name;
        $pageName = 'Profile';

        if ($user->user_role == 'Seller')
        {
            $seller = Seller::where('user_id',$user->user_id)->first();
            return view('userprofile.sellerprofile', $data, compact('title','pageName','seller'));

        }

        elseif ($user->user_role == 'Buyer')
        {
            $buyer = Buyer::where('user_id',$user->user_id)->first();
            return view('userprofile.buyerprofile', $data, compact('title','pageName','buyer'));

        }

        elseif ($user->user_role == 'Trainer')
        {
            $trainer = Trainer::where('user_id',$user->user_id)->first();
            return view('userprofile.trainerprofile', $data, compact('title','pageName','trainer'));

        }

        elseif ($user->user_role == 'Student')
        {
            $student = Student::where('user_id',$user->user_id)->first();
            return view('userprofile.studentprofile', $data, compact('title','pageName','student'));

        }


    }


    function user($username)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $userProfile = User::where('username',$username)->first();
       if ($userProfile->user_id == $user->user_id) {
           return redirect('profile');
       } else {

        if ($userProfile->user_role == 'Seller') {
            $seller = Seller::where('user_id', $userProfile->user_id)->first();
            $seller->increment('views');
            $title =  $userProfile->username.' - '.'AllAroundBucks';
            $pageName = $userProfile->name.' Profile';
            return view('profile', $data, compact('title','userProfile', 'pageName', 'seller'));

        }
        elseif ($userProfile->user_role == 'Trainer') {
            $trainer = Trainer::where('user_id', $userProfile->user_id)->first();
            $trainer->increment('views');
            $title =  $userProfile->username.' - '.'AllAroundBucks';
            $pageName = $userProfile->name.' Profile';
            return view('profile', $data, compact('title','userProfile', 'pageName', 'trainer'));

        }
        elseif ($userProfile->user_role == 'Buyer') {
            $buyer = Buyer::where('user_id', $userProfile->user_id)->first();
            $title =  $userProfile->username.' - '.'AllAroundBucks';
            $pageName = $userProfile->name.' Profile';
            return view('profile', $data, compact('title','userProfile', 'pageName','buyer'));
        }
      }

    }

    function editprofile($user_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $user = User::find($user_id);
        $seller = Seller::where('user_id',$user->user_id)->first();
        $buyer = Buyer::where('user_id',$user->user_id)->first();
        $trainer = Trainer::where('user_id',$user->user_id)->first();
        $student = Student::where('user_id',$user->user_id)->first();
        $title =  'Edit Profile - '.'AllAroundBucks';
        $pageName = 'Update Profile';
        return view('userprofile.editprofile', $data, compact('title','user', 'pageName','seller','buyer','trainer','student'));

    }



    function courses()
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

       if($user->user_role == 'Student')
       {
        $pageName = 'Courses Marketplace !!';
        $title = 'Courses Marketplace';
        $allCourse = Course::all();
        return view('userprofile.courses', $data, compact('title','pageName', 'allCourse'));

       }

        if ($user->user_role == 'Trainer')
        {
            $trainer = Trainer::where('user_id',$user->user_id)->first();
            //$trainerUsername = $user->username;
            $trainerCourse = Course::where('trainer_id',$trainer->trainer_id)->get();
            $title =  $user->username.' Courses';
            $pageName = 'Courses';
            return view('userprofile.courses', $data, compact('title','pageName','trainerCourse'));
        }

    }

    function updateprofile(Request $request, $id)
    {
        if (session()->has('LoggedUser')) {
            $users = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $users,
                'roles' =>  UserRole::all()
            ];
        }

        $user = User::find($request->user_id);
        $user->name = $request->name;

        $user->profession = $request->profession;
        $user->bio = $request->bio;

       if($request->hasFile('profile_img'))
       {
           $destination = 'assets/users/usersprofile/'.$user->profile_img;
           if(File::exists($destination))
           {
               File::delete($destination);
           }
           $profileImage =  $request->file('profile_img');
           $profileImageName = $request->username.'.'.$profileImage->extension();
           $profileImage->move(public_path('assets\users\userprofile'), $profileImageName);
           $user->profile_img =$profileImageName;
       }

        $user->update();

        if($user->user_role == 'Seller')
        {
            $seller_id = $id;
            $seller = Seller::find($seller_id);
            $seller->experience = $request->experience;
            $seller->hourly_rate = $request->hourly_rate;
            $seller->skills = $request->skills;
            $seller->update();
        }
        elseif($user->user_role == 'Trainer')
        {
            $trainer_id = $id;
            $trainer = Trainer::find($trainer_id);
            $trainer->experience = $request->experience;
            $trainer->work_experience = $request->work_experience;
            $trainer->update();
        }

        return redirect('profile')->with('success', 'Your changes have been updated');

    }

    function inbox()
    {
        if (session()->has('LoggedUser')) {
            $users = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $users,
                'roles' =>  UserRole::all()
            ];
        }
        $pageName = 'Inbox';
        $title = 'Inbox';

        return view('inbox', $data, compact('title', 'pageName'));
    }

    function settings()
    {
        if (session()->has('LoggedUser')) {
            $users = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $users,
                'roles' =>  UserRole::all()
            ];
        }
        $pageName = 'Settings';
        $title = 'Settings';

        return view('userprofile.settings', $data, compact('title', 'pageName'));
    }

    function changeRole(Request $request)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $user->user_role = $request->user_role;

        $user->update();


        if($user->user_role == 'Seller')
        {
           $exist = Seller::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('dashboard')->with('success', 'Now you are using AllAroundBucks as a Seller.');
            }
           else {
            $seller = new Seller;

            $seller->user_id = $user->user_id;
             $seller->seller_username = $user->username;

             $query = $seller->save();
           }
        }

        elseif ($user->user_role == 'Buyer') {
            $exist = Buyer::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('hiredirect')->with('success', 'Now you are using AllAroundBucks as a Buyer.');
            }
           else {
            $buyer = new Buyer;
            $buyer->user_id = $user->user_id;
            $buyer->buyer_username = $user->username;

            $query = $buyer->save();
           }

        }

        elseif ($user->user_role == 'Trainer') {
            $exist = Trainer::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('dashboard')->with('success', 'Now you are using AllAroundBucks as a Trainer.');
            }
           else {
            $trainer = new Trainer;
            $trainer->user_id = $user->user_id;
            $trainer->trainer_username = $user->username;

            $query = $trainer->save();
           }

        }

        elseif ($user->user_role == 'Student') {
            $exist = Student::where('user_id', $user->user_id)->first();

            if ($exist) {
                return redirect('courses')->with('success', 'Now you are using AllAroundBucks as a Student.');
            }
           else {
            $student = new Student;
            $student->user_id = $user->user_id;
            $student->student_username = $user->username;

            $query = $student->save();
           }
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
