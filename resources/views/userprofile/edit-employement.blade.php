@extends('layout.users')

@section('usercontent')

    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="signup-form" style="width: 80%">
        <form action="{{ route('employement-history.update', $employement->id) }}" method="POST">
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
                <h4 style="color:#5298D2">Edit Employement</h5>
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
                                name="employement_title" placeholder="Employement Title, e.g, Software Developer"
                                value="{{ $employement->employement_title }}">
                            <span class="text-danger">@error('employement_title') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" style="border: 1px solid #5298D2" class="form-control" name="company_name"
                                placeholder="Company Name" value="{{ $employement->company_name }}">
                            <span class="text-danger">@error('company_name') {{ $message }} @enderror</span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-5">
                            <input type="date" style="border: 1px solid #5298D2" class="form-control" name="start_date"
                                placeholder="Start Date" value="{{ date('Y-m-d', strtotime($employement->start_date)) }}">
                            <span class="text-danger">@error('start_date') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group col-5">
                            <input type="date" style="border: 1px solid #5298D2" class="form-control" name="end_date"
                                placeholder="End Date" value="{{ date('Y-m-d', strtotime($employement->end_date)) }}" id="end-date">
                            <span class="text-danger">@error('company_name') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group col-2">

                            <input type="checkbox" name="present" id="present" value="{{ $employement->present }}" onclick="disableEnd()">
                            <label for="">Currently Working</label>

                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="description" placeholder="Describe Your Work Experience" class="form-control"
                            id="" cols="30" rows="10">{{ $employement->description }}</textarea>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg" style="background-color:#5298D2">Update
                            Employement</button>
                    </div>
            </div>
        </form>
    </div>



@endsection
