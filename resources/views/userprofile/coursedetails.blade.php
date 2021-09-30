@extends('layout.users')

@section('usercontent')


    <div class="card" style="padding: 5px; border-radius:0.5em; border:none;">
        <div class="card-body">
            <div class="card-title">
                <h2 style="color: #5298D2; font-weight:bold">{{ $course->course_title }}</h2>
            </div>
            <div class="card-subtitle">
                <b>Category:</b> {{ $course->course_category }}
            </div>
            <div class="row">
                <div class="card-img col-8">
                    <img src="/assets/users/userprofile/courses/{{ $course->course_img }}" width="600px"
                        style="border-radius:0.5em;">
                </div>
                <div class="col-4">
                    <h4><b>Course Duration:</b> {{ $course->course_duration }} minutes</h4>
                    <div class="row">
                        <div class="col-12">
                            <h4><b>Course Price:</b> ${{ $course->course_price }} USD</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4><b>Total Videos:</b> {{ $course_videos->count('id') }}</h4>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-12">
                            @if ($LoggedUserInfo->user_role == 'Student')
                                <a href="#" class="btn btn-primary"
                                    style="background-color: #5298D2; border-radius:0.5em">Buy Course</a>
                            @else

                                <a href="/edit-course/{{ $course->course_id }}" class="btn btn-primary mr-3"
                                    style="background-color: #5298D2; border-radius:0.5em">Edit</a>
                                <a href="/delete-course/{{ $course->course_id }}" class="btn btn-danger"
                                    style="border-radius:0.5em">Delete</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="row my-4">
                <div class="col-12">
                    <h4><b>Course Description:</b></h4>
                    <p>{{ $course->course_description }}</p>
                </div>
            </div>
            @if ($LoggedUserInfo->user_role == 'Trainer')
                <div class="row my-4">
                    <div class="col-12">
                        <h4><b>Course Videos:</b><span class="offset-7"> <a
                                    href="/course-video/create/{{ $course->course_id }}"
                                    class="btn btn-primary btn-sm mr-3"
                                    style="background-color: #5298D2; border-radius:0.5em">Add Video</a></span></h4>

                        <ol>
                            @forelse ($course_videos as $video)

                                <li><a href="/course-video/watch/{{ $video->id }}"
                                        style="color: #5298D2; text-decoration:none">{{ $video->video_title }}</a></li>

                            @empty
                            <br>
                                <div class="text-center">
                                    <h4 style="color: #5298D2; text-decoration:none">There is no video for this course.</h4>

                                </div>
                            @endforelse
                        </ol>
                    </div>
                </div>
            @endif



        </div>
    </div>

@endsection
