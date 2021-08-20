@extends('layout.users')

@section('usercontent')

<div class="signup-form" >

    <form action="addProject" method="POST" enctype="multipart/form-data">

        @csrf


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
        <h2>Add New Project To Hire Top Notch Talent</h2>

<br><br>

<div class="form-group">


                <div class="col-12">
                    <label for="project-title">Project Title</label> <br>
                    <input type="text" class="form-control" name="project_title" value="{{ old('project_title') }}" style="border: 2px solid tomato">
                <span class="text-danger">@error('project_title') {{ $message }} @enderror</span>
                </div>
            </div>


<br><br>

<div class="form-group">
    <div class="col-4">

        <label for="project-category">Project Category</label>
        <select id="project-category" class="form-control" name="project_category" value="{{ old('project_category') }}" style="border: 2px solid tomato">
    {{-- <span class="text-danger">@error('course_category') {{ $message }} @enderror</span> --}}
    <option>Select Project Category</option>

    @foreach ($catData as $categories)

    <option value="{{ $categories -> category_id }}">{{ $categories -> category_name }}</option>

    @endforeach

    </select>

    </div>
</div>

<br><br>

              <div class="form-group">
                <div class="col-12">

                    <label for="project-description">Project Description</label>
                    <textarea type="text" class="form-control" name="project_description" style="height:300px; border: 2px solid tomato" value="{{ old('project_description') }}"></textarea>
                    <span class="text-danger">@error('project_description') {{ $message }} @enderror</span>
                </div>
              </div>



        <br><br>


        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label for="project-duration">Project Duration</label>
                    <input type="number" class="form-control" name="project_duration" style="width:10ch; border: 2px solid tomato" value="{{ old('project_duration') }}">

                    <span class="text-danger">@error('project_duration') {{ $message }} @enderror</span>

                </div>

                <div class="col-4">
                    <label for="project_duration_format">Select Hours, Days or Months</label>
                    <select name="project_duration_format" class="form-control" style="width:10ch; border: 2px solid tomato">
                        <option value="hours">Hours</option>
                        <option value="Days">Days</option>
                        <option value="weeks">Weeks</option>
                        <option value="months">Months</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="project-price">Project Price (write in dollars $)</label>
                    <input type="number" class="form-control" name="project_price" style="width:10ch; border: 2px solid tomato" value="{{ old('project_price') }}">
                    <span class="text-danger">@error('project_price') {{ $message }} @enderror</span>
                </div>
            </div>
        </div>

  <br><br>

            <button  type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: tomato; border: 0ch">Add Project</button>
        </div>
    </form>

</div>

@endsection
