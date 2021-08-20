@extends('layout.users')

@section('usercontent')

<div class="col-12 display-4" style="font-weight: bolder">{{ $course->course_title }}</div>
<div class="col-lg-6"><b>Category:</b> {{ $courseCategory->category_name }}</div><br>
<img src="/assets/users/userprofile/courses/{{ $course->course_img }}" width="720px"><br><br>

<h3 class="col-12">Course Description</h3>
<br>
<div class="col-12">{{ $course->course_description }}</div><br>
<div class="col-12"><h3>Course Duration:</h3> {{ $course->course_duration }} hours</div><br>
<div class="col-12"><h3>Course Price: </h3> ${{ $course->course_price }} USD</div><br>

<center>
    <div class="col-8">

        <a href="#" class="btn btn-primary" style="background-color: tomato">Buy Course</a>

    </div>
</center>

@endsection
