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
    @include('profile.profile-buttons')
    <div class="container emp-profile">

        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    @if ($userProfile->profile_img == null)
                        <img src="/assets/users/userprofile/defaultprofilepic.png" alt="user-img" width="36" height="36"
                            class="img-circle" style="border-radius: 50%">
                    @else
                        <img src="/assets/users/userprofile/{{ $userProfile->profile_img }}" alt="user-img" width="36"
                            height="36" class="img-circle" style="border-radius: 50%">

                    @endif
                </div>
                @include('profile.contact-me-button')
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h3 style="font-weight: bold">
                        {{ $userProfile->name }}
                    </h3>
                    <h6>
                        {{ $userProfile->profession }}
                    </h6>
                    <span class="proile-rating">

                        @include('ratings.buyerrating')

                    </span>
                    <br><br>
                    <div class="flex-box">
                        <h4>About</h4>
                        <p>{{ $userProfile->bio }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary" style=" border-radius: 1em" disabled>Buyer Profile</button>
            </div>

        </div>
        <br>
        <div class="row" style="font-size: 17px; border: 1px solid black; padding: 10px">

            <div class="col-4">
                <span style="font-weight: bold">Organization: </span><span>{{ $buyer->organization }}</span>
            </div>
            <div class="col-4">
                <span style="font-weight: bold">Total Projects: </span><span>{{ $buyer->total_projects }}</span>
            </div>
            <div class="col-4">
                <span style="font-weight: bold">Total Invest: </span><span>${{ $projects->sum('price') }}</span>
            </div>

        </div>

        @include('profile.education-history')
        @include('profile.employement-history')

        <div class="row" style="border: 1px solid black; padding: 10px">

            <div class="col-12">
                <span style="font-weight: bold; font-size: 17px;">Recent Projects : </span> <br><br>
                <div>
                    @foreach ($projects as $project)
                        <div class="card"
                            style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">

                            <div class="card-body">
                                <div class="card-title">
                                    <h4><b>{{ $project->project_title }}</b></h4>
                                </div clas>
                                <span>@include('userprofile.buyerprojectrating')</span>

                                <div class="row">
                                    <div class="col-6">
                                        <span style="font-weight: bold">Seller: </span><span>
                                            {{ $project->seller_username }}</span>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-weight: bold">Spent: </span><span>
                                            ${{ $project->price }}</span>

                                    </div>
                                </div>


                                <br>

                                <span style="font-weight: bold">Seller Feedback:
                                </span><span>{{ $project->seller_feedback }}</span>


                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- <div class="row" style="font-size: 17px; border: 1px solid black; padding: 10px">

        <div class="col-12">
            <span style="font-weight: bold; font-size: 17px;">Skills : </span> <br><br>
            <div class="card" style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">
<div class="card-body">
    {{ $seller->skills }}
</div>
            </div>
        </div>


</div> --}}

    </div>

@endsection
