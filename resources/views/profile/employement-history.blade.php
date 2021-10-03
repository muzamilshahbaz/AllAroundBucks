<div class="row" style="border: 1px solid black; padding: 10px">

    <div class="col-12">
        <div class="row">
            <span style="font-weight: bold; font-size: 17px;">Employement History : </span>

        </div>
        <br>
        @forelse ($employement_history as $work)
            <div class="card"
                style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">

                <div class="card-body">
                    <div class="card-title">
                        <h4><b>{{ $work->employement_title }} | {{ $work->company_name }}</b></h4>
                    </div>
                    {{-- <span>@include('userprofile.projectrating')</span> --}}
                    <div class="card-subtitle">
                        <b> <span>{{ date('Y-m-d', strtotime($work->start_date)) }} to @if ($work->present=='present')
                                    present
                                @else
                                    {{ date('Y-m-d', strtotime($work->end_date)) }}
                                @endif</span></b>
                    </div>
                    <div class="row">
                        {{ $work->description }}
                    </div>



                    {{-- <span style="font-weight: bold">Buyer Feedback: </span><span>{{ $project->buyer_feedback }}</span> --}}


                </div>
            </div>
        @empty

            <div class="card"
                style="background-color: rgb(229, 235, 150); padding: 5px; border-radius:0.5em; border:none">

                <div class="card-body">

                    <div class="text-center">
                        <h4>No employement history to show</h4>
                    </div>

                </div>
            </div>
        @endforelse

    </div>

</div>
