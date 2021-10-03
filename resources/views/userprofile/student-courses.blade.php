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



@if ($LoggedUserInfo->user_role == 'Student')
@if ($courses->isEmpty())
<div class="text-center">
    <h4>You have not purchased any course. Go to courses marketplace and start buying courses.</h4>
</div>
@else
<div class="row">

@foreach ($courses as $course)



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
                    by {{ $course->trainer_username }}
                </div>
                <div class="row">
                    <div class="col-7">
                        <span style="font-size:0.9em !important">@include('userprofile.courserating')</span>
                    </div>
                    <div class="col-5">
                        <span style="font-size:0.9em !important; text-align: right; color:#5298D2">Price: ${{ $course->price }}</span>
                    </div>
                </div>

            </div>
        </div>
       </a>
    </div>




@endforeach

</div>
@endif
@else
<div class="text-center">
    <h4>You are not allowed to access this page.</h4>
</div>
@endif


@endsection
