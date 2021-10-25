@extends('layout.users')

@section('usercontent')
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

    <div class="card" style="width:100%; padding: 5px; border-radius:0.5em; align-content:center; display:flex">
        <div class="py-2 px-4 border-bottom d-none d-lg-block">
            <div class="d-flex align-items-center py-1">
                <div class="position-relative">
                    @if ($LoggedUserInfo->user_id == $inbox->sender_id)
                        <a href="/user/{{ $inbox->receiver_username }}">
                            @if ($inbox->receiver_img == NULL)
                            <img src="/assets/users/userprofile/defaultprofilepic.png" class="rounded-circle mr-1"
                            width="40" height="40">
                            @else
                            <img src="/assets/users/userprofile/{{ $inbox->receiver_img }}" class="rounded-circle mr-1"
                            width="40" height="40">
                            @endif
                        </a>
                    @elseif ($LoggedUserInfo->user_id == $inbox->receiver_id)

                        <a href="/user/{{ $inbox->sender_username }}">
                            @if ($inbox->sender_img == NULL)
                            <img src="/assets/users/userprofile/defaultprofilepic.png" class="rounded-circle mr-1"
                            width="40" height="40">
                            @else
                            <img src="/assets/users/userprofile/{{ $inbox->sender_img }}" class="rounded-circle mr-1"
                            width="40" height="40">
                            @endif
                        </a>

                    @endif
                </div>
                <div class="flex-grow-1 pl-3">

                    @if ($LoggedUserInfo->user_id == $inbox->receiver_id)
                        <strong>{{ $inbox->sender_name }}</strong>
                        {{-- <div class="text-muted small"><em>Typing...</em></div> --}}
                    @elseif($LoggedUserInfo->user_id == $inbox->sender_id)
                        <strong>{{ $inbox->receiver_name }}</strong>
                        {{-- <div class="text-muted small"><em>Typing...</em></div> --}}
                    @endif
                </div>


                <div>


                    <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-more-horizontal feather-lg">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg></button>
                </div>
            </div>
        </div>

        <div class="position-relative">
            <div class="chat-messages p-4">

                @foreach ($messages as $message)
                    @if ($message->from == $LoggedUserInfo->user_id)
                        <div class="chat-message-right pb-4">
                            <div>
                                @if ($LoggedUserInfo->profile_img == null)
                                    <img src="/assets/users/userprofile/defaultprofilepic.png" class="rounded-circle mr-1"
                                        alt="Chris Wood" width="40" height="40">
                                @else
                                    <img src="/assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}"
                                        class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">

                                @endif

                                <div class="text-muted small text-nowrap mt-1">
                                    {{ date('H:m', strtotime($message->created_at)) }}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-2 mb-1 message-text-right">
                                {{ $message->message }}

                            </div>
                        </div>
                    @else
                        <div class="chat-message-left pb-4">
                            <div>
                                <div class="position-relative">
                                    @if ($LoggedUserInfo->user_id == $inbox->sender_id)
                                        <a href="/user/{{ $inbox->receiver_username }}">
                                            @if ($inbox->receiver_img == NULL)
                                            <img src="/assets/users/userprofile/defaultprofilepic.png"
                                            class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            @else
                                            <img src="/assets/users/userprofile/{{ $inbox->receiver_img }}"
                                            class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            @endif
                                        </a>
                                    @elseif ($LoggedUserInfo->user_id == $inbox->receiver_id)

                                        <a href="/user/{{ $inbox->sender_username }}">
                                            @if ($inbox->sender_img == NULL)
                                            <img src="/assets/users/userprofile/defaultprofilepic.png"
                                            class="rounded-circle mr-1" width="40" height="40">
                                            @else
                                            <img src="/assets/users/userprofile/{{ $inbox->sender_img }}"
                                            class="rounded-circle mr-1" width="40" height="40">
                                            @endif
                                        </a>

                                    @endif
                                </div>
                                <div class="text-muted small text-nowrap mt-1">
                                    {{ date('H:m', strtotime($message->created_at)) }}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-0 mb-1 message-text-left">
                                {{ $message->message }}
                            </div>
                        </div>
                    @endif

                @endforeach


            </div>
        </div>

        <div class="flex-grow-0 py-3 px-4 border-top mb-3 mr-3" style="background-color: #B0CDE0;border-radius:0.6em">

            @if ($LoggedUserInfo->user_id == $inbox->receiver_id)
                <form class="input-group" action="/send-message/{{ $inbox->sender_id }}" method="POST">
                    @csrf
                    <input type="text" name="message" class="form-control mr-3" autocomplete="off"
                        placeholder="Type your message" style="border-radius:2em">
                    <button class="send-button"><i class="material-icons"
                            style="color:white;font-size:25px">&#xe163;</i></button>
                </form>
            @elseif($LoggedUserInfo->user_id == $inbox->sender_id)
                <form class="input-group" action="/send-message/{{ $inbox->receiver_id }}" method="POST">
                    @csrf
                    <input type="text" name="message" class="form-control mr-3" autocomplete="off"
                        placeholder="Type your message" style="border-radius:2em" required>
                    <button class="send-button"><i class="material-icons"
                            style="color:white;font-size:25px">&#xe163;</i></button>
                </form>
            @endif

        </div>

    </div>
@endsection
