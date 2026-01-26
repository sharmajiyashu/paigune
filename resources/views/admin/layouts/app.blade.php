<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <meta name="description" content="{{ config('website_setting.meta_description') ?? '' }}">

    <meta name="keywords" content="{{ config('website_setting.meta_keyword') ?? '' }}">
    <meta name="author" content="{{ config('website_setting.meta_author') ?? '' }}">

    <style>
        :root {
           --sidebar-text-color: white;
            --primary-color: #71bbb2;
            --gradient-color: linear-gradient(118deg, #71bbb2, rgb(113 187 178));
            --box-shadow: 0 0 10px 1px rgb(113 187 178);
            --sidebar-background-color: #27445D;
            --border-color: #71bbb2;
            --header_text_color: white;
        }
    </style>


    <title>{{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" href="{{ url('public/dashboard-assets/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/frontend-assets/image/favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/font_icon/css/font-awesome.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    @stack('css_links')



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
        href="{{ url('public/dashboard-assets/app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/plugins/charts/chart-apex.css') }}">


    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-assets/app-assets/css/components.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('public/dashboard-assets/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <style>
        .card-datatable {
            padding: 9px;
        }

        tr {
            border-bottom: 1px solid rgb(105 94 94 / 20%) !important;
        }

        table.dataTable tbody tr.even {
            /* background-color: #f3f2f7; */
        }

        .table> :not(caption)>*>* {
            padding: 0.72rem 1rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .uppercase {
            text-transform: uppercase;
        }

        .debit {
            color: red;
        }

        .credit {
            color: green;
        }



        #loader {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        #loader .spinner {
            border: 8px solid #f3f3f3;
            /* Light gray */
            border-top: 8px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>


    <style>
        #flash-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            z-index: 9999;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        #flash-message.success {
            background-color: #4caf50;
            /* Green for success */
        }

        #flash-message.error {
            background-color: #f44336;
            /* Red for error */
        }

        #form-loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <div id="loader">
        <div class="spinner"></div>
    </div>

    <div id="form-loader" style="display: none; text-align: center;">
        <img src="{{ url('public/dashboard-assets/loder.gif') }}" alt="Loading..." style="width: 50px; height: 50px;">
        <p>Submitting, please wait...</p>
    </div>


    @include('admin.layouts.header')

    @include('admin.layouts.sidebar')

    @yield('content')

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    {{-- <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a
                    class="ms-25" href="https://premad.in/" target="_blank">Premad Software Solution</a><span
                    class="d-none d-sm-inline-block">, All rights Reserved</span></span><span
                class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer> --}}
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    @include('admin.layouts.js')

</body>
<!-- END: Body-->

</html>
