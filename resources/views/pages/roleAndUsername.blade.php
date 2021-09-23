@extends('layout.users')

@section('usercontent')

<link rel="stylesheet" href="assets/css/signup.css">
<div class="signup-form">
    <form action="/roleAndUsername/{{ $LoggedUserInfo->user_id }}" method="POST">
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
<div class="text-center">
    <h4  style="color:#5298D2">Select your User Role and Username</h5>
<br>
<input type="hidden" name="user_id" value="{{ $LoggedUserInfo->user_id }}">
        <div class="form-group">

            <select id="user-role" style="border: 1px solid #5298D2" class="form-control" name="user_role" value="{{ old('user_role') }}">
      @foreach ($roles as $role)
          <option  style="border: 1px solid #5298D2" value="{{ $role->role_title }}">{{ $role->role_title }}</option>
      @endforeach
    </select>
        </div>

        <div class="form-group">
            <input type="text" style="border: 1px solid #5298D2" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}">
            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg" style="background-color:#5298D2">Submit</button>
        </div>
</div>
    </form>
</div>


@endsection
