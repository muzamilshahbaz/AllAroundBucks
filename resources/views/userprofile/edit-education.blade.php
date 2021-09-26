@extends('layout.users')

@section('usercontent')

    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="signup-form" style="width: 80%">
        <form action="{{ route('education-history.update', $education->id) }}" method="POST">
            @method('PATCH')
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
                <h4 style="color:#5298D2">Edit Education</h5>
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
                            <input type="text" style="border: 1px solid #5298D2" class="form-control" name="degree"
                                value="{{ $education->degree }}">
                            <span class="text-danger">@error('degree') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" style="border: 1px solid #5298D2" class="form-control" name="school_name"
                                value="{{ $education->school_name }}">
                            <span class="text-danger">@error('school_name') {{ $message }} @enderror</span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-5">
                            <input type="date" style="border: 1px solid #5298D2" class="form-control" name="start_date"
                                placeholder="Start Date" value="{{ date('Y-m-d', strtotime($education->start_date)) }}">
                            <span class="text-danger">@error('start_date') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group col-5">
                            <input type="date" style="border: 1px solid #5298D2" class="form-control" name="end_date"
                                placeholder="End Date" value="{{ date('Y-m-d', strtotime($education->end_date)) }}"
                                id="end-date">
                            <span class="text-danger">@error('school_name') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group col-2">

                            <input type="checkbox" name="present" id="present" value="{{ $education->present }}"
                                onclick="disableEnd()">
                            <label for="">Currently Studying</label>

                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="description" placeholder="Describe Your Education" class="form-control"
                            id="" cols="30" rows="10">{{ $education->description }}</textarea>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg" style="background-color:#5298D2">Update
                            Education</button>
                    </div>
            </div>
        </form>
    </div>



@endsection
