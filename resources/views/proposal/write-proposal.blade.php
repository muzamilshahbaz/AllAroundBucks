@extends('layout.users')

@section('usercontent')
<div class="card" style="width: 60rem;">
    <div class="card-body">
        <b>
            <h3 class="display-6">
                {{ $project->project_title }}
            </h3>
        </b>
        <br><br>
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
           <hr>
           <h3 class="display-6">
           Write Your Proposal Details
        </h3>
        <br><br>
           <div class="signup-form ">
               <form action="/send-proposal/{{ $project->project_id }}" method="post" enctype="multipart/form-data">
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
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label for="project-duration">Project Duration</label>
                        <input type="number" class="form-control" name="duration" style="width:10ch; border: 2px solid tomato" value="{{ old('duration') }}">

                        <span class="text-danger">@error('duration') {{ $message }} @enderror</span>

                    </div>

                    <div class="col-4">
                        <label for="duration_format">Select Hours, Days or Months</label>
                        <select name="duration_format" class="form-control" style="width:10ch; border: 2px solid tomato">
                            <option value="hours">Hours</option>
                            <option value="days">Days</option>
                            <option value="weeks">Weeks</option>
                            <option value="months">Months</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="price">Project Price (write in dollars $)</label>
                        <input type="number" class="form-control" name="price" style="width:10ch; border: 2px solid tomato" value="{{ old('price') }}">
                        <span class="text-danger">@error('price') {{ $message }} @enderror</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="cover_letter">Cover Letter</label>
                       <textarea name="cover_letter" id=""  cols="100" rows="10" style="border: 2px solid tomato">{{ old('cover_letter') }}</textarea>
                        <span class="text-danger">@error('cover_letter') {{ $message }} @enderror</span>
                    </div>
                </div>
            </div>
               <div class="row">

                <div class="col-3 offset-8">
                    <button  type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: tomato; border: 0ch">Send Proposal</button></div>
               </div>

            </form>
           </div>
    </div>

</div>

@endsection
