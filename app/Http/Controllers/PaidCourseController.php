<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PaidCourse;
use App\Models\Trainer;
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

    public function feedback(Request $request)
    {
        // return $request;
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $course = PaidCourse::find($request->paid_course_id);
        $course->student_feedback = $request->student_feedback;
        $course->course_rating = $request->course_rating;

        $query1 = $course->update();

        $trainer = Trainer::where('trainer_id', $course->trainer_id)->first();

        $specific_course = Course::where('course_id', $course->course_id)->first();
        $specific_course_paid = PaidCourse::where('course_id', $course->course_id)->where('course_rating', '!=', 0.0)->get();

        $specific_course->rating = $specific_course_paid->sum('course_rating') / $specific_course_paid->count('id');

        $courses = PaidCourse::where('trainer_id', $trainer->trainer_id)->where('course_rating', '!=', 0.0)->get();

        $trainer->rating = $courses->sum('course_rating') / ($courses->count('id'));

        $query2 = $trainer->update();
        $query3 = $specific_course->update();

        if ($query1 && $query2 && $query3) {
            return back()->with('success', 'You have provided the feedback.');
        } else {
            return back()->with('fail', 'something went wrong.');
        }
    }
}
