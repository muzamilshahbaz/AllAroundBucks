@extends('layout.users')

@section('usercontent')
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}" /> --}}

    <link rel="stylesheet" href="\assets\css\inbox.css">

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
    <div class="col-12">

        {{-- <div class="px-4 d-none d-md-block">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <input type="text" class="form-control my-3" placeholder="Search...">
                </div>
            </div>
        </div> --}}

        @if (!$inbox->isEmpty())
            <div class="text-center">
                <h3 class="mb-4">Select a chat below</h3>
            </div>
            <div class="row">

                @foreach ($inbox as $chat)
                    <div class="col-3">
                        @if ($LoggedUserInfo->user_id == $chat->sender_id)
                        <a href="/chat/{{ $chat->id }}">

                            <div class="card"
                                style="width:100%; height:auto; padding: 5px; border-radius:0.5em; border:none;">
                                <div class="card-body">
                                    {{-- <div class="badge bg-success float-right">5</div> --}}
                                    <div class="d-flex align-items-start">
                                        <img src="/assets/users/userprofile/{{ $chat->receiver_img }}"
                                            class="rounded-circle mr-1" alt="" width="40" height="40">
                                        <div class="flex-grow-1 ml-3">
                                            {{ $chat->receiver_name }}
                                            {{-- <div class="small"><span class="fas fa-circle chat-online"></span> Online</div> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    @elseif ($LoggedUserInfo->user_id == $chat->receiver_id)

                    <a href="/chat/{{ $chat->id }}">

                        <div class="card"
                            style="width:100%; height:auto; padding: 5px; border-radius:0.5em; border:none;">
                            <div class="card-body">
                                {{-- <div class="badge bg-success float-right">5</div> --}}
                                <div class="d-flex align-items-start">
                                    @if ($chat->sender_img == NULL)
                                    <img src="/assets/users/userprofile/defaultprofilepic.png"
                                    class="rounded-circle mr-1" alt="" width="40" height="40">
                                    @else
                                    <img src="/assets/users/userprofile/{{ $chat->sender_img }}"
                                    class="rounded-circle mr-1" alt="" width="40" height="40">
                                    @endif
                                    <div class="flex-grow-1 ml-3">
                                        {{ $chat->sender_name }}
                                        {{-- <div class="small"><span class="fas fa-circle chat-online"></span> Online</div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>

                    @endif

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center">
                No chat to show.
            </div>
        @endif


    </div>

@endsection
