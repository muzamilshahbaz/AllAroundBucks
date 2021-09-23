@extends('layout.users')

@section('usercontent')

@foreach ($proposals as $proposal)
<div class="card" style="padding: 5px; border-radius:0.5em; border:none">

    <div class="card-body">
        <b>
            <h3>
              <a href="/project/{{ $proposal->project_id }}" style="color: #5298D2">  {{ $proposal->project_title }}</a>
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


            @if ($proposal->status == 'accept')
            <button class="col-3 offset-8 btn btn-block text-white" style="background-color: green" disabled="disabled">Accepted</button>
            @elseif ($proposal->status == 'reject')
            <button class="col-3 offset-8  btn btn-block text-white" style="background-color: rgb(207, 41, 41)" disabled="disabled">Rejected</button>

            @endif



                 </div>
    </div>

</div>
@endforeach

@endsection
