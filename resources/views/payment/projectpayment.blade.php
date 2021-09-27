@extends('layout.users')

@section('usercontent')

<div class="card" style="padding: 5px; border-radius:0.5em; border:none;">
    <div class="card-body">
<div class="card-title"><h4>Payment for the <b style="color: #5298D2"><i>"{{ $project->project_title }}"</i></b> Project</h4></div>
<br>
<h5><b>Buyer: </b>{{ $proposal->buyer_username }}</h5>
<h5><b>Seller: </b>{{ $proposal->seller_username }}</h5>
<br>
<div class="row">
    <div class="col-6">
        <b>Proposed Duration: </b>{{ $proposal->duration }} {{ $proposal->duration_format }}
    </div>
    <div class="col-6">
        <b>Proposed Price: </b>${{ $proposal->price }}
    </div>
</div>
<br><br><br>
<div class="text-center">
    <a href="/acceptAndPay/{{ $proposal->proposal_id }}" class="btn btn-primary" style="background-color: #5298D2; border-radius:0.5em">Pay ${{ $proposal->price }}</a>
</div>
 </div>
</div>

@endsection
