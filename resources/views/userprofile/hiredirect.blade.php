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

@foreach ($allSeller as $seller)

@if ($seller->user_id != $LoggedUserInfo->user_id)
<div class="col-12">

    <div class="card" style="padding: 5px; border-radius:0.5em; border:none">
 <div class="card-body">
    <div class="row">
        @if ($seller->profile_img == NULL)
        <img src="assets/users/userprofile/defaultprofilepic.png" alt="seller-img" width="100" height="100" class="img-circle" style="border-radius: 50%">

        @else
        <img src="assets/users/userprofile/{{ $seller->profile_img }}" alt="seller-img" width="100" height="100" class="img-circle" style="border-radius: 50%">

        @endif
        <div class="col-6">
            <br>
            <a class="card-title" href="/user/{{ $seller->username }}">
                <h3>{{ $seller->name }}</h3>
            </a>

        <div class="card-subtitle">
            <h5>{{ $seller ->username }}</h4>
        </div>
        <span>{{ $seller->profession }}</span>
        <div>
            @include('ratings.sellerrating')
        </div>
        </div>


        <div class="col-2">
            <br>
            <a href="/user/{{ $seller->username }}" class="btn btn-block btn-primary text-white" style="background-color: #5298D2; text-align: right;"><center>Hire Now</center></a>
        </div>
    </div>
 </div>
    </div>

</div>
@endif

<br>



@endforeach

@endsection



