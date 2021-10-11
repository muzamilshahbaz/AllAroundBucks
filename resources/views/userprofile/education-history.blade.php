<div class="row" style="border: 1px solid black; padding: 10px">

    <div class="col-12">
        <div class="row">
            <span style="font-weight: bold; font-size: 17px;">Education History : </span>
            <div class="offset-7">
                <a href="{{ route('education-history.create') }}" class="btn btn-primary btn-sm"
                    style="background-color: #5298D2; border-radius: 2em">Add Record</a>
            </div>
        </div>
        <br>
        @forelse ($education_history as $education)
            <div class="card">

                <div class="card-body">
                    <div class="card-title">
                        <h4><b>{{ $education->degree }} | {{ $education->school_name }}</b></h4>
                    </div>
                    {{-- <span>@include('userprofile.projectrating')</span> --}}
                    <div class="card-subtitle">
                        <b> <span>{{ date('Y-m-d', strtotime($education->start_date)) }} to @if ($education->present=='present')
                                    present
                                @else
                                    {{ date('Y-m-d', strtotime($education->end_date)) }}
                                @endif</span></b>
                    </div>
                    <div class="row">
                        {{ $education->description }}
                    </div>


                    <br>
                    <div class="row offset-8">
                        <a href="{{ route('education-history.edit', $education->id) }}" class="btn btn-primary btn-sm"
                            style="background-color: #5298D2; border-radius: 2em">Edit</a>
                        <form action="{{ route('education-history.destroy', $education->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" style="border-radius: 2em; margin-left:4px"
                                type="submit">Delete</button>
                        </form>
                    </div>
                    {{-- <span style="font-weight: bold">Buyer Feedback: </span><span>{{ $project->buyer_feedback }}</span> --}}


                </div>
            </div>
        @empty

            <div class="card">

                <div class="card-body">

                    <div class="text-center">
                        <h4>No education history to show</h4>
                    </div>

                </div>
            </div>
        @endforelse

    </div>

</div>
