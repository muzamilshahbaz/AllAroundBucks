@extends('layout.users')

@section('usercontent')

    {{-- <link rel="stylesheet" href="\assets\css\inbox.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> --}}
    <main-app></main-app>

@endsection

{{-- <div class="container p-0">

    <div class="card" style="padding: 5px; border-radius:0.5em; border: 1px solid #5298D2">
        <div class="row g-0">
            <div class="col-12 col-lg-5 col-xl-3 border-right">

                <div class="px-4 d-none d-md-block">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control my-3" placeholder="Search...">
                        </div>
                    </div>
                </div>

                <a href="#" class="list-group-item list-group-item-action border-0">
                    <div class="badge bg-success float-right">5</div>
                    <div class="d-flex align-items-start">
                        <img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1"
                            alt="Vanessa Tucker" width="40" height="40">
                        <div class="flex-grow-1 ml-3">
                            Vanessa Tucker
                            <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                        </div>
                    </div>
                </a>

                <hr class="d-block d-lg-none mt-1 mb-0">
            </div>
            <div class="col-12 col-lg-7 col-xl-9">
                <div class="py-2 px-4 border-bottom d-none d-lg-block">
                    <div class="d-flex align-items-center py-1">
                        <div class="position-relative">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1"
                                alt="Sharon Lessman" width="40" height="40">
                        </div>
                        <div class="flex-grow-1 pl-3">
                            <strong>Sharon Lessman</strong> --}}
                            {{-- <div class="text-muted small"><em>Typing...</em></div> --}}
                        {{-- </div> --}}
                        {{-- <div>
                            <button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-phone feather-lg">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg></button>
                            <button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-video feather-lg">
                                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                </svg></button>
                            <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-more-horizontal feather-lg">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg></button>
                        </div> --}}
                    {{-- </div>
                </div>

                <div class="position-relative">
                    <div class="chat-messages p-4">

                        <div class="chat-message-right pb-4">
                            <div>
                                @if ($LoggedUserInfo->profile_img == null)
                                <img src="/assets/users/userprofile/defaultprofilepic.png" class="rounded-circle mr-1"
                                alt="Chris Wood" width="40" height="40">
                                @else
                                <img src="/assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}" class="rounded-circle mr-1"
                                alt="Chris Wood" width="40" height="40">

                                @endif

                                <div class="text-muted small text-nowrap mt-1">2:33 am</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-2 mb-1 message-text-right">

                                Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                            </div>
                        </div>

                        <div class="chat-message-left pb-4">
                            <div>
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                    class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-1">2:34 am</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-0 mb-1 message-text-left">

                                Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                            </div>
                        </div>


                    </div>
                </div>

                <div class="flex-grow-0 py-3 px-4 border-top mb-3 mr-3" style="background-color: #5298D2;border-radius:0.6em">
                    <form class="input-group" action="#">
                        <input type="hidden" class="incoming_id" name="incoming_id" value="{{ $LoggedUserInfo->username }}">
                        <input type="text" name="message" class="form-control mr-3" autocomplete="off" placeholder="Type your message" style="border-radius:2em">
                        <button class="send-button"><i class="fa fa-send" style="color:white;font-size:20px"></i> </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div> --}}
