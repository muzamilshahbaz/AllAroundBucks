@extends('layout.app')

@section('content')

<x-navbar></x->

    <div class="signup-form">

        <form action="login" method="POST" enctype="multipart/form-data">

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
            <h3>Log in to AllAroundBucks</h3>
            {{-- <p class="hint-text">Create your account. It's free and only takes a minute.</p> --}}


          <div class="text-center">
            <a href="/google">
                <div class='g-sign-in-button'>
                    <div class=content-wrapper>
                        <div class='logo-wrapper'>
                            <img src='/assets/images/g.png'>
                        </div>
                        <span class='text-container'>
                      <span>Continue with Google</span>
                    </span>
                    </div>
                </div>
               </a>
          </div>
<center> <h5 style="color: #B0CDE0 !important">or</h5>
                </center>


            {{-- <div class="form-group">

                    <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ old('name') }}">
                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>

            </div> --}}
            <div class="form-group">
                <input type="email" class="form-control" id="txtEmail" name="login" placeholder="Email" value="{{ old('login') }}" onkeyup="ValidateEmail()" required autocomplete="off">
                <span class="text-danger" id="errorMsg">@error('login') {{ $message }} @enderror</span>
            </div>
            {{-- Add Profile Image --}}
            {{-- <div class="form-group">
                <input type="file" class="form-control" name="profile_img" value="{{ old('profile_img') }}" onchange="previewFile(this)">
                <img src="/assets/users/userprofile/defaultprofilepic.png" id="previewImg" alt="profile-image" style="max-width: 130px; margin-top: 20px;">
                <span class="text-danger">@error('profile_img') {{ $message }} @enderror</span>
            </div> --}}

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
            </div>
            {{-- <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                <span class="text-danger">@error('confirm_password') {{ $message }} @enderror</span>
            </div> --}}
            {{-- <div class="form-group">
                <label class="form-check-label"><input type="checkbox" name="checkbox">
                    I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                    <br>
                    <span class="text-danger">@error('checkbox') {{ $message }} @enderror</span>
            </div> --}}
            <div class="text-center">
                <div class="form-group">
                    <button type="submit" id="submit-btn" class="btn btn-primary btn-lg">Log In</button>
                </div>
            </div>
            <div class="text-center">Don't have an Account? Create One! <a href="/signup" style="color: #B0CDE0">Sign Up</a></div>

        </form>
    </div>


<x-footer></x->

@endsection
