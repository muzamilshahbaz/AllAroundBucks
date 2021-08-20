@extends('layout.users')

@section('usercontent')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="\assets\css\userprofile.css">

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="assets/users/userprofile/{{ $LoggedUserInfo -> profile_img }}" alt="user-img" width="50" class="img-circle">

                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                            <h3>
                      {{ $LoggedUserInfo -> name }}
                            </h3>
                            <h6>
                              {{ $LoggedUserInfo -> profession }}
                            </h6>
                            <br>
                            <p>{{ $LoggedUserInfo -> bio }}</p>




                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <a href="/editprofile/{{ $LoggedUserInfo->user_id }}" class="profile-edit-btn" name="btnAddMore" value="Edit Profile">Edit Profile</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">

                    <p>SKILLS</p>
                    <a href="">Web Designer</a><br/>
                    <a href="">Web Developer</a><br/>
                    <a href="">WordPress</a><br/>
                    <a href="">WooCommerce</a><br/>
                    <a href="">PHP, .Net</a><br/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $LoggedUserInfo -> username }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $LoggedUserInfo -> name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $LoggedUserInfo -> email }}</p>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p></p>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Profession</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $LoggedUserInfo -> profession }}</p>
                                    </div>
                                </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">




                            <div class="row">
                                <div class="col-md-6">
                                    <label>Courses Enrolled</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $student -> courses_enrolled }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Courses Completed</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $student -> courses_completed }}</p>
                                </div>
                            </div>




                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <label>English Level</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div> --}}


                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection



