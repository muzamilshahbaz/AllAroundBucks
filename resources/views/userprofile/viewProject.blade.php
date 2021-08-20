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
<div class="card" style="width: 60rem;">
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
            {{-- <div class="col-2 offset-8">
                <a href="/edit-project/{{ $project->project_id }}" class="btn btn-block btn-light text-white" style="background-color: tomato; text-align: right;"><center>Edit</center></a>
            </div> --}}
            <div class="col-3 offset-9">
                <a href="/project-proposals/{{ $project->project_id }}" class="btn btn-block btn-danger text-white" style="background-color: tomato; text-align: right;"><center>View Proposals</center></a>

            </div>
            @elseif ($proposal)
               <div class="col-3 offset-8">
                <button class="btn btn-block text-white" style="background-color: grey" disabled="disabled">Proposal Sent</button>
               </div>

               @else

               <div class="col-3 offset-8">
                <a href="/write-proposal/{{ $project->project_id }}" class="btn btn-block btn-light text-white" style="background-color: tomato; text-align: right;"><center>Send Proposal</center></a>
                </div>
                @endif





           </div>
    </div>

</div>

@endsection
