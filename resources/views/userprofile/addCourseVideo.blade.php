@extends('layout.users')

@section('usercontent')




<div class="signup-form" >

    <form action="addVideo" method="post" enctype="multipart/form-data">
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


<center><h3>Add Videos for this Course</h3></center>

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
        </form>

</div>

@endsection
