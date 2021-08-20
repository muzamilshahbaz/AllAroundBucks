@extends('layout.users')

@section('usercontent')

<form action="/search-projects" method="GET" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="form-group col-3 offset-6">
        <input type="text" name="project_search_query" class="form-control" placeholder="Search Projects......">
        <span class="text-danger">@error('barcode') {{ $message }} @enderror</span>
    </div>
    <div class="col-2">
        <button type="submit" class="btn btn-success text-white">Search</button>
    </div>
</div>
</form>

@foreach ($projects as $project)


        <div class="card" style="width:60rem; border: 0px">
           <div class="card-body">
            <div class="row">

                <div class="card-title col-6">

                    <h3>{{ $project -> project_title }}</h3>
                </div>

                 </div>

                 <div class="row">
                     <div class="col-2 offset-9">

                         <a href="/project/{{ $project->project_id}}" class="btn btn-block btn-danger text-white" style="background-color: tomato; text-align: right;"><center>View</center></a>

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




@endsection
