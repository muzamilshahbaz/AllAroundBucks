<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/assets/css/notify.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="/assets/users/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="/assets/users/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <link href="/assets/users/css/style.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/fonts.google.icons.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/users/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/projects.css">

    <link rel="stylesheet" href="/assets/css/userprofile.css">
    <style>
        .chat {
          list-style: none;
          margin: 0;
          padding: 0;
        }

        .chat li {
          margin-bottom: 10px;
          padding-bottom: 5px;
          border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
          margin: 0;
          color: #777777;
        }

        .panel-body {
          overflow-y: scroll;
          height: 350px;
        }

        ::-webkit-scrollbar-track {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
          background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
          width: 12px;
          background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
          background-color: #555;
        }
      </style>
    <!-- ============================================================== -->
    <link rel="stylesheet" href="/assets/css/backToTop.css">
    <x-embed-styles />


    <title>{{ $title }} - AllAroundBucks</title>

</head>

<body>

<!-- Back to top button -->
<a id="backToTop"></a>

    @section('username')

        {{ $LoggedUserInfo->username }}

    @endsection

    @section('navProfileImg')

        @if ($LoggedUserInfo->profile_img == null)
            <img src="/assets/users/userprofile/defaultprofilepic.png" alt="user-img" width="36" height="36"
                class="img-circle">
        @else
            <img src="/assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}" alt="user-img" width="36" height="36"
                class="img-circle">

        @endif
    @endsection

    @section('popProfileImg')

        @if ($LoggedUserInfo->profile_img == null)
            <img src="/assets/users/userprofile/defaultprofilepic.png" alt="user-img" width="60" height="60"
                class="img-circle" style="border-radius: 50%">

        @else
            <img src="/assets/users/userprofile/{{ $LoggedUserInfo->profile_img }}" alt="user-img" width="60" height="60"
                class="img-circle" style="border-radius: 50%">

        @endif
    @endsection

    @section('sideNavLinks')
        @if ($LoggedUserInfo->user_role != null)
            <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/profile" aria-expanded="false">

                    <span class="hide-menu">Profile</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/inbox" aria-expanded="false">

                    <span class="hide-menu">Chats </span>
                </a>
            </li>

        @endif

        @if ($LoggedUserInfo->user_role == 'Seller' || $LoggedUserInfo->user_role == 'Trainer')

            <li class="sidebar-item pt-2">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard" aria-expanded="false">

                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

        @endif

        @if ($LoggedUserInfo->user_role == 'Seller')
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

        @if ($LoggedUserInfo->user_role == 'Buyer')

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

        @if ($LoggedUserInfo->user_role == 'Trainer')

            <li class="sidebar-item pt-2">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/courses" aria-expanded="false">

                    <span class="hide-menu">Your Courses</span>
                </a>
            </li>

        @endif

        @if ($LoggedUserInfo->user_role == 'Seller')

            <li class="sidebar-item pt-2">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/sellerearnings" aria-expanded="false">

                    <span class="hide-menu">Earnings</span>
                </a>
            </li>

        @endif

        @if ($LoggedUserInfo->user_role == 'Trainer')

            <li class="sidebar-item pt-2">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/trainerearnings" aria-expanded="false">

                    <span class="hide-menu">Earnings</span>
                </a>
            </li>

        @endif

        @if ($LoggedUserInfo->user_role == 'Student')

            <li class="sidebar-item pt-2">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/courses" aria-expanded="false">

                    <span class="hide-menu">Course Feed</span>
                </a>
            </li>
            <li class="sidebar-item pt-2">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/student-courses" aria-expanded="false">

                    <span class="hide-menu">Your Courses</span>
                </a>
            </li>

        @endif






    @endsection

    <x-preloader />

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <x-navbar />


        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        @if ($LoggedUserInfo->user_role == 'Seller' || $LoggedUserInfo->user_role == 'Trainer')

                            <h4 class="page-title text-uppercase font-medium font-14">
                                {{ $LoggedUserInfo->user_role }} {{ $pageName }}</h4>

                        @elseif ($LoggedUserInfo->user_role == 'Student' || $LoggedUserInfo->user_role ==
                            'Buyer')

                            <h4 class="page-title text-uppercase font-medium font-14">{{ $pageName }}</h4>

                        @endif

                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">

                                @if ($LoggedUserInfo->user_role == 'Seller' || $LoggedUserInfo->user_role == 'Trainer')

                                    <li><a href="/dashboard">Dashboard</a></li>

                                @elseif ($LoggedUserInfo -> user_role == 'Buyer')

                                    <li><a href="/hiredirect">Hire Direct</a></li>

                                @elseif ($LoggedUserInfo -> user_role == 'Student')

                                    <li><a href="/courses">Courses Marketplace</a></li>


                                @endif

                            </ol>
                            <button onclick="rolePopup()"
                                class="btn btn-primary d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"
                                style="background-color: #5298D2; border-radius:0.5em">

                                Role: {{ $LoggedUserInfo->user_role }}

                            </button>

                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- End Bread crumb and right sidebar toggle -->

            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" style="background-color: rgba(252, 246, 246, 0.692) ">

                @yield('usercontent')

            </div>

            <!-- End Container fluid  -->

            <!-- footer -->
            <x-footer />


        </div>

        <!-- End Page wrapper  -->

    </div>

    <div class="popup" id="popup-2">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="rolePopup()">×</div>
            @yield('popProfileImg')
            <br><br>
            <div class="text-center" style="font-weight:bold">
                Your Current Role: {{ $LoggedUserInfo->user_role }}
            </div>
            <br>
            <form action="/change-role" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="user-role">Switch To:</label>
                    <select class="form-control" name="user_role" style="border: 1px solid #5298D2 ">
                        @foreach ($roles as $role)
                            @if ($role->role_title != $LoggedUserInfo->user_role)
                                <option value="{{ $role->role_title }}">{{ $role->role_title }}</option>
                            @endif
                        @endforeach


                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg"
                        style="background-color: rgba(82, 152, 210, 1); border-radius: 1em">Submit</button>
                </div>


            </form>
        </div>
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
    <script src="/assets/users/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
    </script>
    <script src="/assets/users/js/pages/dashboards/dashboard1.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/inbox.js"></script>

    <script>
        function disableEnd() {
            // Get the checkbox
            var checkBox = document.getElementById("present");

            var end_date = document.getElementById("end-date");


            if (checkBox.checked == true) {
                end_date.disabled = true;
                end_date.value = null;
            } else {
                end_date.disabled = false;
            }
        }

        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
    <script type="text/javascript" src="/assets/js/stripe.js"></script>

    <script type="text/javascript">
        $(function() {

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>

{{-- <script type="text/javascript">
    $(function() {

        var $form = $(".require-withdraw-validation");

        $('form.require-withdraw-validation').bind('submit', function(e) {
            var $form = $(".require-withdraw-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.stripe-account-number').val(),
                }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script> --}}
<script src="/assets/js/backToTop.js"></script>
</body>

</html>
