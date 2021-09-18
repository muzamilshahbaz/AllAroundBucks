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

<div class="row">

    @foreach ($allCourse as $course)



        <div class="col-lg-4">
           <a href="coursedetails/{{ $course->course_id}}">
            <div class="card"  style="height: 20rem;">

                <img  class="card-img-top" src="/assets/users/userprofile/courses/{{ $course->course_img }}"  width="100%">
                <div class="card-body">
                    <div class="card-title">
                        <h3>{{ $course->course_title }}</h3>
                    </div>

                    <div class="card-subtitle">
                        <span>by {{  $course->trainer }}</span>
                        <h3 style="text-align: right; color:tomato">Price: ${{ $course -> course_price }}</h2>

                    </div>

                </div>
            </div>
           </a>
        </div>




    @endforeach

</div>

@endif

@if ($LoggedUserInfo -> user_role == 'Trainer')

<div class="col-lg-12">

    <a href="addCourseForm" class="btn btn-primary" style="background-color: tomato">Add New Course</a>

</div>

<br>


@if ($trainerCourse->isEmpty())
    <span>You have not added any course in your collection. Click on Add New Course to teach and earn.</span>
@else
<div class="col-12">
    <h1>Following is the list of your added courses.</h1>
</div>
<br>
<div class="row">
    @foreach ($trainerCourse as $course)

<div class="col-lg-4">
    <a href="coursedetails/{{ $course->course_id}}">
     <div class="card" style="height: 20rem;">
         <img class="card-img-top" src="\assets\users\userprofile\courses\{{ $course->course_img }}"  width="100%">
         <div class="card-body">
             <div class="card-title">
                 <h3>{{ $course->course_title }}</h3>
             </div>

             <div class="card-subtitle">

                 <div class="row">
                    <div class="col-8 offset-4">
                        <h3 style="text-align: right; color:tomato">Price: ${{ $course -> course_price }}</h2>
                     </div>
                     <div class="col-12">
                        @include('userprofile.courserating')
                     </div>

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
