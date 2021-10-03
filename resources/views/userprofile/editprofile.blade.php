@extends('layout.users')

@section('usercontent')
    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="signup-form" style="width: 90%; color:#5298D2 !important">


        <!-- Login Form -->
        <form style="color:#5298D2 !important" action="/updateprofile/   @if ($LoggedUserInfo->user_role == 'Seller')
            @php
                $id = $seller->seller_id;
            @endphp
            {{ $id }}
        @elseif ($LoggedUserInfo->user_role == 'Buyer')
            @php
                $id = $buyer->buyer_id;
            @endphp
            {{ $id }}
        @elseif ($LoggedUserInfo->user_role == 'Trainer')
            @php
                $id = $trainer->trainer_id;
            @endphp
            {{ $id }}
        @elseif ($LoggedUserInfo->user_role == 'Student')
            @php
                $id = $student->student_id;
            @endphp
            {{ $id }}
            @endif
            " method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
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

            <div class="text-center">
                <h1 style="color:#5298D2">Update Profile</h1>
                <br>
            </div>
            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
            @if ($LoggedUserInfo->user_role == 'Seller')

                <input type="hidden" name="seller_id" value="{{ $seller->seller_id }}">
            @elseif ($LoggedUserInfo->user_role == 'Buyer')

                <input type="hidden" name="buyer_id" value="{{ $buyer->buyer_id }}">
            @elseif ($LoggedUserInfo->user_role == 'Trainer')

                <input type="hidden" name="trainer_id" value="{{ $trainer->trainer_id }}">
            @elseif ($LoggedUserInfo->user_role == 'Student')

                <input type="hidden" name="student_id" value="{{ $student->student_id }}">
            @endif





            <div class="form-group text-center">
                <div class="profile-img">
                    @if ($LoggedUserInfo->profile_img == null)
                        <img src="/assets/users/userprofile/defaultprofilepic.png" id="previewImg" alt="user-img"
                            width="100%" height="100%" class="img-circle" style="border-radius: 50%">
                    @else
                        <img src="/assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}" id="previewImg"
                            alt="user-img" width="100%" height="100%" class="img-circle" style="border-radius: 50%">

                    @endif
                    <input type="file" class="col-3" name="profile_img"
                        value="{{ $LoggedUserInfo->profile_img }}" onchange="previewFile(this)">
                </div>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                <br>
                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
            </div>



            <div class="form-group">
                <label for="profession">Profession</label>

                <input type="text" class="form-control" name="profession" value="{{ $user->profession }}">

                <span class="text-danger">@error('profession') {{ $message }} @enderror</span>

            </div>

            @if ($LoggedUserInfo->user_role == 'Buyer')
            <div class="form-group">
                <label for="profession">Organization</label>

                <input type="text" class="form-control" name="organization" value="{{ $buyer->organization }}">

                <span class="text-danger">@error('organization') {{ $message }} @enderror</span>

            </div>
            @endif
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea style="border: 1px solid #5298D2;" class="form-control" name="bio" id="" cols="30"
                    rows="10">{{ $user->bio }}</textarea>
                <br>
                <span class="text-danger">@error('bio') {{ $message }} @enderror</span>

            </div>
            @if ($LoggedUserInfo->user_role != 'Student' && $LoggedUserInfo->user_role != 'Buyer')
                <div class="form-group">
                    <div class="col-4">
                        <label for="experience">Experience</label>
                        <select style="border: 1px solid #5298D2;" id="experience" class="form-control" name="experience"
                            value="{{ old('experience') }}">
                            {{-- <span class="text-danger">@error('course_category') {{ $message }} @enderror</span> --}}


                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>

                        </select>

                    </div>
                </div>
            @endif
            <br>
            @if ($LoggedUserInfo->user_role == 'Seller')
                <div class="col-md-2 form-group">
                    <label for="">Hourly Rate ($)</label>

                    <input type="number" class="form-control" name="hourly_rate" value="{{ $seller->hourly_rate }}">

                    <span class="text-danger">@error('hourly_rate') {{ $message }} @enderror</span>


                </div>

                <div class="form-group">
                    <label for="Skills">Skills (Seperated by commas(,))</label>
                    <input type="text" class="form-control" name="skills" value="{{ $seller->skills }}">
                    <br>
                    <span class="text-danger">@error('skills') {{ $message }} @enderror</span>
                </div>

            @elseif ($LoggedUserInfo->user_role == 'Trainer' || $LoggedUserInfo->user_role == 'Student')



            <div class="form-group">
                <label for="Skills">Skills (Seperated by commas(,))</label>
                <input type="text" class="form-control" name="skills" value="{{ $buyer->skills }}">
                <br>
                <span class="text-danger">@error('skills') {{ $message }} @enderror</span>
            </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg" style="background-color:#5298D2">Submit</button>
            </div>



        </form>

        <div id="formFooter">

        </div>






    </div>
@endsection
