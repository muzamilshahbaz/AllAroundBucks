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
    @include('profile.profile-buttons')
    <div class="container emp-profile" style="color: black">

        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    @if ($userProfile->profile_img == null)
                        <img src="/assets/users/userprofile/defaultprofilepic.png" alt="user-img" width="36" height="36"
                            class="img-circle" style="border-radius: 50%">
                    @else
                        <img src="/assets/users/userprofile/{{ $userProfile->profile_img }}" alt="user-img" width="36"
                            height="36" class="img-circle" style="border-radius: 50%">

                    @endif
                </div>
                @include('profile.contact-me-button')
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h3 style="font-weight: bold">
                        {{ $userProfile->name }}
                    </h3>
                    <h6>
                        {{ $userProfile->profession }}
                    </h6>
                    <span class="proile-rating">

                        @include('ratings.trainerrating')

                    </span>
                    <br><br>
                    <div class="flex-box">
                        <h4>About</h4>
                        <p>{{ $userProfile->bio }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary" style=" border-radius: 1em" disabled>Trainer Profile</button>
            </div>

        </div>
        <br>
        <div class="row" style="font-size: 17px; border: 1px solid black; padding: 10px">

            <div class="col-4">
                <span style="font-weight: bold">Total Courses: </span><span>{{ $courses->count('course_id') }}</span>
            </div>
            {{-- <div class="col-3">
                <span style="font-weight: bold">Sold Courses: </span><span>{{ $trainer->courses_sell }}</span>
            </div> --}}
            <div class="col-4">
                <span style="font-weight: bold">Total Sales: </span><span>{{ $sold_courses->count('id') }}</span>
            </div>
            <div class="col-4">
                <span style="font-weight: bold">Experience: </span><span>{{ $trainer->experience }}</span>
            </div>

        </div>

        @include('profile.education-history')
        @include('profile.employement-history')

        <div class="row" style="border: 1px solid black; padding: 10px">

            <div class="col-12">
                <span style="font-weight: bold; font-size: 17px;">Courses : </span> <br><br>
                <div class="row">

                    @forelse ($courses as $course)



                        <div class="col-4">
                            <a id="course-search-result" href="/coursedetails/{{ $course->course_id }}">
                                <div class="card"
                                    style="width:100%; height:auto; padding: 5px; border-radius:0.5em; border:none;">
                                    <div class="card-img-top">
                                        <img src="/assets/users/userprofile/courses/{{ $course->course_img }}"
                                            width="100%">
                                    </div>

                                    <div class="card-body" style="padding: 10px">
                                        <div class="card-title">
                                            <h5>{{ $course->course_title }}</h5>
                                        </div>

                                        <div class="card-subtitle">
                                            <span>by {{ $course->trainer }}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <span
                                                    style="font-size:0.9em !important">@include('userprofile.courserating')</span>
                                            </div>
                                            <div class="col-5">
                                                <span
                                                    style="font-size:0.9em !important; text-align: right; color:#5298D2">Price:
                                                    ${{ $course->course_price }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>


                    @empty
                    <div class="col-12">
                        <div class="card"
                        style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">

                        <div class="card-body">

                            <div class="text-center">
                                <h4>This Trainer has not added any courses yet.</h4>
                            </div>

                        </div>
                    </div>
                    </div>

                    @endforelse

                </div>
            </div>

        </div>

        <div class="row" style="font-size: 17px; border: 1px solid black; padding: 10px">

            <div class="col-12">
                <span style="font-weight: bold; font-size: 17px;">Skills : </span> <br><br>
                <div class="card"
                    style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">
                    <div class="card-body">
                        @if ($trainer->skills == NULL)
                            <div class="text-center">
                                No skills has been added.
                            </div>
                        @else
                        {{ $trainer->skills }}
                        @endif
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection
