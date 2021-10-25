@extends('layout.users')

@section('usercontent')


    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="signup-form" style="width:90%">

        <form action="/update/{{ $course->course_id }}" method="POST" enctype="multipart/form-data"
            style="color:#0f1137 !important">

            @csrf
            @method('PUT')

            <input type="hidden" name="course_id" value="{{ $course->course_id }}">
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
            <h3>Update Course</h3>

            <br>

            <div class="row">


                <div class="col-8">
                    <div class="form-group">
                        <label for="course-title">Course Title</label> <br>
                        <input type="text" class="form-control" name="course_title" value="{{ $course->course_title }}"
                            required>
                        <span class="text-danger">@error('course_title') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="col-4">

                    <div class="form-group">
                        <label for="course-category">Course Category</label>
                        <select id="course-category" class="form-control" name="course_category"
                            style="border:1px solid #5298D2" value="{{ $course->category_id }}" required>
                            {{-- <span class="text-danger">@error('course_category') {{ $message }} @enderror</span> --}}
                            <option value="{{ $course->category_id }}">{{ $course->course_category }}</option>

                            @foreach ($catData as $categories)

                                <option value="{{ $categories->category_id }}">{{ $categories->category_name }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">


                        <label for="course-description">Course Description</label>
                        <textarea type="text" class="form-control" rows="5" name="course_description"
                            value="{{ $course->course_description }}"
                            required>{{ $course->course_description }}</textarea>
                        <span class="text-danger">@error('course_description') {{ $message }} @enderror</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label for="course-duration">Course Duration (write in minutes)</label>
                        <input type="number" class="form-control" name="course_duration"
                            value="{{ $course->course_duration }}" required>
                        <span class="text-danger">@error('course_duration') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-4">
                        <label for="course-price">Course Price (write in dollars $)</label>
                        <input type="number" class="form-control" name="course_price"
                            value="{{ $course->course_price }}" required>
                        <span class="text-danger">@error('course_price') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="course-picture">Change Course Cover Picture</label>
                            <input type="file" class="form-control" name="course_img" value="{{ $course->course_img }}"
                                onchange="previewFile(this)">
                            <br>
                            <img src="/assets/users/userprofile/courses/{{ $course->course_img }}" height="100"
                                width="180" id="previewImg" style="border-radius: 0.5em">
                            {{-- <img src="\assets\users\userprofile\courses\default course thumbnail.jpg" id="previewImg"
                                alt="profile-image" style="width: 640px; height: 480px; margin-top: 20px;"> --}}
                            <span class="text-danger">@error('course_img') {{ $message }} Valid Dimensions: width: 1280px, height: 720px.@enderror</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">Update
                    Course</button>
            </div>
    </div>
    </form>

    </div>





@endsection
