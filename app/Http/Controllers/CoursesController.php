<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Trainer;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseVideo;
use App\Models\Category;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{

    function addCourseForm()
    {
        if (session()->has('LoggedUser')) {
            $trainer = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $trainer,
                'roles' =>  UserRole::all()
            ];
        }

        $title =  'Add New Course';
        $pageName = 'Add New Course';

        $catData = Category::all();
        return view('userprofile.addCourseForm', $data, compact('title','pageName','catData'));
    }

    public function addCourse(Request $request)
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $request->validate([
            'course_title'=>'required',
            'course_category'=>'required',
            'course_description'=>'required',
            'course_duration'=>'required|min:1',
            'course_price'=>'required|min:1',
            'course_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $trainer = Trainer::where('user_id',$user->user_id)->first();
        $courseImage =  $request->file('course_img');

        $courseImageName = $request->course_title.'.'.$courseImage->extension();
        $courseImage->move(public_path('assets\users\userprofile\courses'), $courseImageName);

        $course = new Course;

        $course->course_title = $request->course_title;
        $course->trainer_id = $trainer->trainer_id;
        $course->trainer = $trainer->trainer_username;
        $course->category_id = $request->course_category;
        $category = Category::where('category_id', $request->course_category)->first();
        $course->course_category = $category->category_name;
        $course->course_description = $request->course_description;
        $course->course_duration  = $request->course_duration;
        $course->course_price = $request->course_price;
        $course->course_img = $courseImageName;

        $courseQuery = $course->save();

        if ($courseQuery) {
            return redirect('courses')->with('success','Your Course has been added');

        } else {
            return back()->with('fail','Something went wrong...Try Again');
        }

}

// function addVideo(Request $vidReq)
//     {
//         $vidReq->validate([
//             'video_title'=>'required',
//             'video_description'=>'required',
//             'video_name' => 'required|mimes:mp4,mov|max:20000',

//         ]);

//         $courseVideo =  $vidReq->file('video_name');

//     $courseVideoName = $vidReq->course_title.'-'.$vidReq->video_id.'.'.$courseVideo->extension();
//     $courseVideo->move(public_path('assets\users\userprofile\courses'), $courseVideoName);

//     $video = new CourseVideo;

//     $video->course_id = $vidReq->course_id;
//     $video->video_title = $vidReq->video_title;
//     $video->video_description = $vidReq->video_description;
//     $video->video_name = $courseVideoName;

//     $video->save();

//     //return redirect()->back();



//     }

    function coursedetails($course_id)
    {
        if (session()->has('LoggedUser')) {
            $trainer = User::where('user_id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $trainer,
                'roles' =>  UserRole::all()
            ];
        }

        $course = Course::find($course_id);

        // $courseCategory = Category::find($course->category_id)->first();

        $title =  $course->course_title;
        $pageName = $course->course_title;

        return view('userprofile.coursedetails', $data, compact('title','pageName','course'));
    }

}
