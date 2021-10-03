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

@if ($LoggedUserInfo -> user_role == 'Student')

@if ($allCourse->isEmpty())
    <div class="text-center">
        <h4>There is no course to show.</h4>
    </div>
@else
<div class="row">

    @foreach ($allCourse as $course)



        <div class="col-3">
           <a id="course-search-result" href="/coursedetails/{{ $course->course_id }}">
            <div class="card" style="width:100%; height:auto; padding: 5px; border-radius:0.5em; border:none;">
                <div class="card-img-top">
                    <img src="/assets/users/userprofile/courses/{{ $course->course_img }}" width="100%">
                </div>

                <div class="card-body" style="padding: 10px">
                    <div class="card-title display-4">
                        {{ $course->course_title }}
                    </div>

                    <div class="card-subtitle" style="font-size: 0.7rem">
                        by {{ $course->trainer }}
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <span style="font-size:0.9em !important">@include('userprofile.courserating')</span>
                        </div>
                        <div class="col-5">
                            <span style="font-size:0.9em !important; text-align: right; color:#5298D2">Price: ${{ $course->course_price }}</span>
                        </div>
                    </div>

                </div>
            </div>
           </a>
        </div>




    @endforeach

</div>
@endif


@endif

@if ($LoggedUserInfo -> user_role == 'Trainer')

<div class="col-lg-12">

    <a href="/addCourseForm" class="btn btn-primary" style="background-color:#5298D2; border-radius:0.5em">Add New Course</a>

</div>

<br>


@if ($trainerCourse->isEmpty())
    <div class="text-center">
        <h4>You have not added any course in your collection. Click on Add New Course to teach and earn.</h4>
    </div>
@else

<div class="row">

    @foreach ($trainerCourse as $course)



        <div class="col-3">
           <a id="course-search-result" href="/coursedetails/{{ $course->course_id }}">
            <div class="card" style="width:100%; height:auto; padding: 5px; border-radius:0.5em; border:none;">
                <div class="card-img-top">
                    <img src="/assets/users/userprofile/courses/{{ $course->course_img }}" width="100%" height="100%">
                </div>

                <div class="card-body" style="padding: 10px">
                    <div class="card-title display-4">
                        {{ $course->course_title }}
                    </div>

                    <div class="card-subtitle" style="font-size: 0.7rem">
                        by {{ $course->trainer }}
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <span style="font-size:0.9em !important">@include('userprofile.courserating')</span>
                        </div>
                        <div class="col-5">
                            <span style="font-size:0.9em !important; text-align: right; color:#5298D2">Price: ${{ $course->course_price }}</span>
                        </div>
                    </div>

                </div>
            </div>
           </a>
        </div>




    @endforeach

</div>
@endif

@endif



@endsection
