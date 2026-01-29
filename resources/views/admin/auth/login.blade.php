<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="{{ env('APP_NAME') }} admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, {{ env('APP_NAME') }} admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - {{ env('APP_NAME') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/favicon.ico') }}">

    <link rel="apple-touch-icon" href="{{ url('public/dashboard-assets/app-assets/images/ico/apple-icon-120.png') }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/dashboard-assets/app-assets/images/ico/favicon.ico')}}"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-assets/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-assets/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-assets/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-assets/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <style>
        .form-label {
            margin-bottom: 0.2857rem;
            font-size: 0.857rem;
            color: #000;
        }

        h4 {
            color: #000;
        }

        p {
            color: #000;
        }
    </style>


    <style>


        /* .content-body {
            background-image: url("{{ url('public/back.gif') }}");
        } */

        /* .card {
            color: #000;
            background-image: linear-gradient(210deg, var(--primary-color), #000);
            background: linear-gradient(130deg, #00cfe8, #010102);
        } */


        /* .card .card-title {
            color: #000;
            font-size: 20px !important;
        }

        .form-control:focus {
            color: #000;
        }

        .form-control {
            color: #000;
        } */
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content " style="">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0" style="">
                            <div class="card-body">
                                <!--<a href="#" class="brand-logo">-->
                                <!--    <img src="{{ url('public/dashboard-assets/logo.png') }}" alt="" width="177">-->
                                <!--    {{-- <h2 class="brand-text text-primary ms-1" style="color:#386fb9 !important;">Premad Software Solution</h2> --}}-->
                                <!--</a>-->

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <div class="alert-body">
                                                {{ $error }}
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endforeach
                                @endif

                                <h4 class="card-title mb-1">Welcome to {{ env('APP_NAME') }}!</h4>
                                <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

                                <form class="auth-login-form mt-2" action="{{ route('admin.check_login') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-1">
                                        <label for="login-email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="login-email" name="email"
                                            placeholder="john@example.com" aria-describedby="login-email"
                                            tabindex="1" autofocus />
                                    </div>

                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password">Password</label>
                                            {{-- <a href="auth-forgot-password-basic.html">
                                                <small>Forgot Password?</small>
                                            </a> --}}
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge"
                                                id="password" name="password" tabindex="2"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="login-password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                                </form>


                            </div>
                        </div>
                        <!-- /Login basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('public/dashboard-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('public/dashboard-assets/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('public/dashboard-assets/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ url('public/dashboard-assets/app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ url('public/dashboard-assets/app-assets/js/scripts/pages/auth-login.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
