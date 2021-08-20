@extends('layout.users')

@section('usercontent')


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
<h5>Select your User Role and Username</h5>

<input type="hidden" name="user_id" value="{{ $LoggedUserInfo->user_id }}">
        <div class="form-group">
            <label for="user-role" style="color: black;">User Role:</label>
            <br>
            <span>**Select Your Role</span>
            <select id="user-role" class="form-control" name="user_role" value="{{ old('user_role') }}">
      <option value="Seller">Seller / Freelancer</option>
      <option value="Buyer">Buyer / Client</option>
      <option value="Student">Student</option>
      <option value="Trainer">Trainer</option>
    </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}">
            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: tomato; border: 0ch">Submit</button>
        </div>
    </form>
</div>


@endsection
