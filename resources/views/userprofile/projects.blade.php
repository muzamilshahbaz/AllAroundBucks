@extends('layout.users')

@section('usercontent')

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

<div class="tab" style="border: 1px solid #5298D2">
    <button class="tablinks" onclick="openTab(event, 'All')">All</button>
    <button class="tablinks" onclick="openTab(event, 'Active')">Active</button>
    <button class="tablinks" onclick="openTab(event, 'Awaiting For Approval')">Awaiting For Approval</button>
    <button class="tablinks" onclick="openTab(event, 'Awaiting For Feedback')">Awaiting For Feedback</button>
    <button class="tablinks" onclick="openTab(event, 'Completed')">Completed</button>

  </div>

  <div id="All" class="tabcontent" style="border: 1px solid #5298D2">


    @foreach ($buyerProject as $project)





    <div class="card" style="padding: 5px; border-radius:0.5em; border:none;">
        <div class="card-body">
            <div class="row">
                <div class="col-6 card-title">
                    <h3>{{ $project -> project_title }}</h3>
                </div>

                <div class="col-2 offset-1">
                 <br>
                 <a href="/project/{{ $project->project_id }}" class="btn btn-primary btn-block text-white" style="background-color: #5298D2; text-align: right;"><center>View</center></a>
             </div>


             <div class="col-2">
                 <br>
                 <a href="/delete-project/{{ $project->project_id }}" class="btn btn-danger btn-block text-white"><center>Delete</center></a>
             </div>
                 </div>

                 <div class="card-subtitle">
                    <h5>Project Category: {{ $project->project_category }}</h4>
                </div>

                 <div class="card-subtitle">
                     <h5>Project Price: ${{ $project->project_price }}</h4>
                 </div>

                 <div class="card-subtitle">
                    <h5>Project Duration: {{ $project->project_duration }} {{ $project->project_duration_format }}</h4>
                </div>


           </div>


                </div>





        @endforeach
</div>

  <div id="Active" class="tabcontent">
    @foreach ($paidProjects as $project)

    @if ($project->status == 'active')


    <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
        <div class="card-body">
        <div class="row">
            <div class="col-6 card-title">
                <h3><a href="/project/{{ $project->project_id }}">{{ $project -> project_title }}</a></h3>
            </div>

             </div>


            <div class="row">
             <div class="col-6">
                 <h5>Project Price: ${{ $project ->price }}</h4>
             </div>
             <div class="col-6">
                 <h5>Project Duration: {{ $project ->duration }} {{ $project->duration_format }} </h4>
             </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <h5>Project Category: {{ $project ->project_category }}</h4>
                </div>
                <div class="col-6">
                    <h5>Seller: <a href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a> </h4>
                </div>
               </div>
      </div>

            </div>

    @endif




    @endforeach
  </div>

  <div id="Awaiting For Approval" class="tabcontent">
    @foreach ($paidProjects as $project)

    @if ($project->status == 'awaiting for approval')


    <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
        <div class="card-body">
        <div class="row">
            <div class="col-6 card-title">
                <h3><a href="/project/{{ $project->project_id }}">{{ $project -> project_title }}</a></h3>
            </div>

             </div>


            <div class="row">
             <div class="col-6">
                 <h5>Project Price: ${{ $project ->price }}</h4>
             </div>
             <div class="col-6">
                 <h5>Project Duration: {{ $project ->duration }} {{ $project->duration_format }} </h4>
             </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <h5>Project Category: {{ $project ->project_category }}</h4>
                </div>
                <div class="col-6">
                    <h5>Seller: <a href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a> </h4>
                </div>
               </div>
<br><br>
              <div class="row">
                <div class="col-12">
                    <h5>Modified Project File Name: {{ $project->project_file }}</h5>
                </div>
              </div>
<br>
              <div class="row">
                <div class="col-2 offset-5">
                    <a href="/approve-project/{{ $project->id }}" class="btn btn-block btn-success text-white"><center>Approve</center></a>
                </div>
                <div class="col-3">
                    <a href="" class="btn btn-block btn-dark"><center>Ask for changes</center></a>
                </div>
                <div class="col-2">
                    <a href="" class="btn btn-block btn-danger"><center>Cancel Project</center></a>
                </div>
              </div>
      </div>

            </div>

    @endif




    @endforeach
  </div>

  <div id="Awaiting For Feedback" class="tabcontent">
    @foreach ($paidProjects as $project)

    @if ($project->status == 'awaiting for feedback')


    <div class="card" style="padding: 5px; border-radius:0.5em; border:none">

      <div class="card-body">
        <div class="row">
            <div class="col-6 card-title">
                <h3><a href="/project/{{ $project->project_id }}">{{ $project->project_title }}</a></h3>
            </div>

             </div>


            <div class="row">
             <div class="col-6">
                 <h5>Project Price: ${{ $project ->price }}</h4>
             </div>
             <div class="col-6">
                 <h5>Project Duration: {{ $project ->duration }} {{ $project->duration_format }} </h4>
             </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <h5>Project Category: {{ $project ->project_category }}</h4>
                </div>
                <div class="col-6">
                    <h5>Seller: <a href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a> </h4>
                </div>
               </div>
<br><br>
              <div class="row">
                <div class="col-12">
                    <h5>Modified Project File Name: {{ $project->project_file }}</h5>
                </div>
              </div>
<br><br>
<h3>Give Your Feedback and Rate the Project</h3>
<br>
<form action="/buyerFeedback/{{ $project->id }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<input type="hidden" name="id" value="{{ $project->id }}" class="form-control">
<div class="row">
    <div class="form-group">
        <textarea name="buyer_feedback" id="" cols="30" rows="6"></textarea>
        </div>

        <div class="form-group">
        <div class="col-12">
            <select name="project_rating" class="form-control" id="">
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
        </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary text-white" style="background-color: #5298D2">Submit</button>
</div>

</form>


      </div>

            </div>

    @endif




    @endforeach



  </div>


  <div id="Completed" class="tabcontent">
    @foreach ($paidProjects as $project)

    @if ($project->status == 'completed')


    <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
        <div class="card-body">
        <div class="row">
            <div class="col-6 card-title">
                <h3><a href="/project/{{ $project->project_id }}">{{ $project -> project_title }}</a></h3>

            </div>

             </div>


            <div class="row">
             <div class="col-6">
                 <h5>Project Price: ${{ $project ->price }}</h4>
             </div>
             <div class="col-6">
                 <h5>Project Duration: {{ $project ->duration }} {{ $project->duration_format }} </h4>
             </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <h5>Project Category: {{ $project ->project_category }}</h4>
                </div>
                <div class="col-6">
                    <h5>Seller: <a href="/user/{{ $project->seller_username }}">{{ $project->seller_username }}</a> </h4>
                </div>
               </div>
<br><br>
              <div class="row">
                <div class="col-6">
                    <h5><b>Your Feedback:</b> @include('userprofile.projectrating') {{ $project->buyer_feedback }}</h5>
                </div>
                <div class="col-6">
                    <h5><b>Seller Feedback:</b> @include('userprofile.buyerprojectrating') {{ $project->seller_feedback }}</h5>

                </div>
              </div>
<br>

      </div>

            </div>

    @endif




    @endforeach
  </div>





@endsection
