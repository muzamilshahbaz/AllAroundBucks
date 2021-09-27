@extends('layout.users')

@section('usercontent')


<link rel="stylesheet" href="/assets/css/signup.css">
    <div class="signup-form" style="width:90%">

        <form action="/addCourse" method="POST" enctype="multipart/form-data" style="color:#5298D2 !important">

            @csrf


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
            <h3>Add New Course in Your Collection</h3>

            <br>

            <div class="row">


                <div class="col-8">
                    <div class="form-group">
                        <label for="course-title">Course Title</label> <br>
                        <input type="text" class="form-control" name="course_title" value="{{ old('course_title') }}"
                            required>
                        <span class="text-danger">@error('course_title') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="col-4">

                    <div class="form-group">
                        <label for="course-category">Course Category</label>
                        <select id="course-category" class="form-control" name="course_category" style="border:1px solid #5298D2"
                            value="{{ old('course_category') }}" required>
                            {{-- <span class="text-danger">@error('course_category') {{ $message }} @enderror</span> --}}
                            <option>Select Course Category</option>

                            @foreach ($catData as $categories)

                                <option value="{{ $categories->category_id }}">{{ $categories->category_name }}</option>

                            @endforeach

                        </select>
                    </div>

                </div>

            </div>

      <div class="row">
        <div class="col-12">
            <div class="form-group">


                    <label for="course-description">Course Description</label>
                    <textarea type="text" class="form-control"  rows="5" name="course_description"
                         value="{{ old('course_description') }}" required></textarea>
                    <span class="text-danger">@error('course_description') {{ $message }} @enderror</span>
                </div>
            </div>
      </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label for="course-duration">Course Duration (write in minutes)</label>
                        <input type="number" class="form-control" name="course_duration"
                            value="{{ old('course_duration') }}" required>
                        <span class="text-danger">@error('course_duration') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-4">
                        <label for="course-price">Course Price (write in dollars $)</label>
                        <input type="number" class="form-control" name="course_price"
                             value="{{ old('course_price') }}" required>
                        <span class="text-danger">@error('course_price') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="course-picture">Add Course Cover Picture</label>
                            <input type="file" class="form-control" name="course_img" value="{{ old('course_img') }}"
                               {{--  onchange="previewFile(this)" --}} required>
                            {{-- <img src="\assets\users\userprofile\courses\default course thumbnail.jpg" id="previewImg"
                                alt="profile-image" style="width: 640px; height: 480px; margin-top: 20px;"> --}}
                            <span class="text-danger">@error('course_img') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
            </div>



            {{-- <center><h3>Add Videos for this Course</h3></center>
        <form action="addVideo" method="post">
            @csrf
            <div class="form-group">
                <label for="video-title">Video Title</label>
                <input type="text" class="form-control" name="video_title" value="{{ old('video_title') }}" style="border: 2px solid tomato">
                <span class="text-danger">@error('video_title') {{ $message }} @enderror</span>
            </div>
            <br>
            <div class="form-group">
                <label for="video_description">Video Description</label>
                <textarea type="text" class="form-control" name="video_description" style="height:200px; border: 2px solid tomato" value="{{ old('video_description') }}"></textarea>
                <span class="text-danger">@error('video_description') {{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <label for="course-videos">Upload Video</label>
                <input type="file" class="form-control" name="course_videos" value="{{ old('course_videos') }}" onchange="previewFile(this)">

                <span class="text-danger">@error('profile_img') {{ $message }} @enderror</span>
            </div>
            <button  type="submit" class="btn btn-primary" style="background-color: tomato; border: 0ch">Add Video</button>
        </form> --}}


            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg" style="background-color: #5298D2; border: 0ch">Add
                    Course</button>
            </div>
    </div>
    </form>

    </div>





@endsection
