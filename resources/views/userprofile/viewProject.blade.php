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
    <div class="card" style="padding: 5px; border-radius:0.5em; border:none; color: #0f1137 !important;">

    <div class="card-body">
        <b>
            <h3 class="display-6">
                {{ $project->project_title }}
            </h3>
        </b>
        <br>
       <div class="row">
        <div class="card-subtitle col-4">
            <h4>Posted By: <a href="/user/{{ $project->buyer_username }}">{{ $project -> buyer_username }}</a></h4>
        </div>
       </div>
        <br>
        <b>Project Category: </b>{{ $project_category->category_name }}
        <br><br>
        <b><h3 >Project Description:</h3></b>
        <p>{{ $project->project_description }}</p>



        <div class="row">
            <div class="col-6">
            <b> Project Duration:</b> {{ $project->project_duration }} {{ $project->project_duration_format }}
            </div>
            <div class="col-6">
                <b>Project Price:</b> ${{ $project->project_price }}
            </div>

        </div>

           <br><br>
           <div class="row">
            @if ($LoggedUserInfo->user_role == 'Buyer')
            <div class="row offset-9">
                <a href="/edit-project/{{ $project->project_id }}" class="btn btn-primary mr-3" id="submit-btn">Edit</a>

                <a href="/project-proposals/{{ $project->project_id }}" class="btn btn-primary" id="submit-btn">View Proposals</a>

            </div>

            @elseif ($proposal)
               <div class="col-3 offset-8">
                <button class="btn btn-block text-white" style="background-color: grey; border-radius:0.5em" disabled="disabled">Proposal Sent</button>
               </div>

               @else

               <div class="col-3 offset-8">
                <a href="/write-proposal/{{ $project->project_id }}" class="btn btn-block btn-primary" id="submit-btn"><center>Send Proposal</center></a>
                </div>
                @endif





           </div>
    </div>

</div>

@endsection
