@extends('layout.app')

@section('content')

<x-navbar>
</x->

<div class="container" id="tips">
    <div class="flex-box-tips" style="border-radius: 15px;">
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


<div class="card" id="project-search-result" style="padding: 5px; border-radius:0.5em; border:none; width:90%">

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
                     <span style="color:#746d6da6">Posted By: <a href="/signup">{{ $project->buyer_username }}</a></span>
                 </div>

                 <div class="row" style="font-size:14px">
                     <div class="col-4">
                        <span style="color: #5298D2">Price: <span style="color: #000000">${{ $project->project_price }}</span></span>
                     </div>

                     <div class="col-4">
                        <span style="color: #5298D2">Category: <span style="color: #000000">{{ $project->project_category }}</span></span>
                     </div>

<div class="col-4">
    <span style="color: #5298D2">Duration: <span style="color: #000000">{{ $project->project_duration }} {{ $project->project_duration_format }}</span></span>

</div>

                 </div>
                 <div class="row" style="font-size:14px">
                     <div class="col-12">
                        <span style="color: #5298D2">Description: <span style="color: #000000; font-size:14px">{{ $project->project_description }}</span></span>

                     </div>
                 </div>
<div class="offset-9">
    <a href="/signup" class="btn btn-primary text-white" style="background-color: #5298D2;">Send Proposal</a>

</div>

           </div>


            </div>

    <br>

    @endforeach
@endif
    </div>
</div>

<x-footer>
</x->
@endsection
