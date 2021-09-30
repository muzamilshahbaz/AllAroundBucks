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
<div class="signup-form" style="width: 60%">

<form action="/projectSend/{{ $project->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" value="{{ $project->id }}">
    <div class="text-center">
        <h3>Send Your Project</h3>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="message" id="" cols="30" rows="10" placeholder="Type your message...." required></textarea>
        <span class="text-danger">@error('message') {{ $message }} @enderror</span>
    </div>

    <div class="form-group">
        <label for="project-file" style="color: #5298D2">Upload Project File <br> (Note: File must be in zip or rar.)</label> <br>
        <input type="file" class="form-control" name="project_file" required>
        <span class="text-danger">@error('project_file') {{ $message }} @enderror</span>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary" style="background-color: #5298D2; border: 0ch">Send Project</button>
    </div>

</form>
</div>
@endsection
