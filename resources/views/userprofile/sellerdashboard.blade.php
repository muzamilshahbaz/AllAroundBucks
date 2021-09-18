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
                <!-- ============================================================== -->
                <!-- Three charts -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Views</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-success">

                                        {{ $seller->views }}

                                   </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Completed Projects</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-purple">

                                    {{ $seller->total_projects }}

                                </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Earnings</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-info">

                                    ${{ $seller->earnings }}

                                </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- RECENT SALES -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Recent Projects</h3>

                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap">
                                    <thead>
                                        <tr>

                                            <th class="border-top-0">PROJECT</th>
                                            <th class="border-top-0">BUYER</th>
                                            <th class="border-top-0">STATUS</th>
                                            <th class="border-top-0">PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($projects as $project)
                                      <tr>
                                        <td>{{ $project->project_title }}</td>
                                        <td class="txt-oflo">{{ $project->buyer_username }}</td>
                                        <td>{{ $project->status }}</td>
                                        <td><span class="text-success">${{ $project->price }}</span></td>
                                    </tr>
                                      @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent Comments -->
                <!-- ============================================================== -->
                {{-- <div class="row">
                    <!-- .col -->
                    <div class="col-md-12 col-lg-8 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title mb-0">Recent Comments</h3>
                            <div class="comment-center">
                                <div class="comment-body d-flex">
                                    <div class="user-img"> <img src="/assets/users/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5><span class="time">10:20 AM 20 may 2016</span>
                                        <br>
                                        <div class="mb-3 mt-3">
                                            <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque
                                                pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui
                                                pellentesque molestie feugiat. Aenean commodo dui </span>
                                        </div>
                                        <a href="javacript:void(0)" class="btn btn btn-rounded btn-default btn-outline mb-2 mb-md-0 m-r-5"><i
                                                class="ti-check text-success m-r-5"></i>Approve</a><a href="javacript:void(0)" class="btn-rounded btn btn-default btn-outline"><i
                                                class="ti-close text-danger m-r-5"></i>
                                            Reject</a>
                                    </div>
                                </div>
                                <div class="comment-body d-flex">
                                    <div class="user-img"> <img src="/assets/users/plugins/images/users/sonu.jpg" alt="user" class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Sonu Nigam</h5><span class="time">10:20 AM 20 may 2016</span>
                                        <br>
                                        <div class="mb-3 mt-3">
                                            <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque
                                                pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui
                                                pellentesque molestie feugiat. Aenean commodo dui </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-body d-flex border-0">
                                    <div class="user-img"> <img src="/assets/users/plugins/images/users/arijit.jpg" alt="user" class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Arijit singh</h5><span class="time">10:20 AM 20 may 2016</span>
                                        <br>
                                        <div class="mb-3 mt-3">
                                            <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque
                                                pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui
                                                pellentesque molestie feugiat. Aenean commodo dui </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-heading">
                                CHAT LISTING
                            </div>
                            <div class="card-body">
                                <ul class="chatonline">
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img src="/assets/users/plugins/images/users/varun.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Varun Dhavan <small
                                                        class="d-block text-success d-block">online</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img src="/assets/users/plugins/images/users/genu.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Genelia
                                                    Deshmukh <small class="d-block text-warning">Away</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img src="/assets/users/plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Ritesh
                                                    Deshmukh <small class="d-block text-danger">Busy</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img src="/assets/users/plugins/images/users/arijit.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Arijit
                                                    Sinh <small class="d-block text-muted">Offline</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img src="/assets/users/plugins/images/users/govinda.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Govinda
                                                    Star <small class="d-block text-success">online</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img src="/assets/users/plugins/images/users/hritik.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">John
                                                    Abraham<small class="d-block text-success">online</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img src="/assets/users/plugins/images/users/varun.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Varun
                                                    Dhavan <small class="d-block text-success">online</small></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div> --}}



@endsection
