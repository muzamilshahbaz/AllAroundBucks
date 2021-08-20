@extends('layout.users')

@section('usercontent')


@foreach ($allUser as $freelancer)


@if ($freelancer->user_role == 'Seller')

<div class="col-12">

    <div class="card" style="border: 0px">
        <div class="row">
            <img src="assets/users/userprofile/{{ $freelancer -> profile_img }}" alt="seller-img" width="100" height="100" class="img-circle">

            <div class="col-6">
                <br>
                <a class="" href="/user/{{ $freelancer->username }}">
                    <h3>{{ $freelancer -> name }}</h3>
                </a>

            <div class="card-subtitle">
                <h5>{{ $freelancer ->username }}</h4>
            </div>
            </div>


            <div class="col-2">
                <br>
                <a href="/user/{{ $freelancer->username }}" class="btn btn-block btn-danger text-white" style="background-color: tomato; text-align: right;"><center>Hire Now</center></a>
            </div>
        </div>
    </div>

</div>

<br>


@endif


@endforeach

@endsection



