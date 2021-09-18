@extends('layout.app')

@section('content')

<x-navbar></x->

<div class="signup-form">
    <form action="verify" method="post">
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

        <div class="col-md-12">
            <p>
                Kindly Check your Email and Copy and Paste the 5-digit code to verify your account.
            </p>
        </div>

    <div class="form-group">
        <input type="text" class="form-control" name="verify_code" placeholder="Paste the 5-digit verification code">
        <span class="text-danger">@error('verify_code') {{ $message }} @enderror</span>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Verify Now</button>
    </div>
    </form>
</div>

<x-footer></x->


@endsection
