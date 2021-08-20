@extends('layout.users')

@section('usercontent')
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

    <div class="card" style="border: 0ch">
        <div class="card-body">

<section><h1>Personal Info</h1>
<br>
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

                      <div class="form-group col-2 offset-10">
                        <button type="submit" class="btn btn-primary" style="background-color: tomato; border: 0ch">Save Changes</button>
                    </div>

                    </form>

                </section>
<br>
                    <hr>
                    <br>
<section><h1>Security</h1>
    <br>
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
                           <div class="form-group col-3 offset-10">
                            <button type="submit" class="btn btn-primary" style="background-color: tomato; border: 0ch">Change Password</button>
                        </div>
                    </form>
                </section>
                <br>
                <hr>
                <br>
                <section><h1>Payment Method</h1>
                    <br>

                </section>
                <br>
<hr>
<br>
                <section><h1>Account Deactivation</h1>
                    <br>
                    <p>
                        <b>What happens when you deactivate your account?</b>
                        <li>Your profile and services won't show on AllAroundBucks anymore.</li>
                        <li>Active Projects will be cancelled and your ratings go down.</li>
                        <li>Your earnings will be removed until you withdraw them before deactivation.</li>
                    </p>
                    <br>
                    <div class="form-group col-3 offset-10">
                        <a href="/deactivate_account/{{ $LoggedUserInfo->user_id }}" class="btn btn-danger">Deactivate Account</a>
                    </div>
                </section>

        </div>
    </div>
@endsection
