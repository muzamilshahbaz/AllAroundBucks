@extends('layout.app')

@section('content')

<x-navbar>
</x->

<div class="container" id="tips" style="width: 100%">
    <div class="flex-box-tips" style="border-radius: 15px;">
        @if ($courses->isEmpty())
<div class="text-center">
    <h4>There are no courses against your search query.</h4>
</div>
@else
<div class="text-center">
    <h4>Following are the results against your course search query.</h4>
</div>
<br>


<div class="row">

    @foreach ($courses as $course)

        <div class="col-4">
           <a id="course-search-result" href="/signup">
            <div class="card" style="width:100%; height:auto; padding: 5px; border-radius:0.5em; border:none;">
                <div class="card-img-top">
                    <img src="/assets/users/userprofile/courses/{{ $course->course_img }}" width="100%">
                </div>

                <div class="card-body" style="padding: 10px">
                    <div class="card-title">
                        <h5>{{ $course->course_title }}</h5>
                    </div>

                    <div class="card-subtitle">
                        <span>by {{  $course->trainer }}</span>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <span style="font-size:0.9em !important">@include('userprofile.courserating')</span>
                        </div>
                        <div class="col-5">
                            <span style="font-size:0.9em !important; text-align: right; color:#0f1137">Price: ${{ $course->course_price }}</span>
                        </div>
                    </div>

                </div>
            </div>
           </a>
        </div>




    @endforeach

</div>

@endif
    </div>
</div>

<x-footer>
</x->

@endsection
