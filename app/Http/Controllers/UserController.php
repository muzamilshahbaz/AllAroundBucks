<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Course;
use App\Models\EducationHistory;
use App\Models\EmployementHistory;
use App\Models\PaidCourse;
use App\Models\PaidProject;
use App\Models\Project;
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
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }


        $pageName = ' Dashboard';
        $title = $user->user_role . $pageName;
        if ($user->user_role == 'Seller') {
            $seller = Seller::where('user_id', $user->user_id)->first();
            $seller_projects = PaidProject::where('seller_id', $seller->seller_id)->get();

            $projects = PaidProject::where('seller_id', $seller->seller_id)->latest()->take(10)->get();


            return view('userprofile.sellerdashboard', $data, compact('title', 'pageName', 'seller', 'projects', 'seller_projects'));
        } elseif ($user->user_role == 'Trainer') {
            $trainer = Trainer::where('user_id', $user->user_id)->first();
            $courses = PaidCourse::where('trainer_id', $trainer->trainer_id)->get();
            $recent_courses = PaidCourse::where('trainer_id', $trainer->trainer_id)
                ->latest()->take(10)
                ->get();

            return view('userprofile.trainerdashboard', $data, compact('title', 'pageName', 'trainer', 'courses', 'recent_courses'));
        }
    }

    function hiredirect()
    {
        $allUser = User::all();
        $allSeller = Seller::join('users', 'users.user_id', '=', 'sellers.user_id')
            ->select(
                'sellers.*',
                'users.username',
                'users.profile_img',
                'users.name',
                'users.profession',
                'users.bio'
            )
            ->get();

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }


        $pageName = 'Hire Directly !!';
        $title = 'Hire Freelancer';

        return view('userprofile.hiredirect', $data, compact('title', 'pageName', 'allUser', 'allSeller'));
    }


    function profile()
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $employement_history = EmployementHistory::where('user_id', $user->user_id)->get();
        $education_history = EducationHistory::where('user_id', $user->user_id)->get();
        $title =  $user->name;
        $pageName = 'Profile';

        if ($user->user_role == 'Seller') {
            $seller = Seller::where('user_id', $user->user_id)->first();
            $projects = PaidProject::where('seller_id', $seller->seller_id)->get();

            return view('userprofile.sellerprofile', $data, compact('title', 'pageName', 'seller', 'projects', 'education_history', 'employement_history'));
        } elseif ($user->user_role == 'Buyer') {
            $buyer = Buyer::where('user_id', $user->user_id)->first();
            $projects = PaidProject::where('buyer_id', $buyer->buyer_id)
                ->where('status', 'completed')
                ->orWhere('status', 'awaiting for feedback')
                ->get();

            return view('userprofile.buyerprofile', $data, compact('title', 'pageName', 'buyer', 'projects', 'education_history', 'employement_history'));
        } elseif ($user->user_role == 'Trainer') {
            $trainer = Trainer::where('user_id', $user->user_id)->first();
            $courses = Course::where('trainer_id', $trainer->trainer_id)->get();
            $sold_courses = PaidCourse::where('trainer_id', $trainer->trainer_id)->get();
            return view('userprofile.trainerprofile', $data, compact('title', 'pageName', 'sold_courses', 'trainer', 'courses', 'education_history', 'employement_history'));
        } elseif ($user->user_role == 'Student') {
            $student = Student::where('user_id', $user->user_id)->first();
            $courses = PaidCourse::where('student_id', $student->student_id)->get();
            return view('userprofile.studentprofile', $data, compact('title', 'pageName', 'student', 'courses', 'education_history', 'employement_history'));
        }
    }


    function user($username)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $userProfile = User::where('username', $username)->first();
        if ($userProfile) {

            if ($userProfile->user_id == $user->user_id) {
                return redirect('profile');
            } else {
                $employement_history = EmployementHistory::where('user_id', $user->user_id)->get();
                $education_history = EducationHistory::where('user_id', $user->user_id)->get();
                if ($userProfile->user_role == 'Seller') {
                    $seller = Seller::where('user_id', $userProfile->user_id)->first();
                    $projects = PaidProject::where('seller_id', $seller->seller_id)->get();

                    $seller->increment('views');
                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.seller', $data, compact('title', 'projects', 'userProfile', 'pageName', 'seller', 'education_history', 'employement_history'));
                } elseif ($userProfile->user_role == 'Trainer') {
                    $trainer = Trainer::where('user_id', $userProfile->user_id)->first();
                    $trainer->increment('views');
                    $courses = Course::where('trainer_id', $trainer->trainer_id)->get();
                    $sold_courses = PaidCourse::where('trainer_id', $trainer->trainer_id)->get();
                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.trainer', $data, compact('title', 'userProfile', 'pageName', 'sold_courses', 'trainer', 'courses', 'education_history', 'employement_history'));
                } elseif ($userProfile->user_role == 'Buyer') {
                    $buyer = Buyer::where('user_id', $userProfile->user_id)->first();
                    // $buyer->increment('views');
                    $projects = PaidProject::where('buyer_id', $buyer->buyer_id)
                        ->where('status', 'completed')
                        ->orWhere('status', 'awaiting for feedback')
                        ->get();

                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.buyer', $data, compact('title', 'userProfile', 'pageName', 'buyer', 'projects', 'education_history', 'employement_history'));
                } elseif ($userProfile->user_role == 'Student') {
                    $student = Student::where('user_id', $userProfile->user_id)->first();
                    $courses = PaidCourse::where('student_id', $student->student_id)->get();
                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.student', $data, compact('title', 'userProfile', 'pageName', 'student', 'courses', 'education_history', 'employement_history'));
                }
            }
        } else {
            return back()->with('fail', 'No user exist against this username.');
        }
    }
    function seller($username)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $userProfile = User::where('username', $username)->first();
        if ($userProfile) {

            if ($userProfile->user_id == $user->user_id) {
                return redirect('profile');
            } else {
                $employement_history = EmployementHistory::where('user_id', $user->user_id)->get();
                $education_history = EducationHistory::where('user_id', $user->user_id)->get();

                $seller = Seller::where('user_id', $userProfile->user_id)->first();
                if ($seller) {
                    $projects = PaidProject::where('seller_id', $seller->seller_id)->get();

                    $seller->increment('views');
                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.seller', $data, compact('title', 'projects', 'userProfile', 'pageName', 'seller', 'education_history', 'employement_history'));
                } else {
                    return back()->with('fail', 'No seller exists against this username.');
                }
            }
        } else {
            return back()->with('fail', 'No user exists against this username.');
        }
    }

    function buyer($username)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $userProfile = User::where('username', $username)->first();
        if ($userProfile) {

            if ($userProfile->user_id == $user->user_id) {
                return redirect('profile');
            } else {
                $employement_history = EmployementHistory::where('user_id', $user->user_id)->get();
                $education_history = EducationHistory::where('user_id', $user->user_id)->get();

                $buyer = Buyer::where('user_id', $userProfile->user_id)->first();
                // $buyer->increment('views');
                if ($buyer) {
                    $projects = PaidProject::where('buyer_id', $buyer->buyer_id)
                        ->where('status', 'completed')
                        ->orWhere('status', 'awaiting for feedback')
                        ->get();

                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.buyer', $data, compact('title', 'userProfile', 'pageName', 'buyer', 'projects', 'education_history', 'employement_history'));
                } else {
                    return back()->with('fail', 'No buyer exists against this username.');
                }
            }
        } else {
            return back()->with('fail', 'No user exists against this username.');
        }
    }

    function trainer($username)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $userProfile = User::where('username', $username)->first();
        if ($userProfile) {

            if ($userProfile->user_id == $user->user_id) {
                return redirect('profile');
            } else {
                $employement_history = EmployementHistory::where('user_id', $user->user_id)->get();
                $education_history = EducationHistory::where('user_id', $user->user_id)->get();

                $trainer = Trainer::where('user_id', $userProfile->user_id)->first();
                if ($trainer) {
                    $trainer->increment('views');
                    $courses = Course::where('trainer_id', $trainer->trainer_id)->get();
                    $sold_courses = PaidCourse::where('trainer_id', $trainer->trainer_id)->get();
                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.trainer', $data, compact('title', 'userProfile', 'pageName', 'sold_courses', 'trainer', 'courses', 'education_history', 'employement_history'));
                } else {
                    return back()->with('fail', 'No trainer exists against this username.');
                }
            }
        } else {
            return back()->with('fail', 'No user exists against this username.');
        }
    }

    function student($username)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $userProfile = User::where('username', $username)->first();
        if ($userProfile) {

            if ($userProfile->user_id == $user->user_id) {
                return redirect('profile');
            } else {
                $employement_history = EmployementHistory::where('user_id', $user->user_id)->get();
                $education_history = EducationHistory::where('user_id', $user->user_id)->get();

                $student = Student::where('user_id', $userProfile->user_id)->first();
                if ($student) {
                    $courses = PaidCourse::where('student_id', $student->student_id)->get();
                    $title =  $userProfile->username . ' - ' . 'AllAroundBucks';
                    $pageName = $userProfile->name . ' Profile';
                    return view('profile.student', $data, compact('title', 'userProfile', 'pageName', 'student', 'courses', 'education_history', 'employement_history'));
                } else {
                    return back()->with('fail', 'No student exists against this username.');
                }
            }
        } else {
            return back()->with('fail', 'No user exists against this username.');
        }
    }

    function editprofile($user_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $user = User::find($user_id);
        $seller = Seller::where('user_id', $user->user_id)->first();
        $buyer = Buyer::where('user_id', $user->user_id)->first();
        $trainer = Trainer::where('user_id', $user->user_id)->first();
        $student = Student::where('user_id', $user->user_id)->first();
        $title =  'Edit Profile - ' . 'AllAroundBucks';
        $pageName = 'Update Profile';
        return view('userprofile.editprofile', $data, compact('title', 'user', 'pageName', 'seller', 'buyer', 'trainer', 'student'));
    }



    function courses()
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        if ($user->user_role == 'Student') {
            $pageName = 'Courses Marketplace !!';
            $title = 'Courses Marketplace';
            $allCourse = Course::where('trainer', '!=', $user->username)->get();
            return view('userprofile.courses', $data, compact('title', 'pageName', 'allCourse'));
        }

        if ($user->user_role == 'Trainer') {
            $trainer = Trainer::where('user_id', $user->user_id)->first();
            //$trainerUsername = $user->username;
            $trainerCourse = Course::where('trainer_id', $trainer->trainer_id)->get();
            $title =  $user->username . ' Courses';
            $pageName = 'Courses';
            return view('userprofile.courses', $data, compact('title', 'pageName', 'trainerCourse'));
        }
    }

    function updateprofile(Request $request, $id)
    {
        if (session()->has('LoggedUser')) {
            $users = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $users,
                'roles' =>  UserRole::all()
            ];
        }

        $user = User::find($request->user_id);
        $user->name = $request->name;

        $user->profession = $request->profession;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_img')) {
            $destination = 'assets/users/usersprofile/' . $user->profile_img;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $profileImage =  $request->file('profile_img');
            $profileImageName = $request->username . '.' . $profileImage->extension();
            $profileImage->move(public_path('assets\users\userprofile'), $profileImageName);
            $user->profile_img = $profileImageName;
        }

        $user->update();

        if ($user->user_role == 'Seller') {
            $seller_id = $id;
            $seller = Seller::find($seller_id);
            $seller->experience = $request->experience;
            $seller->hourly_rate = $request->hourly_rate;
            $seller->skills = $request->skills;
            $seller->update();
        } elseif ($user->user_role == 'Trainer') {
            $trainer_id = $id;
            $trainer = Trainer::find($trainer_id);
            $trainer->experience = $request->experience;
            $trainer->skills = $request->skills;
            $trainer->update();
        } elseif ($user->user_role == 'Buyer') {
            $buyer_id = $id;
            $buyer = Buyer::find($buyer_id);
            $buyer->organization = $request->organization;
            $buyer->update();
        } elseif ($user->user_role == 'Student') {
            $student_id = $id;
            $student = Student::find($student_id);
            $student->skills = $request->skills;
            $student->update();
        }

        return redirect('profile')->with('success', 'Your changes have been updated');
    }

    function inbox()
    {
        if (session()->has('LoggedUser')) {
            $users = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $users,
                'roles' =>  UserRole::all()
            ];
        }
        $pageName = 'Inbox';
        $title = 'Inbox';

        return view('inbox', $data, compact('title', 'pageName'));
    }

    public function earnings()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $pageName = ' Earnings';
        $title = $user->user_role . $pageName;
        if ($user->user_role == 'Seller') {
            $seller = Seller::where('user_id', $user->user_id)->first();
            $seller_projects = PaidProject::where('seller_id', $seller->seller_id)->get();
            $project = PaidProject::where('seller_id', $seller->seller_id);
            $projects = $project->latest()->take(10)->get();
            return view('userprofile.sellerearnings', $data, compact('title', 'pageName', 'seller', 'projects', 'seller_projects'));
        } elseif ($user->user_role == 'Trainer') {
            $trainer = Trainer::where('user_id', $user->user_id)->first();
            $courses = PaidCourse::where('trainer_id', $trainer->trainer_id)->orderBy('created_at', 'DESC')->get();
            return view('userprofile.trainerearnings', $data, compact('title', 'pageName', 'trainer', 'courses'));
        }
    }
}
