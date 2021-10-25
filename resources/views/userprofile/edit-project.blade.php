@extends('layout.users')

@section('usercontent')
    <link rel="stylesheet" href="/assets/css/signup.css">

    <div class="signup-form" style="width: 90%; color:#0f1137 !important">

        <form style="color:#0f1137 !important" action="/update/{{ $project->project_id }}" method="PUT"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')
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
            <h3>Update Project</h3>

            <br><br>
            <input type="hidden" name="project_id" value="{{ $project->project_id }}">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">



                        <label for="project-title">Project Title</label> <br>
                        <input type="text" class="form-control" name="project_title"
                            value="{{ $project->project_title }}" required>
                        <span class="text-danger">@error('project_title') {{ $message }} @enderror</span>
                    </div>
                </div>



                <br><br>
                <div class="col-4">
                    <div class="form-group">


                        <label for="project-category">Project Category</label>
                        <select id="project-category" class="form-control" name="project_category"
                            value="{{ $project->project_category }}" style="border: 1px solid #5298D2">
                            <option value="">Select Project Category</option>

                            @foreach ($catData as $categories)

                                <option value="{{ $categories->category_id }}">{{ $categories->category_name }}</option>

                            @endforeach
                            <span class="text-danger">@error('project_category') {{ $message }} @enderror</span>

                        </select>

                    </div>
                </div>
            </div>
            <br>

            <div class="form-group">
                <div class="col-12">

                    <label for="project-description">Project Description</label>
                    <textarea type="text" class="form-control" name="project_description"
                        value="{{ $project->project_description }}"
                        required>{{ $project->project_description }}</textarea>
                    <span class="text-danger">@error('project_description') {{ $message }} @enderror</span>
                </div>
            </div>



            <br>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">

                        <label for="project-duration">Project Duration</label>
                        <input type="number" class="form-control" name="project_duration"
                            value="{{ $project->project_duration }}" required>

                        <span class="text-danger">@error('project_duration') {{ $message }} @enderror</span>

                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="project_duration_format">Select Hours, Days or Months</label>
                        <select name="project_duration_format" class="form-control" style="border: 1px solid #5298D2">
                            <option value="hours">Hours</option>
                            <option value="Days">Days</option>
                            <option value="weeks">Weeks</option>
                            <option value="months">Months</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="project-price">Project Price (write in dollars $)</label>
                        <input type="number" class="form-control" name="project_price"
                            value="{{ $project->project_price }}" required>
                        <span class="text-danger">@error('project_price') {{ $message }} @enderror</span>
                    </div>
                </div>

            </div>

            <br><br>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">Update
                    Project</button>
            </div>

        </form>

    </div>

@endsection
