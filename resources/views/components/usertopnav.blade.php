   <!-- Topbar header-->

        <header class="topbar sticky-top" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark sticky-top" style="position: sticky;">
                <a href="/" class="navbar-brand"><b><span>AllAroundBucks</span></b></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5" style="background-color: #B0CDE0 !important">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>

                    <!-- Right side toggle and nav items -->

                    <ul class="navbar-nav ml-auto d-flex align-items-center">

                        <!-- Search -->
                        {{-- <li class="in">
                            <form role="search" class="app-search d-none d-md-block mr-3">
                                @csrf
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li> --}}
                        <!-- User profile and search -->
                        <li>
                            <button class="profile-pic" style="color: #0f1137; outline: none !important" onclick="togglePopup()">
                                @yield('navProfileImg')
                                <span>

                                    @yield('username')

                                </span></button>
                        </li>
                        <!-- User profile and search -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- End Topbar header -->


        <div class="popup" id="popup-1">
            <div class="overlay"></div>
            <div class="content">
              <div class="close-btn" onclick="togglePopup()">×</div>

                @yield('popProfileImg')

<br><br>

                <a href="/profile" class="col-12 btn btn-primary links" id="submit-btn">Profile</a>
                <br><br>
                <a href="/settings" class="col-12 btn btn-primary links" id="submit-btn">Settings</a>
                <br><br>
                <a href="/logout" class="col-12 btn btn-primary link-logout">Logout</a>


           </div>
          </div>

