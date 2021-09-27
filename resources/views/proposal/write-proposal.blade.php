@extends('layout.users')

@section('usercontent')
    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="card" style="padding: 5px; border-radius:0.5em; border:none;">

        <div class="card-body">
            <b>
                <h3 class="display-6" style="color:#5298D2">
                    {{ $project->project_title }}
                </h3>
            </b>
            <br><br>
            <b>Project Category: </b>{{ $project_category->category_name }}
            <br><br>
            <b>
                <h3>Project Description:</h3>
            </b>
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
            <hr>

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
            <div class="signup-form" style="width: 90%; color:#5298D2">
                <form style="color:#5298D2" action="/send-proposal/{{ $project->project_id }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="text-center">
                        <h4 class="display-6">
                            Write Your Proposal Details
                        </h4>
                    </div>
                    <br><br>
                    <div class="row">
                  <div class="col-4">
                    <div class="form-group">


                        <label for="project-duration">Project Duration</label>
                        <input type="number" class="form-control" name="duration" style="border: 1px solid #5298D2"
                            value="{{ old('duration') }}" required>

                        <span class="text-danger">@error('duration') {{ $message }} @enderror</span>

                    </div>
                  </div>

             <div class="col-4">
                <div class="form-group">
                    <label for="duration_format">Select Hours, Days or Months</label>
                    <select name="duration_format" class="form-control" style="border: 1px solid #5298D2">
                        <option value="hours">Hours</option>
                        <option value="days">Days</option>
                        <option value="weeks">Weeks</option>
                        <option value="months">Months</option>
                    </select>
                </div>
             </div>
               <div class="col-4">
                <div class="form-group">
                    <label for="price">Project Price (write in dollars $)</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price') }}"
                        style="border: 1px solid #5298D2" required>
                    <span class="text-danger">@error('price') {{ $message }} @enderror</span>
                </div>
               </div>
</div>
                    <br>
                    <div class="form-group">
                        <label for="duration_format">Cover Letter</label>
                        <textarea name="cover_letter" id="" cols="115" rows="10"
                            style="border: 1px solid #5298D2" required>{{ old('cover_letter') }}</textarea>
                        <span class="text-danger">@error('cover_letter') {{ $message }} @enderror</span>

                    </div>



                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg"
                            style="background-color: #5298D2; border: 0ch">Send Proposal</button>

                    </div>

                </form>
            </div>
        </div>



    @endsection
