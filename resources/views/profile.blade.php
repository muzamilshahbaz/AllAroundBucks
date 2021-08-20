@extends('layout.users')

@section('usercontent')



<div class="card" style="border: 0ch; height:100%">
    <div class="card-body">

            <div class="col-6">
                <div class="card" style="height: 100;width:50%; background-color: white; border:0.2ch solid tomato; shadow:2px">
                    <div class="card-body">

<center>

        <img src="/assets/users/userprofile/{{ $userProfile->profile_img }}" width="100" class="img-circle">

        <b><div class="card-title">
            {{ $userProfile->username }}
        </div>
        <div class="card-subtitle">
            {{ $userProfile->profession }}
        </div></b>
        <div class="card-subtitle" style="color: tomato">
            {{ $userProfile->user_role }}
        </div>

        @if ($userProfile->user_role == 'Seller')
            @include('ratings.sellerrating')
        @endif
<br><br>
        <div class="col-12">
            <a href="/inbox" class="btn btn-block text-white" style="background-color: tomato">Contact Now</a>
        </div>
   </center>                        </div>
                    </div>
            </div>

    </div>
</div>


@endsection
