@extends('layout.users')

@section('usercontent')


    <link rel="stylesheet" href="/assets/css/signup.css">


    <div class="signup-form" style="width:70%">

        <form action="/course-video/store/{{ $course->course_id }}" method="post" enctype="multipart/form-data" style="color: #5298D2">
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


            <div class="text-center">
                <h3>Add Video for <i>"{{ $course->course_title }}"</i> Course</h3>
            </div>

            <div class="form-group">
                <label for="video-title">Video Title</label>
                <input type="text" class="form-control" name="video_title" value="{{ old('video_title') }}" required>
                <span class="text-danger">@error('video_title') {{ $message }} @enderror</span>
      </div>

            <div class="form-group">
                <label for="video_description">Video Description</label>
                <textarea type="text" class="form-control" name="video_description" rows="7"
                    value="{{ old('video_description') }}" required></textarea>
                <span class="text-danger">@error('video_description') {{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <label for="course-videos">Paste Video URL</label>
                <input type="url" class="form-control" name="video_url" value="{{ old('video_url') }}" placeholder="Copy & Paste YouTube, Vimeo, etc. video URL including https://" required>

                <span class="text-danger">@error('video_url') {{ $message }} @enderror</span>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" style="background-color: #5298D2; border: 0ch">Add
                    Video</button>
            </div>
        </form>

    </div>

@endsection
