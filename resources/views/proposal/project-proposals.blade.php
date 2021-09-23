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

@if ($proposals->isEmpty())
<center><h3>There is no proposal for this project</h3></center>
@else
@foreach ($proposals as $proposal)
<div class="card" style="padding: 5px; border-radius:0.5em; border:none">
    <div class="card-body">
        <b>
            <h3>
              Seller: <a href="/user/{{ $proposal->seller_username}}" style="color: #5298D2">  {{ $proposal->seller_username }}</a>
            </h3>

        </b>
        <br>
        <div class="row">
            <div class="col-6">
            <b>Duration:</b> {{ $proposal->duration }} {{ $proposal->duration_format }}
            </div>
            <div class="col-6">
                <b>Price:</b> ${{ $proposal->price }}
            </div>

        </div>
<br>
        <div class="row">
            <div class="col-12">
                <b>Cover Letter:</b>
                <p>{{ $proposal->cover_letter }}</p>
            </div>
        </div>

           <div class="row">


      @if ($proposal->status == NULL)
      <div class="col-2 offset-8">
        <a href="/accept-proposal/{{ $proposal->proposal_id }}" class="btn btn-block btn-success text-white"><center>Accept</center></a>
    </div>
    <div class="col-2">
        <a href="/reject-proposal/{{ $proposal->proposal_id }}" class="btn btn-block btn-danger"><center>Reject</center></a>

    </div>
      @elseif ($proposal->status == 'accept')
      <button class="col-3 offset-8 btn btn-block text-white" style="background-color: green" disabled="disabled">Accepted</button>
      @elseif ($proposal->status == 'reject')
      <button class="col-3 offset-8  btn btn-block text-white" style="background-color: rgb(207, 41, 41)" disabled="disabled">You Rejected this Proposal</button>

      @endif



           </div>
    </div>

</div>
@endforeach
@endif

@endsection
