@extends('layout.users')

@section('usercontent')
<link rel="stylesheet" href="/assets/css/signup.css">

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

    <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
        <div class="card-body">

<section><h1>Personal Info</h1>
<br>
         <div class="signup-form" style="width: 90%">
            <form action="/savePersonalInfo" method="PUT" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $LoggedUserInfo->user_id }}">

              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $LoggedUserInfo->email }}">
                        <br>
                        <span class="text-danger">@error('email') {{ $message }}  @enderror</span>
                    </div>
                </div>
               <div class="col-6">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control"  name="username" value="{{ $LoggedUserInfo->username }}">
                    <br>
                    <span class="text-danger">@error('username') {{ $message }}  @enderror</span>
            </div>
               </div>



              </div>

              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" id="submit-btn">Save Changes</button>
            </div>

            </form>
         </div>

                </section>
<br>
                    <hr>
                    <br>
<section><h1>Security</h1>
    <br>
                <div class="signup-form" style="width:90%">
                    <form action="/changePassword" method="PUT" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $LoggedUserInfo->user_id }}">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="new-password">New Password</label>
                                 <input type="password" class="form-control" name="password">
                                 <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                             </div>
                            </div>
                         <div class="col-6">
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                                <span class="text-danger">@error('confirm_password') {{ $message }} @enderror</span>
                            </div>
                         </div>
                           </div>
<br>
                           <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" id="submit-btn">Change Password</button>
                        </div>
                    </form>
                </div>
                </section>
                <br>
                <hr>
                <br>
                {{-- <section><h1>Payment Method</h1>
                    <br>

                </section>
                <br>
<hr>
<br> --}}
                <section><h1>Account Delletion</h1>
                    <br>
                    <p>
                        <b>What happens when you deactivate your account?</b>
                        <li>Your profile and courses won't show on AllAroundBucks anymore.</li>
                        <li>All Projects will be deleted.</li>
                        <li>Your Courses will be deleted permanently</li>
                        <li>Your earnings will be removed until you withdraw them before deactivation.</li>
                    </p>
                    <br>
                    <div class="form-group offset-10">
                        <a href="/deactivate_account/{{ $LoggedUserInfo->user_id }}" class="btn btn-danger" style="border-radius: 2em">Delete Account</a>
                    </div>
                </section>

        </div>
    </div>
@endsection
