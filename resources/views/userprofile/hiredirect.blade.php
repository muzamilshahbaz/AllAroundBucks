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
<form action="/user/talent-search/" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-3 offset-6">
            <input type="text" name="search_query" class="form-control" placeholder="Search Talent......">
            <span class="text-danger">@error('barcode') {{ $message }} @enderror</span>
        </div>
        <div class="col-2">
            <button type="submit" id="submit-btn" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
@foreach ($allSeller as $seller)

@if ($seller->user_id != $LoggedUserInfo->user_id)
<div class="card" id="project-search-result"
                style="padding: 5px; border-radius:0.5em; border:none; width: 100%;">

                <div class="card-body" style="text-align:left">
                    {{-- <div class="row"> --}}

                    <div class="row">

                        @if ($seller->profile_img == null)
                            <img src="/assets/users/userprofile/defaultprofilepic.png" alt="seller-img" width="100"
                                height="100" class="img-circle" style="border-radius: 50%">

                        @else
                            <img src="/assets/users/userprofile/{{ $seller->profile_img }}" alt="seller-img" width="100"
                                height="100" class="img-circle" style="border-radius: 50%">

                        @endif

                        <div class="col-8">
                            <div class="card-title">
                                <a href="/user/{{ $seller->username }}">
                                    <h3>{{ $seller->name }}</h3>
                                </a>
                            </div>

                            <div class="card-subtitle">
                                <span style="color: #615b5b94 !important">{{ $seller->profession }}</span>
                            </div>


                                <span style="font-size:0.8em !important">@include('ratings.sellerrating')</span>


                        </div>


                        <div class="col-2">

                            <a href="/user/{{ $seller->seller_username }}" class="btn btn-primary"
                                id="submit-btn">
                                Hire Now
                            </a>
                        </div>
                    </div>

                    {{-- </div> --}}

                    {{-- <div class="row">
                     <div class="col-2 offset-9">

                         <a href="/signup" class="btn btn-block primary text-white" style="background-color: #5298D2; text-align: right;"><center>View</center></a>

                     </div>
                 </div> --}}




<br>

                    <div class="row" style="font-size:14px">


                        <div class="col-4">
                            <span style="color: #0f1137">Hourly Rate: <span
                                    style="color: #0f1137">${{ $seller->hourly_rate }}
                                    /hour</span></span>

                        </div>
                        <div class="col-4">
                            <span style="color: #0f1137">Total Projects: <span
                                    style="color: #0f1137">{{ $seller->total_projects }}
                                </span></span>

                        </div>

                    </div>
                    <br>
                    <div class="row" style="font-size:14px">
                        <div class="col-12">
                            <span style="color: #0f1137">About: <span
                                    style="color: #0f1137; font-size:14px">{{ $seller->bio }}</span></span>

                        </div>
                    </div>
                    {{-- <div class="offset-9">
                                    <a href="/signup" class="btn btn-primary text-white"
                                        style="background-color: #5298D2;">Hire Now</a>

                                </div> --}}

                </div>


            </div>
@endif

<br>



@endforeach

@endsection



