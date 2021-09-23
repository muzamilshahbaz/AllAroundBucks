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

<form action="/projectSend/{{ $project->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" value="{{ $project->id }}">

    <div class="form-group">
        <textarea class="form-control" name="message" id="" cols="30" rows="10" placeholder="Type your message...."></textarea>
        <span class="text-danger">@error('message') {{ $message }} @enderror</span>
    </div>

    <div class="form-group">
        <label for="project-file" class="form-control">Upload Project File <br> (Note: If it is a folder upload the zip folder.)</label>
        <input type="file" class="form-control" name="project_file">
        <span class="text-danger">@error('project_file') {{ $message }} @enderror</span>
    </div>
<br>
    <div class="form-group">
        <button type="submit" class="col-3 offset-8 btn btn-primary btn-lg btn-block" style="background-color: #5298D2; border: 0ch">Send Project</button>
    </div>

</form>

@endsection
