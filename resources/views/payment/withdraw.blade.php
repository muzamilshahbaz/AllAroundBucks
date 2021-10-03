@extends('layout.users')

@section('usercontent')
    <link rel="stylesheet" href="/assets/css/signup.css">

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
        <form role="form" action="/withdraw-earnings" method="POST" class="require-withdraw-validation"
            {{-- data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" --}} id="withdraw-form"
            style="color: #5298D2">
            @csrf

            <div class="text-center">
                <h3>Withdraw Earnings</h3>
            </div>
<input type="hidden" name="withdrawal_amount" value="{{ $withdrawal_user->amount_for_withdrawals }}">
            <div class="row">
                <div class="col-12">
                    <div class='form-group required'>
                        <label class='control-label'>Add Stripe Account Number</label> <input
                            style="border: 1px solid #5298D2; border-radius:0.6em"
                            class='form-control stripe-account-number' size='25' autocomplete='off' type='text'
                            name="stripe_account" value="{{ old('stripe_account') }}"
                            placeholder="e.g., acct_1JCk91L4O6QXQqcA">
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
                <button type="submit" class="btn btn-primary" style="background-color: #5298D2; border: 0ch">Withdraw
                    ${{ $withdrawal_user->amount_for_withdrawals }}</button>
            </div>

        </form>
    </div>


@endsection
