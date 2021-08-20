@extends('layout.users')

@section('usercontent')

<div class="signup-form">
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
    <br><br>
          <!-- Icon -->
          <div class="fadeIn first">
            <h3>Update Profile</h3>
          </div>
    <br>
          <!-- Login Form -->
          <form action="/updateprofile/@if ($LoggedUserInfo->user_role == 'Seller')
            @php
                $id = $seller->seller_id
            @endphp
            {{ $id }}
            @elseif ($LoggedUserInfo->user_role == 'Buyer')
            @php
            $id = $buyer->buyer_id
            @endphp
            {{ $id }}
            @elseif ($LoggedUserInfo->user_role == 'Trainer')
            @php
            $id = $trainer->trainer_id
            @endphp
            {{ $id }}
            @elseif ($LoggedUserInfo->user_role == 'Student')
            @php
            $id = $student->student_id
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

            <br>

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





            <div class="col-md-4">
                <div class="profile-img">
                    <img src="assets/users/userprofile/{{ $LoggedUserInfo -> profile_img }}" alt="user-img" width="50" class="img-circle">
                    <input type="file" class="form-control" name="profile_img" value="{{ $LoggedUserInfo->profile_img }}">
                </div>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            <br>
            <span class="text-danger">@error('name') {{ $message }}  @enderror</span>
            </div>



           <div class="form-group">
            <label for="profession">Profession</label>

           <input type="text" class="form-control" name="profession" value="{{ $user->profession }}">

           <span class="text-danger">@error('profession') {{ $message }}  @enderror</span>



           </div>
           <div class="form-group">
            <label for="bio">Bio</label>
            <textarea class="form-control" name="bio" id="" cols="30" rows="10">{{ $user->bio }}</textarea>
            <br>
            <span class="text-danger">@error('bio') {{ $message }}  @enderror</span>

           </div>
   @if ($LoggedUserInfo -> user_role != 'Student')
   <div class="form-group">
    <div class="col-4">
        <label for="experience">Experience</label>
        <select id="experience" class="form-control" name="experience" value="{{ old('experience') }}">
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

 <input type="number"  class="form-control" name="hourly_rate" value="{{ $seller->hourly_rate }}">

 <span class="text-danger">@error('hourly_rate') {{ $message }}  @enderror</span>


</div>

<div class="form-group">
 <label for="Skills">Skills (Seperated by commas(,))</label>
 <input type="text" class="form-control" name="skills" value="{{ $seller->skills }}">
<br>
<span class="text-danger">@error('skills') {{ $message }}  @enderror</span>
</div>

  @elseif ($LoggedUserInfo->user_role == 'Trainer')


<div class="form-group">
 <label for="Skills">Work Experience</label>
 <input type="text" class="form-control" name="work_experience" value="{{ $trainer->work_experience }}">
<br>
<span class="text-danger">@error('skills') {{ $message }}  @enderror</span>
</div>
  @endif
            <input type="submit" id="login-submit"  class="col-md-2 offset-5 form-control"  value="Save" style="background-color: tomato; color:white; border: 0ch">




          </form>

          <div id="formFooter">

          </div>

        </div>


      </div>

</div>
@endsection
