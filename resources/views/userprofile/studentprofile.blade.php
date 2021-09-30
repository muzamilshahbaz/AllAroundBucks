@extends('layout.users')

@section('usercontent')


    <div class="container emp-profile" style="color: black">

        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    @if ($LoggedUserInfo->profile_img == null)
                        <img src="/assets/users/userprofile/defaultprofilepic.png" alt="user-img" width="36" height="36"
                            class="img-circle" style="border-radius: 50%">
                    @else
                        <img src="/assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}" alt="user-img" width="36"
                            height="36" class="img-circle" style="border-radius: 50%">

                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h3 style="font-weight: bold">
                        {{ $LoggedUserInfo->name }}
                    </h3>
                    <h6>
                        {{ $LoggedUserInfo->profession }}
                    </h6>

                    <br><br>
                    <div class="flex-box">
                        <h4>About</h4>
                        <p>{{ $LoggedUserInfo->bio }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <a href="/editprofile/{{ $LoggedUserInfo->user_id }}" class="btn btn-primary"
                    style="background-color: #5298D2; border-radius: 2em" name="btnAddMore" value="Edit Profile">Edit
                    Profile</a>
            </div>

        </div>
        <br>
        <div class="row" style="font-size: 17px; border: 1px solid black; padding: 10px">

            <div class="text-center">
                <span style="font-weight: bold">Courses Completed: </span><span>{{ $student->courses_completed }}</span>
            </div>



        </div>
        @include('userprofile.education-history')
        @include('userprofile.employement-history')


        <div class="row" style="font-size: 17px; border: 1px solid black; padding: 10px">

            <div class="col-12">
                <span style="font-weight: bold; font-size: 17px;">Skills : </span> <br><br>
                <div class="card"
                    style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">
                    <div class="card-body">
                        @if ($student->skills == null)
                            <div class="text-center">No skills added</div>
                        @else
                            {{ $student->skills }}
                        @endif
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection
