<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Reset Password</title>
    <link rel="apple-touch-icon" href="{{ url('public/admin-assets/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/img/footerlogo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/admin/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content " >
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Reset Password basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="brand-logo">
                                    {{-- <img src="{{ url('public/frontend-assets/img/footerlogo.png') }}" alt="" width="177"> --}}
                                    <h2 class="brand-text text-primary ms-1" style="color:#386fb9 !important;">{{ env('APP_NAME') }}</h2>
                                </a>


                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <div class="alert-body">
                                            {{$error}}
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                    @endforeach
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div class="alert-body">
                                            {{ session('success') }}
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <h4 class="card-title mb-1">Reset Password 🔒</h4>
                                <p class="card-text mb-2">Your new password must be different from previously used passwords</p>

                                <form class="auth-reset-password-form mt-2" action="{{ route('storechangePassword') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="reset-password-new">New Password</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" id="reset-password-new" value="{{ old('password') }}" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="1" autofocus />
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="reset-password-confirm">Confirm Password</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" id="reset-password-confirm" value="{{ old('confirm_password') }}" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="2" />
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="3">Set New Password</button>
                                </form>

                                <p class="text-center mt-2">
                                    {{-- <a href="auth-login-basic.html"> <i data-feather="chevron-left"></i> Back to login </a> --}}
                                </p>
                            </div>
                        </div>
                        <!-- /Reset Password basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('public/admin-assets/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('public/admin-assets/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('public/admin-assets/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ url('public/admin-assets/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ url('public/admin-assets/app-assets/js/scripts/pages/auth-reset-password.js')}}"></script>
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
