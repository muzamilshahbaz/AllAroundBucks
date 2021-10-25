@extends('layout.users')

@section('usercontent')

    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="signup-form" style="width: 80%; color: #0f1137">
        <form style="color: #0f1137" action="{{ route('education-history.store') }}" method="POST">

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
            <div class="text-center">
                <h4 style="color:#0f1137">Add Education</h5>
                    <br>

                    {{-- <div class="form-group">

            <select id="user-role" style="border: 1px solid #5298D2" class="form-control" name="user_role" value="{{ old('user_role') }}">
      @foreach ($roles as $role)
          <option  style="border: 1px solid #5298D2" value="{{ $role->role_title }}">{{ $role->role_title }}</option>
      @endforeach
    </select>
        </div> --}}

                    <div class="row">
                        <div class="form-group col-6">
                            <input type="text" style="border: 1px solid #5298D2" class="form-control"
                                name="degree" placeholder="Degree/certificate/diploma"
                                value="{{ old('degree') }}">
                            <span class="text-danger">@error('degree') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" style="border: 1px solid #5298D2" class="form-control" name="school_name"
                                placeholder="School/College/University  Name" value="{{ old('school_name') }}">
                            <span class="text-danger">@error('school_name') {{ $message }} @enderror</span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-5">
                            <input type="date" style="border: 1px solid #5298D2" class="form-control" name="start_date"
                                placeholder="Start Date" value="{{ old('start_date') }}">
                            <span class="text-danger">@error('start_date') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group col-5">
                            <input type="date" style="border: 1px solid #5298D2" class="form-control" name="end_date"
                                placeholder="End Date" value="{{ old('end_date') }}" id="end-date">
                            <span class="text-danger">@error('school_name') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group col-2">

                            <input type="checkbox" name="present" id="present" onclick="disableEnd()">
                            <label for="">Currently Studying</label>

                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="description" placeholder="Describe Your Education" class="form-control"
                            id="" cols="30" rows="10"></textarea>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">Add
                            Education</button>
                    </div>
            </div>
        </form>
    </div>



@endsection
