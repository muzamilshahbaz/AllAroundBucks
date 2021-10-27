@extends('layout.users')

@section('usercontent')


    <div class="card" style="padding: 5px; border-radius:0.5em; border:none;">
        <div class="card-body">

            <div class="card-title">
                <h2 style="color: #0f1137; font-weight:bold">{{ $course_video->video_title }}</h2>

            </div>


            <div class="card-subtitle">
                <b>Course:</b> <a
                    href="/coursedetails/{{ $course_video->course_id }}">{{ $course_video->course_title }}</a>
            </div>

            <div class="row">
                <div class="col-8">
                    <x-embed url="{{ $course_video->video_url }}" />
                    {{-- <br>
                    <div class="text-center">
                        @if ($course_videos->count('id') > $course_video->id)
                            @if ($course_video->id > 1)
                                @php
                                    $previous_id = $course_video->id;
                                    $id = $previous_id - 1;
                                @endphp
                                <a href="/course-video/watch/{{ $id }}" class="btn btn-warning btn-sm mr-3"
                                    style="border-radius:0.5em;"><i class="fas fa-arrow-alt-circle-left"></i> Previous
                                    Video</a>
                            @else
                                <button class="btn btn-secondary btn-sm mr-3" style="border-radius:0.5em"
                                    disabled="disabled"><i class="fas fa-arrow-alt-circle-left"></i>
                                    Previous Video</button>
                            @endif
                            @php
                                $next_id = $course_video->id;
                                $id = $next_id + 1;
                            @endphp
                            <a href="/course-video/watch/{{ $id }}" class="btn btn-primary btn-sm mr-3"
                                style=" border-radius:0.5em">Next Video <i class="fas fa-arrow-alt-circle-right"></i></a>

                        @else
                            @if ($course_video->id > 1)
                                @php
                                    $previous_id = $course_video->id;
                                    $id = $previous_id - 1;
                                @endphp
                                <a href="/course-video/watch/{{ $id }}" class="btn btn-warning btn-sm mr-3"
                                    style="border-radius:0.5em;"><i class="fas fa-arrow-alt-circle-left"></i> Previous
                                    Video</a>
                            @else
                                <button class="btn btn-secondary btn-sm mr-3" style="border-radius:0.5em"
                                    disabled="disabled"><i class="fas fa-arrow-alt-circle-left"></i>
                                    Previous Video</button>
                            @endif

                            <button class="btn btn-secondary btn-sm mr-3" style="border-radius:0.5em"
                                disabled="disabled">Next Video <i class="fas fa-arrow-alt-circle-right"></i></button>
                        @endif
                    </div>
                    <br> --}}
                </div>
                <div class="col-4">
                    <h4 style="font-style:bolder"><b>Course Playlist:</b>
                        @if ($LoggedUserInfo->user_role == 'Trainer')
                            <span class="offset-1"> <a href="/course-video/create/{{ $course_video->course_id }}"
                                    class="btn btn-primary btn-sm mr-3"
                                    id="submit-btn">Add Video</a></span>
                        @endif
                    </h4>
                    <ol style="overflow-y:scroll; height:300px; padding:3px">
                        @forelse ($course_videos as $video)
                            {{-- @if ($video->id != $course_video->id) --}}

                            <a href="/course-video/watch/{{ $video->id }}"
                                style="text-decoration:none; ">
                               <div class="card" style="color: #0f1137; border-radius: 0.5em; text-align:left;">
                                   <div class="card-body">
                                    <li style="padding: 8px;">
                                           <span style="color:#0f1137"> {{ $video->video_title }}</span>

                                    </li>
                                   </div>
                               </div>
                            </a>
                            {{-- @endif --}}

                        @empty
                            <div class="text-center">
                                <h4>There is no further videos.</h4>
                                <a href="/course-video/create/{{ $course->course_id }}" class="btn btn-primary mr-3"
                                    id="submit-btn">Add Video</a>
                            </div>
                        @endforelse
                    </ol>
                    @if ($LoggedUserInfo->user_role == 'Trainer')

                        <div class="text-center">
                            <a href="/course-video/edit/{{ $course_video->id }}" class="btn btn-primary mr-3"
                                id="submit-btn">Edit</a>
                            <a href="/course-video/delete/{{ $course_video->id }}" class="btn btn-danger"
                                style="border-radius:0.5em">Delete</a>
                        </div>
                    @endif



                </div>
            </div>



            <div class="row my-4">
                <div class="col-12">
                    <h4><b>Video Description:</b></h4>
                    <p>{{ $course_video->video_description }}</p>
                </div>
            </div>











        </div>
    </div>

@endsection
