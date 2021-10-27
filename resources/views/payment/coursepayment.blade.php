@extends('layout.users')

@section('usercontent')
    <link rel="stylesheet" href="/assets/css/signup.css">
    <div class="card" style="padding: 5px; border-radius:0.5em; border:none;">
        <div class="card-body">
            <div class="card-title">
                <h4>Payment for the <b style="color: #0f1137"><i>"{{ $course->course_title }}"</i></b> Course</h4>
            </div>
            <br>
            <h5><b>Trainer: </b>{{ $course->trainer }}</h5>
            <h5><b>Student: </b>{{ $LoggedUserInfo->username }}</h5>
            <br>
            <div class="row">
                <div class="col-6">
                    <b>Course Duration: </b>{{ $course->course_duration }} minutes
                </div>
                <div class="col-6">
                    <b>Course Price: </b>${{ $course->course_price }}
                </div>
            </div>
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
            <div class="signup-form" style="width:55%">
                <form
                role="form"
                action="/course-paid/{{ $course->course_id }}"
                method="POST"
                class="require-validation"
                data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                id="payment-form" style="color: #0f1137">
            @csrf


                <div class="row">
                    <div class="col-12">
                        <div class='form-group required'>
                            <label class='control-label'>Name on Card</label> <input
                                class='form-control' size='4' type='text' name="card_holder" value="{{ old('card_holder') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class='form-group required'>
                            <label class='control-label'>Card Number</label> <input
                                autocomplete='off' class='form-control card-number' size='20'
                                type='text' onkeypress='validate(event)'name="card_number">
                        </div>
                    </div>
                </div>

            <div class='row'>
            <div class="col-4">
                <div class='form-group cvc required'>
                    <label class='control-label'>CVC</label> <input autocomplete='off'
                        class='form-control card-cvc' placeholder='3 or 4 digits' maxlength="4" size='4'
                        type='password' onkeypress='validate(event)' name="cvc">
                </div>
            </div>
               <div class="col-4">
                <div class='form-group expiration required'>
                    <label class='control-label'>Expiration Month</label> <input
                        class='form-control card-expiry-month' placeholder='MM' size='2'
                        type='text' onkeypress='validate(event)' maxlength="2" name="month">
                </div>
               </div>
              <div class="col-4">
                <div class='form-group expiration required'>
                    <label class='control-label'>Expiration Year</label> <input
                        class='form-control card-expiry-year' placeholder='YYYY' size='4'
                        type='text' maxlength="4" name="year" onkeypress="validate(event)">
                </div>
              </div>
            </div>

            <div class='form-row row'>
                <div class='col-md-12 error form-group hide'>
                    <div class='alert-danger alert'>Please correct the errors and try
                        again.</div>
                </div>
            </div>
<br>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" id="submit-btn">Pay
                    ${{ $course->course_price }}</button>
            </div>

        </form>
                {{-- <form action="/acceptAndPay/{{ $proposal->proposal_id }}" method="POST" enctype="multipart/form-data"
                    style="color: #5298D2" class="require-validation" data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf



                    <div class="text-center">
                        <h3>Payment Information</h3>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="ch_first_name" id="#first-name"
                                    value="{{ old('ch_first_name') }}" placeholder="Card Holder First Name" required>
                                <span class="text-danger">@error('ch_first_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="ch_last_name" id="#last-name"
                                    placeholder="Card Holder Last Name" value="{{ old('ch_last_name') }}" required>
                                <span class="text-danger">@error('ch_last_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Card Number</label>
                                <input type="text" class="form-control" name="card_number"
                                    placeholder="Debit or Credit Card Number" value="{{ old('card_number') }}"
                                    id="#card-number" onkeypress='validate(event)' maxlength="19" required>
                                <span class="text-danger">@error('card_number') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Security Code</label>
                                <input type="password" class="form-control" onkeypress='validate(event)' name="cvc"
                                    id="#cvc" placeholder="CVC, 3 or 4 digits" value="{{ old('cvc') }}" maxlength="4"
                                    required>
                                <span class="text-danger">@error('cvc') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Expiry Month</label>
                                <input type="text" class="form-control" name="expiry_month" id="#expiry-month"
                                    value="{{ old('expiry_month') }}" placeholder="MM" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Expiry Year</label>
                                <input type="text" class="form-control" name="expiry_year" id="#expiry-year"
                                    value="{{ old('expiry_year') }}" placeholder="YYYY" required>
                            </div>
                        </div>


                    </div>
                    <div class='form-row row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="background-color: #5298D2; border: 0ch">Pay
                            ${{ $proposal->price }}</button>
                    </div>
                </form> --}}

            </div>

        </div>
    </div>

@endsection
