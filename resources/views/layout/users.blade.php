<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->

    <link href="/assets/users/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/users/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <link href="/assets/users/css/style.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/fonts.google.icons.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/users/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/projects.css">
    <link rel="stylesheet" href="/assets/css/userprofile.css">
    <!-- ============================================================== -->



    <title>{{ $title }} - AllAroundBucks</title>

    <style>
html,
body {
    height: 100%;
    width: 100%;
    color: black;
    overflow-x: hidden;
    font-family:'Montserrat', sans-serif;
    background-color: white;
}
/* Click on profile pic pop up */

.popup .overlay {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1;
    display: none;
}

.popup .links{
    background-color: tomato;
    border:0ch;
    font-weight: bold;
}
.popup .links:hover,.popup .links:focus,.popup .links:active{
    background-color: tomato !important;
    border:0ch !important;
    font-weight: bold !important;
}

.popup .link-logout{
    background-color: white;
    color: tomato;
    border:2px solid tomato;
    font-weight: bold;
}

.popup .link-logout:hover,.popup .link-logout:active,.popup .link-logout:focus{
    background-color: tomato !important;
    color:white !important;
    font-weight: bold !important;
    border:0ch !important;
}

.popup .content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    background: #fff;
    width: 95%;
    max-width: 500px;
    height: 250px;
    z-index: 2;
    text-align: center;
    padding: 20px;
    box-sizing: border-box;
    font-family: "Open Sans", sans-serif;
}

.popup .close-btn {
    cursor: pointer;
    position: absolute;
    right: 20px;
    top: 20px;
    width: 30px;
    height: 30px;
    background:white;
    color: tomato;
    border: 1px solid tomato;
    font-size: 25px;
    font-weight: 600;
    line-height: 30px;
    text-align: center;
    border-radius: 50%;
}

.popup .close-btn:hover{
    background:tomato;
    color: white;
}

.popup.active .overlay {
    display: block;
}

.popup.active .content {
    transition: all 300ms ease-in-out;
    transform: translate(-50%, -50%) scale(1);
}

button{
    background-color: tomato;
    border: 0ch;
}

/* Style the tab */

.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}


/* Style the buttons inside the tab */

.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}


/* Change background color of buttons on hover */

.tab button:hover {
    background-color: tomato;
    color: white;
}


/* Create an active/current tablink class */

.tab button.active {
    background-color: tomato;
    color: white;
}


/* Style the tab content */

.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}

/* End of pop up */

    </style>

</head>

<body>



@section('username')

        {{ $LoggedUserInfo -> username }}

@endsection

@section('navProfileImg')

@if ($LoggedUserInfo->profile_img == NULL)
<img src="assets/users/userprofile/defaultprofilepic.png" alt="user-img" width="36" height="36" class="img-circle">
@else
<img src="assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}" alt="user-img" width="36" height="36" class="img-circle">

@endif
@endsection

@section('popProfileImg')

@if ($LoggedUserInfo->profile_img == NULL)
<img src="assets/users/userprofile/defaultprofilepic.png" alt="user-img" width="36" height="36" class="img-circle">

@else
<img src="assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}" alt="user-img" width="36" height="36" class="img-circle">

@endif
@endsection

@section('sideNavLinks')
@if ($LoggedUserInfo->user_role != NULL)
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/profile" aria-expanded="false">

        <span class="hide-menu">Profile</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/inbox" aria-expanded="false">

        <span class="hide-menu">Messages</span>
    </a>
</li>

@endif

@if ($LoggedUserInfo -> user_role == 'Seller' || $LoggedUserInfo -> user_role == 'Trainer')

<li class="sidebar-item pt-2">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard" aria-expanded="false">

        <span class="hide-menu">Dashboard</span>
    </a>
</li>

@endif

@if ($LoggedUserInfo -> user_role == 'Seller')
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/projectsfeed" aria-expanded="false">

        <span class="hide-menu">Projects Feed</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/projectsstatus" aria-expanded="false">

        <span class="hide-menu">Projects Status</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/proposals" aria-expanded="false">

        <span class="hide-menu">Proposals</span>
    </a>
</li>

@endif

@if ($LoggedUserInfo -> user_role == 'Buyer')

<li class="sidebar-item pt-2">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/hiredirect" aria-expanded="false">

        <span class="hide-menu">Hire Directly</span>
    </a>
</li>

<li class="sidebar-item pt-2">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/projects" aria-expanded="false">

        <span class="hide-menu">Your Projects</span>
    </a>
</li>

@endif

@if ($LoggedUserInfo -> user_role == 'Trainer')

<li class="sidebar-item pt-2">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/courses" aria-expanded="false">

        <span class="hide-menu">Your Courses</span>
    </a>
</li>

@endif

@if ($LoggedUserInfo -> user_role == 'Seller' || $LoggedUserInfo -> user_role == 'Trainer')

<li class="sidebar-item pt-2">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/earnings" aria-expanded="false">

        <span class="hide-menu">Earnings</span>
    </a>
</li>

@endif

@if ($LoggedUserInfo -> user_role == 'Student')

<li class="sidebar-item pt-2">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/courses" aria-expanded="false">

        <span class="hide-menu">Course Feed</span>
    </a>
</li>
<li class="sidebar-item pt-2">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/courses" aria-expanded="false">

        <span class="hide-menu">Your Courses</span>
    </a>
</li>

@endif






@endsection

   <x-preloader/>

   <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    <x-navbar/>


 <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        @if ($LoggedUserInfo -> user_role == 'Seller' || $LoggedUserInfo -> user_role == 'Trainer')

                        <h4 class="page-title text-uppercase font-medium font-14">{{ $LoggedUserInfo -> user_role }}  {{ $pageName }}</h4>

                        @elseif ($LoggedUserInfo -> user_role == 'Student' || $LoggedUserInfo -> user_role == 'Buyer')

                        <h4 class="page-title text-uppercase font-medium font-14">{{ $pageName }}</h4>

                        @endif

                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">

                                @if ($LoggedUserInfo -> user_role == 'Seller' || $LoggedUserInfo -> user_role == 'Trainer')

                                <li><a href="/dashboard">Dashboard</a></li>

                                @elseif ($LoggedUserInfo -> user_role == 'Buyer')

                                <li><a href="/hiredirect">Hire Direct</a></li>

                                @elseif ($LoggedUserInfo -> user_role == 'Student')

                                <li><a href="/courses">Courses Marketplace</a></li>


                                @endif

                            </ol>
                            <a class="btn btn-danger  d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" style="background-color: tomato">

                              Role: {{ $LoggedUserInfo -> user_role }}



                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- End Bread crumb and right sidebar toggle -->

 <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

              @yield('usercontent')

            </div>

            <!-- End Container fluid  -->

            <!-- footer -->
<x-footer/>


        </div>

        <!-- End Page wrapper  -->

    </div>
    <script src="/assets/users/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/assets/users/plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="/assets/users/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/users/js/app-style-switcher.js"></script>
    <script src="/assets/users/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="/assets/users/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/assets/users/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/assets/users/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="/assets/users/plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="/assets/users/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="/assets/users/js/pages/dashboards/dashboard1.js"></script>
    <script src="/assets/js/app.js"></script>


</body>
</html>
