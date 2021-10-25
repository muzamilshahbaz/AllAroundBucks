@extends('layout.users')

@section('usercontent')

    <div class="results">
        @if (Session::get('success'))

            <div class="alert alert-success">
                {{ Session::get('success') }}

            </div>

        @endif

        @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>

        @endif
    </div>
    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="card" style="padding: 5px; border-radius:0.5em; border:none; color: #0f1137 !important;">
        <div class="card-body">
            <div class="card-title">
                <h2 style="color: #0f1137 !important; font-weight:bold">{{ $course->course_title }}</h2>
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
                    <h4 style="color: #0f1137 !important;"><b>Course Duration:</b> {{ $course->course_duration }} minutes
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <h4 style="color: #0f1137 !important;"><b>Course Price:</b> ${{ $course->course_price }} USD
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4 style="color: #0f1137 !important;"><b>Total Videos:</b> {{ $course_videos->count('id') }}
                            </h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            @if ($LoggedUserInfo->user_role == 'Student')
                                @if ($paid_course)
                                    @if ($first_video)
                                        <a href="/course-video/watch/{{ $first_video->id }}" class="btn btn-primary"
                                            id="submit-btn">Watch Videos</a>
                                        @if ($paid_course->student_feedback == null)
                                            <button onclick="coursePopup()" class="btn btn-primary" id="submit-btn">Give
                                                Feedback</a>
                                            @else
                                                <br><br>
                                                <div class="card" style="padding: 5px; border-radius:0.5em;">
                                                    <div class="card-body">
                                                        <div class="card-title text-center">
                                                            <h5 style="color: #0f1137">Your Feedback to this course</h5>
                                                        </div>
                                                        <div class="text-center">

                                                            <span>@include('ratings.paidcourserating')</span>
                                                            <p><i>"{{ $paid_course->student_feedback }}"</i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif

                                    @endif
                                @else
                                    <a href="/course-payment/{{ $course->course_id }}" class="btn btn-primary"
                                        id="submit-btn">Buy Course</a>
                                @endif
                            @elseif ($LoggedUserInfo->username == $course->trainer)

                                <a href="/edit-course/{{ $course->course_id }}" class="btn btn-primary mr-3"
                                    id="submit-btn">Edit</a>
                                <a href="/delete-course/{{ $course->course_id }}" class="btn btn-danger text-white"
                                    style="border-radius:0.5em">Delete</a>
                            @else
                                <div class="text-center">
                                    <h4 style="color: #0f1137">Change your role to student to buy this course.</h4>
                                </div>
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
            @if ($LoggedUserInfo->username == $course->trainer)
                <div class="row my-4">
                    <div class="col-12">
                        <h4><b>Course Videos:</b><span class="offset-7"> <a
                                    href="/course-video/create/{{ $course->course_id }}"
                                    class="btn btn-primary btn-sm mr-3" id="submit-btn">Add Video</a></span></h4>

                        <ol>
                            @forelse ($course_videos as $video)

                                <li><a href="/course-video/watch/{{ $video->id }}"
                                        >{{ $video->video_title }}</a></li>

                            @empty
                                <br>
                                <div class="text-center">
                                    <h4 style="color: #0f1137; text-decoration:none">There is no video for this course.</h4>

                                </div>
                            @endforelse
                        </ol>
                    </div>
                </div>
            @endif

            @if ($LoggedUserInfo->user_role == 'Student')
                @if ($paid_course)
                    <div class="row my-4">
                        <div class="col-12">
                            <h4><b>Course Videos:</b></h4>

                            <ol>
                                @forelse ($course_videos as $video)

                                    <li><a href="/course-video/watch/{{ $video->id }}"
                                            >{{ $video->video_title }}</a>
                                    </li>

                                @empty
                                    <br>
                                    <div class="text-center">
                                        <h4 style="color: #0f1137; text-decoration:none">There is no video for this course.
                                            Wait for the Trainer to add videos.
                                        </h4>

                                    </div>
                                @endforelse
                            </ol>
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </div>

@endsection
@if ($paid_course)
    <div class="popup" id="popup-3">
        <div class="overlay"></div>
        <div class="content" style="height:55%">
            <div class="close-btn" onclick="coursePopup()">×</div>
            <form action="/course-feedback" class="signup-form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="paid_course_id" value="{{ $paid_course->id }}" class="form-control">
                <h3>Rate this course</h3>

                <div class="form-group">
                    <textarea name="student_feedback" id="" cols="30" rows="6"
                        required>{{ old('student_feedback') }}</textarea>
                </div>

                <div class="form-group">

                    <select name="course_rating" class="form-control" id="" style="border:1px solid #5298D2">
                        {{-- <option value="0.0">0.0 star</option> --}}
                        <option value="0.5">0.5 star</option>
                        <option value="1.0">1.0 star</option>
                        <option value="1.5">1.5 star</option>
                        <option value="2.0">2.0 star</option>
                        <option value="2.5">2.5 star</option>
                        <option value="3.0">3.0 star</option>
                        <option value="3.5">3.5 star</option>
                        <option value="4.0">4.0 star</option>
                        <option value="4.5">4.5 star</option>
                        <option value="5.0">5.0 star</option>
                    </select>

                </div>


                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
                </div>

            </form>

        </div>
    </div>

@endif
