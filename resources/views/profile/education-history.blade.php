<div class="row" style="border: 1px solid black; padding: 10px">

    <div class="col-12">
        <div class="row">
            <span style="font-weight: bold; font-size: 17px;">Education History : </span>

        </div>
        <br>
        @forelse ($education_history as $education)
            <div class="card"
                style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">

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



                    {{-- <span style="font-weight: bold">Buyer Feedback: </span><span>{{ $project->buyer_feedback }}</span> --}}


                </div>
            </div>
        @empty

            <div class="card"
                style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">

                <div class="card-body">

                    <div class="text-center">
                        <h4>No education history to show</h4>
                    </div>

                </div>
            </div>
        @endforelse

    </div>

</div>
