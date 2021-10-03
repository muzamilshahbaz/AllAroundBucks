<?php

namespace App\Http\Controllers;

use App\Models\PaidCourse;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class PaidCourseController extends Controller
{
    public function student_courses()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $pageName = ' Purchased Courses';
        $title = 'Your Purchased Courses';
        $courses = PaidCourse::where('paid_courses.student_username', $user->username)
                            ->join('courses', 'courses.course_id','=','paid_courses.course_id')
                            ->select('paid_courses.*', 'courses.course_img', 'courses.rating')
                            ->get();

        return view('userprofile.student-courses', $data, compact('title', 'pageName', 'courses'));
    }
}
