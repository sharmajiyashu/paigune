@extends('admin.layouts.app')

@section('content')
    @push('css_links')
        <link rel="stylesheet" type="text/css"
            href="{{ url('public/admin-assets/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ url('public/admin-assets/app-assets/css/plugins/forms/form-quill-editor.css') }}">

        <style>
            .error {
                color: #a93c3d !important;
                font-weight: 500;
            }

            .varient_div {
                padding: 1%;
                border: solid 1px;
                margin-left: initial;
            }
        </style>
    @endpush


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Client</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clients</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif --}}

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">

                                    @if (!empty($client->id))
                                        <form class="form" action="{{ route('admin.clients.update', $client->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('admin.clients.store') }}" method="POST"
                                                enctype="multipart/form-data" id="submitFrom">
                                    @endif

                                    {{ csrf_field() }}

                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="name">Name <span
                                                        class="error"></span></label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="Full Name" value="{{ $client->name ?? '' }}" />
                                                <span class="text-danger validation-class" id="name-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="mobile">Mobile <span
                                                        class="error"></span></label>
                                                <input type="text" id="mobile" name="mobile" class="form-control"
                                                    placeholder="Mobile Number" value="{{ $client->mobile ?? '' }}" />
                                                <span class="text-danger validation-class" id="mobile-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="email">Email <span
                                                        class="error"></span></label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    placeholder="Email Address" value="{{ $client->email ?? '' }}" />
                                                <span class="text-danger validation-class" id="email-submit_errors"></span>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const checkboxes = document.querySelectorAll('.toggle-status');

                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function() {
                                const rowId = this.getAttribute('data-row');
                                const openInput = document.getElementById(`open-time-${rowId}`);
                                const closeInput = document.getElementById(`close-time-${rowId}`);

                                if (this.checked) {
                                    openInput.disabled = false;
                                    closeInput.disabled = false;
                                } else {
                                    openInput.disabled = true;
                                    closeInput.disabled = true;
                                }
                            });
                        });
                    });
                </script>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <script>
        $(document).ready(function() {
            $('#submitFrom').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission


                // let headingElements =
                // document.getElementsByClassName('ql-editor');
                // let headingVal = headingElements[0].innerHTML;

                // $('#description_id').val(headingVal);


                var $form = $('#submitFrom');
                var url = $form.attr('action');
                var formData = new FormData($form[0]);
                $('.validation-class').html('');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#form-loader').show();
                        $('.spinner-loader').css('display', 'block');
                    },
                    success: function(res) {
                        location.reload();

                        $('#form-loader').hide();
                    },
                    error: function(res) {
                        if (res.status == 400 || res.status == 422) {
                            if (res.responseJSON && res.responseJSON.errors) {
                                var error = res.responseJSON.errors
                                $.each(error, function(key, value) {
                                    $("#" + key + "-submit_errors").text(value[0]);
                                });
                            }
                        }
                        $('#form-loader').hide();
                    }
                });
            });
        });
    </script>







    @push('scripts')
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
        <script src="{{ asset('public/admin-assets/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
        <script src="{{ asset('public/admin-assets/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>
    @endpush
@endsection
