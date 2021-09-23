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



@if ($projects->isEmpty())
<div class="text-center">
    <h3>There are no projects to show</h3>
</div>
@else
<form action="/search-projects" method="GET" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-3 offset-6">
            <input type="text" name="project_search_query" class="form-control" placeholder="Search Projects......">
            <span class="text-danger">@error('barcode') {{ $message }} @enderror</span>
        </div>
        <div class="col-2">
            <button type="submit" style="background-color: #5298D2" class="btn btn-primary text-white">Search</button>
        </div>
    </div>
    </form>
@foreach ($projects as $project)


<div class="card" style="padding: 5px; border-radius:0.5em; border:none">

           <div class="card-body">
            <div class="row">

                <div class="card-title col-6">

                    <h3>{{ $project -> project_title }}</h3>
                </div>

                 </div>

                 <div class="row">
                     <div class="col-2 offset-9">

                         <a href="/project/{{ $project->project_id}}" class="btn btn-block primary text-white" style="background-color: #5298D2; text-align: right;"><center>View</center></a>

                     </div>
                 </div>


                 <div class="card-subtitle col-4">
                     <h4>Posted By: <a href="/user/{{ $project->buyer_username }}">{{ $project -> buyer_username }}</a></h4>
                 </div>

                 <div class="card-subtitle col-8">
                     <h5>Project Price: ${{ $project -> project_price }} </h5>

                     <h5>Project Category: {{ $project->project_category }}</h5>

                     <h5> Project Duration: {{ $project -> project_duration }} {{ $project -> project_duration_format }}</h5>


                 </div>

           </div>


            </div>

    <br>

    @endforeach
@endif




@endsection
