@extends('layout.users')

@section('usercontent')

<form action="/user/project-search/" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-3 offset-6">
            <input type="text" name="search_query" class="form-control" placeholder="Search Talent......">
            <span class="text-danger">@error('barcode') {{ $message }} @enderror</span>
        </div>
        <div class="col-2">
            <button type="submit" style="background-color: #5298D2" class="btn btn-primary text-white">Search</button>
        </div>
    </div>
    </form>
    @if ($projects->isEmpty())
        <div class="text-center">
            <h4>There are no projects against your search query.</h4>
        </div>
    @else

        <div class="text-center">
            <h4>Following are the results against your project search query.</h4>
        </div>
        <br>
        @foreach ($projects as $project)


            <div class="card" id="project-search-result"
                style="padding: 5px; border-radius:0.5em; border:none; width:100%">

                <div class="card-body" style="text-align:left">
                    {{-- <div class="row"> --}}

                    <div class="card-title" style="color: #5298D2;">

                        <h3>{{ $project->project_title }}</h3>
                    </div>

                    {{-- </div> --}}

                    {{-- <div class="row">
                     <div class="col-2 offset-9">

                         <a href="/signup" class="btn btn-block primary text-white" style="background-color: #5298D2; text-align: right;"><center>View</center></a>

                     </div>
                 </div> --}}


                    <div class="card-subtitle" style="font-size:0.8em">
                        <span style="color:#746d6da6">Posted By: <a
                                href="/signup">{{ $project->buyer_username }}</a></span>
                    </div>

                    <div class="row" style="font-size:14px">
                        <div class="col-4">
                            <span style="color: #5298D2">Price: <span
                                    style="color: #000000">${{ $project->project_price }}</span></span>
                        </div>

                        <div class="col-4">
                            <span style="color: #5298D2">Category: <span
                                    style="color: #000000">{{ $project->project_category }}</span></span>
                        </div>

                        <div class="col-4">
                            <span style="color: #5298D2">Duration: <span
                                    style="color: #000000">{{ $project->project_duration }}
                                    {{ $project->project_duration_format }}</span></span>

                        </div>

                    </div>
                    <br>
                    <div class="row" style="font-size:14px">
                        <div class="col-12">
                            <span style="color: #5298D2">Description: <span
                                    style="color: #000000; font-size:14px">{{ $project->project_description }}</span></span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 offset-9">

                            <a href="/project/{{ $project->project_id }}" class="btn btn-block primary text-white"
                                style="background-color: #5298D2; text-align: right;">
                                <center>View</center>
                            </a>

                        </div>
                    </div>

                </div>


            </div>

            <br>

        @endforeach
    @endif


@endsection
