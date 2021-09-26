@extends('layout.users')

@section('usercontent')

    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="col-lg-12">

        <a href="/newProject" class="btn btn-primary" style="background-color: #5298D2">Add New Project</a>

    </div>
    <br>
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
    <br>

    <div class="tab" style="border: 1px solid #5298D2;">
        <button class="tablinks" onclick="openTab(event, 'All')">All</button>
        <button class="tablinks" onclick="openTab(event, 'Active')">Active</button>
        <button class="tablinks" onclick="openTab(event, 'Awaiting For Approval')">Awaiting For Approval</button>
        <button class="tablinks" onclick="openTab(event, 'Awaiting For Feedback')">Awaiting For Feedback</button>
        <button class="tablinks" onclick="openTab(event, 'Completed')">Completed</button>

    </div>

    <div id="All" class="tabcontent" style="border: 1px solid #5298D2">

        @if ($buyerProject->isEmpty())
            <div class="text-center">
                <h4>There no projects to show</h4>
            </div>
        @else
            @foreach ($buyerProject as $project)

                <div class="card" style="padding: 5px; border-radius:0.5em; border:none;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 card-title">
                                <h3>{{ $project->project_title }}</h3>
                            </div>

                            <div class="col-2 offset-1">
                                <br>
                                <a href="/project/{{ $project->project_id }}" class="btn btn-primary btn-block text-white"
                                    style="background-color: #5298D2; text-align: right;">
                                    <center>View</center>
                                </a>
                            </div>


                            <div class="col-2">
                                <br>
                                <a href="/delete-project/{{ $project->project_id }}"
                                    class="btn btn-danger btn-block text-white">
                                    <center>Delete</center>
                                </a>
                            </div>
                        </div>

                        <div class="card-subtitle">
                            <h5>Project Category: {{ $project->project_category }}</h4>
                        </div>

                        <div class="card-subtitle">
                            <h5>Project Price: ${{ $project->project_price }}</h4>
                        </div>

                        <div class="card-subtitle">
                            <h5>Project Duration: {{ $project->project_duration }}
                                {{ $project->project_duration_format }}
                                </h4>
                        </div>


                    </div>


                </div>

            @endforeach


        @endif
    </div>

    <div id="Active" class="tabcontent" style="border: 1px solid #5298D2">
        {{-- @if ($paidProjects->isEmpty()) --}}

        @forelse ($activeProjects as $project)
            {{-- @if ($project->status == 'active') --}}


            <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 card-title">
                            <h3><a href="/project/{{ $project->project_id }}">{{ $project->project_title }}</a>
                            </h3>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-6">
                            <h5>Project Price: ${{ $project->price }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Project Duration: {{ $project->duration }} {{ $project->duration_format }} </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <h5>Project Category: {{ $project->project_category }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Seller: <a
                                    href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a>
                                </h4>
                        </div>
                    </div>
                    <br>
                    @if ($project->buyer_feedback != null)
                    <div class="row">

                    <div class="col-6">
                        <h5>Your Revision Feedback</h5>

                               <span style="color: #979797"> {{ $project->buyer_feedback }}</span>
                        </div>
                    </div>
                    @endif
                </div>

            </div>

            {{-- @endif --}}
        @empty
            <div class="text-center">
                <h4>There no active projects to show</h4>
            </div>
        @endforelse

        {{-- @endif --}}
    </div>

    <div id="Awaiting For Approval" class="tabcontent" style="border: 1px solid #5298D2">

        @forelse ($awaitApproveProjects as $project)
            <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 card-title">
                            <h3><a href="/project/{{ $project->project_id }}">{{ $project->project_title }}</a>
                            </h3>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-6">
                            <h5>Project Price: ${{ $project->price }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Project Duration: {{ $project->duration }} {{ $project->duration_format }} </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <h5>Project Category: {{ $project->project_category }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Seller: <a
                                    href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a>
                                </h4>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-12">
                            <span style="color: #5298D2">Download Project File: </span><span><a
                                    href="/assets/users/userprofile/projects/{{ $project->project_file }}"
                                    class="btn btn-primary btn-sm"
                                    style="background-color: #5298D2">{{ $project->project_file }}</a></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="signup-form">
                            <form action="/ask-changes/{{ $project->id }}" method="post" enctype="multipart/form-data">
                                {{-- @method('PATCH') --}}
                                @csrf
                                <h3>Need Some Changes?</h3>
                                <div class="form-group">
                                    <textarea name="buyer_feedback" id="" cols="30" rows="10" class="form-control"
                                        placeholder="Write what changes you need."></textarea>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary" style="background-color: #5298D2" id="ask-changes">Ask
                                        for changes</button>

                                </div>
                            </form>

                        </div>


                        <div class="mr-3">
                            <a href="/approve-project/{{ $project->id }}" class="btn btn-success text-white">Approve</a>
                        </div>

                        <div class="mr-3">
                            <a href="/cancel-project/{{ $project->id }}" class="btn btn-danger">Cancel Project</a>
                        </div>

                    </div>
                </div>

            </div>
        @empty
            <div class="text-center">
                <h4>There no awaiting for approval projects to show</h4>
            </div>
        @endforelse
    </div>

    <div id="Awaiting For Feedback" class="tabcontent" style="border: 1px solid #5298D2">

        @forelse ($awaitFeedbackProjects as $project)
            <div class="card" style="padding: 5px; border-radius:0.5em; border:none">

                <div class="card-body">
                    <div class="row">
                        <div class="col-6 card-title">
                            <h3><a href="/project/{{ $project->project_id }}">{{ $project->project_title }}</a>
                            </h3>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-6">
                            <h5>Project Price: ${{ $project->price }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Project Duration: {{ $project->duration }} {{ $project->duration_format }} </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <h5>Project Category: {{ $project->project_category }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Seller: <a
                                    href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a>
                                </h4>
                        </div>
                    </div>
                    <br><br>
                    {{-- <div class="row">
                        <div class="col-12">
                            <span style="color: #5298D2">Project File: </span><span><a
                                    href="/assets/users/userprofile/projects/{{ $project->project_file }}"
                                    class="btn btn-primary btn-sm" style="background-color: #5298D2">Download Project</a></span>
                        </div>
                    </div> --}}


                    <div class="signup-form" style="width: 55%">
                        <form action="/buyerFeedback/{{ $project->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" value="{{ $project->id }}" class="form-control">
                            <h3>Give your feedback and rate the project</h3>

                            <div class="form-group">
                                <textarea name="buyer_feedback" id="" cols="30" rows="6"></textarea>
                            </div>

                            <div class="form-group">

                                <select name="project_rating" class="form-control" id="" style="border:1px solid #5298D2">
                                    <option value="0.0">0.0 star</option>
                                    <option value="0.5">0.5 star</option>
                                    <option value="1.0">1.0 star</option>
                                    <option value="1.5">1.5 star</option>
                                    <option value="2.0">2.0 star</option>
                                    <option value="2.5">2.5 star</option>
                                    <option value="3.0">3.0 star</option>
                                    <option value="3.5">3.5 star</option>
                                    <option value="4.0">4.0 star</option>
                                    <option value="4.5">4.5 star</option>
                                    <option value="5.0">5.0 star</option>
                                </select>

                            </div>


                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #5298D2">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        @empty
            <div class="text-center">
                <h4>There no awaiting for approval projects to show</h4>
            </div>
        @endforelse




    </div>


    <div id="Completed" class="tabcontent" style="border: 1px solid #5298D2">

        @forelse ($completeProjects as $project)

            <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 card-title">
                            <h3><a href="/project/{{ $project->project_id }}">{{ $project->project_title }}</a>
                            </h3>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col-6">
                            <h5>Project Price: ${{ $project->price }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Project Duration: {{ $project->duration }} {{ $project->duration_format }} </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <h5>Project Category: {{ $project->project_category }}</h4>
                        </div>
                        <div class="col-6">
                            <h5>Seller: <a
                                    href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a>
                                </h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <h5><b>Your Feedback:</b></h5>
                            <span>@include('userprofile.projectrating')</span>
                            <br>
                            <span>{{ $project->buyer_feedback }}</span>
                        </div>
                        <div class="col-6">
                            <h5><b>Seller Feedback:</b></h5>
                            <span>@include('userprofile.projectrating')</span>
                            <br>
                            <span>{{ $project->seller_feedback }}</span>
                        </div>
                    </div>
                    <br>

                </div>

            </div>
        @empty
            <div class="text-center">
                <h4>There no awaiting for approval projects to show</h4>
            </div>
        @endforelse


    </div>





@endsection
