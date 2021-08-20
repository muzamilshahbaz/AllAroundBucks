@extends('layout.app')

@section('content')

<x-navbar></x->


    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
<br><br>
          <!-- Icon -->
          <div class="fadeIn first">
            <h3>Account Login</h3>
          </div>
<br>
          <!-- Login Form -->
          <form action="login" method="POST">

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
                <div class="col-12">
                    <a href="/google" class="btn btn-danger btn-block" style="color: white">Login with Google</a>
                    {{-- <a href="/facebook" class="btn btn-primary btn-block" style="color: white">Login with Facebook</a> --}}
                </div>
            </div>

           <center> <h5 style="color: black">or</h5>
           </center>
            <br>
            <input type="text" id="login" class="fadeIn second" name="login" placeholder="Email" value="{{ old('login') }}">
            <br>
            <span class="text-danger">@error('login') {{ $message }}  @enderror</span>
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
            <br>
            <span class="text-danger">@error('password') {{ $message }}  @enderror</span>
            <br><br>
            <input type="submit" id="login-submit" class="fadeIn fourth" value="Log In" style="background-color: tomato; border: 0ch">

            <!-- Remind Passowrd -->

          <a class="underlineHover" href="#" style="color: tomato">Forgot Password?</a>

          </form>

          <div id="formFooter">

<span>New To AllAroundBucks ?</span>
<hr>

<a href="/signup" class="btn btn-primary sign-up-btn" style="background-color: tomato; border: 0ch" >Sign up</a>

          </div>

        </div>


      </div>

<x-footer></x->

@endsection
