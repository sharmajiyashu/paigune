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
                            <h2 class="content-header-title float-start mb-0">Airplane</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.airplanes.index') }}">Airplanes</a>
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

                                    @if (!empty($airplane->id))
                                        <form class="form" action="{{ route('admin.airplanes.update', $airplane->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('admin.airplanes.store') }}" method="POST"
                                                enctype="multipart/form-data" id="submitFrom">
                                    @endif

                                    {{ csrf_field() }}

                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Airline Operator</label>
                                                <input type="text" name="airline_operator" class="form-control"
                                                    value="{{ $airplane->airline_operator ?? '' }}" placeholder="Airline Operator">
                                                <span class="text-danger" id="airline_operator-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Airplane Type</label>
                                                <input type="text" name="airplane_type" class="form-control"
                                                    value="{{ $airplane->airplane_type ?? '' }}" placeholder="Airplane Type">
                                                <span class="text-danger" id="airplane_type-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Flight Number</label>
                                                <input type="text" name="flight_number" class="form-control"
                                                    value="{{ $airplane->flight_number ?? '' }}" placeholder="Flight Number">
                                                <span class="text-danger" id="flight_number-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Seats</label>
                                                <input type="number" name="seats" class="form-control"
                                                    value="{{ $airplane->seats ?? '' }}" placeholder="Seats">
                                                <span class="text-danger" id="seats-submit_errors"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="1"
                                                        {{ isset($airplane) && $airplane->status == 1 ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0"
                                                        {{ isset($airplane) && $airplane->status == 0 ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
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
