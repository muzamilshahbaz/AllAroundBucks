<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseVideo;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseVideoController extends Controller
{
    public function create($course_id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $course = Course::find($course_id);

        $title =  'Add New Course Video';
        $pageName = 'Add New Course Video';

        return view('userprofile.addCourseVideo', $data, compact('title', 'pageName', 'course'));
    }

    public function store(Request $request, $course_id)
    {
        $request->validate([
            'video_title' => 'required|string|max:150',
            'video_description' => 'required|string|max:1000',
            'video_url' => 'required|url',
        ]);

        $course = Course::find($course_id);

        $course_video = new CourseVideo;

        $course_video->course_id = $course->course_id;
        $course_video->trainer_id = $course->trainer_id;
        $course_video->video_title = $request->video_title;
        $course_video->video_description = $request->video_description;
        $course_video->video_url = $request->video_url;

        $query = $course_video->save();

        if ($query) {
            return back()->with('success', 'Your Course Video has been added');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }

    public function watch($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $course_video = DB::table('course_videos')->where('course_videos.id', $id)
            ->join('courses', 'courses.course_id', '=', 'course_videos.course_id')
            ->select('course_videos.*', 'courses.course_title')
            ->first();
        $title =  $course_video->video_title;
        $pageName = ' Course Video';

        // $next = CourseVideo::where('course_id', $course_video->course_id);
        $course_videos = CourseVideo::where('course_id', $course_video->course_id)->get();


        return view('userprofile.course-video', $data, compact('title', 'pageName', 'course_video', 'course_videos'));
    }
    public function edit($id)
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $course_video = CourseVideo::find($id);

        $title =  'Update Course Video';
        $pageName = 'Update Video';

        return view('userprofile.edit-video', $data, compact('title', 'pageName', 'course_video'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'video_title' => 'required|string|max:150',
            'video_description' => 'required|string|max:1000',
            'video_url' => 'required|url',
        ]);


        $course_video = CourseVideo::find($id);


        $course_video->video_title = $request->video_title;
        $course_video->video_description = $request->video_description;
        $course_video->video_url = $request->video_url;

        $query = $course_video->update();

        if ($query) {
            return back()->with('success','Your Course Video has been updated');

        } else {
            return back()->with('fail','Something went wrong...Try Again');
        }

    }
    public function delete($id)
    {
        $query = CourseVideo::find($id)->delete();
        if ($query) {
            return redirect('courses')->with('success', 'Your Course Video has been added');
        } else {
            return back()->with('fail', 'Something went wrong...Try Again');
        }
    }
}
