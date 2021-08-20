@extends('layout.app')

@section('content')

<x-navbar></x->

    <div class="signup-form">

        <form action="register" method="POST" enctype="multipart/form-data">

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
            <h2>Register</h2>
            <p class="hint-text">Create your account. It's free and only takes a minute.</p>

            {{-- <div class="form-group">
                <label for="user-role" style="color: black;">Sign Up As:</label>
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
            </div> --}}

            <div class="form-group">
                <div class="col-12">
                    <a href="/google" class="btn btn-danger btn-block" style="color: white">Sign up with Google</a>
                    {{-- <a href="/facebook" class="btn btn-primary btn-block" style="color: white">Sign up with Facebook</a> --}}
                </div>
            </div>

           <center> <h5 style="color: black">or</h5>
           </center>
            <br>

            <div class="form-group">
                <div class="row">
                    <div class="col"><input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ old('name') }}">
                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
            </div>
            Add Profile Image
            <div class="form-group">
                <input type="file" class="form-control" name="profile_img" value="{{ old('profile_img') }}" onchange="previewFile(this)">
                <img src="/assets/users/userprofile/defaultprofilepic.png" id="previewImg" alt="profile-image" style="max-width: 130px; margin-top: 20px;">
                <span class="text-danger">@error('profile_img') {{ $message }} @enderror</span>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                <span class="text-danger">@error('confirm_password') {{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <label class="form-check-label"><input type="checkbox" name="checkbox">
                    I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                    <br>
                    <span class="text-danger">@error('checkbox') {{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: tomato; border: 0ch">Register Now</button>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="/signin" style="color: tomato">Sign in</a></div>
    </div>


<x-footer></x->

@endsection
