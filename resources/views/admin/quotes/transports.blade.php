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
                            <h2 class="content-header-title float-start mb-0">Quote</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.quotes.index') }}">Quotes</a>
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

                <ul class="nav nav-pills mb-2">
                    <li class="nav-item">
                        <a class="nav-link " href="#">
                            <i class="bi bi-person font-medium-3 me-50"></i>
                            <span class="fw-bold">Basic</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">
                            <i class="bi bi-airplane-engines font-medium-3 me-50"></i>
                            <span class="fw-bold">Flight Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">
                            <i class="bi bi-building font-medium-3 me-50"></i>
                            <span class="fw-bold">Hotel Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-truck font-medium-3 me-50"></i>
                            <span class="fw-bold">Transport Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-file-text font-medium-3 me-50"></i>
                            <span class="fw-bold">Other Detail</span>
                        </a>
                    </li>
                </ul>




                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">


                                    <form class="form" action="{{ route('admin.quotes.trsanports.store') }}" method="POST"
                                        enctype="multipart/form-data" id="submitFrom">

                                        {{ csrf_field() }}

                                        <div class="row">

                                            <input type="hidden" name="quote_id" id=""
                                                value="{{ $quote->id ?? '' }}">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="car_rental_company">Car Rental
                                                        Company</label>
                                                    <input type="text" id="car_rental_company" name="car_rental_company"
                                                        class="form-control" placeholder="Car Rental Company"
                                                        value="{{ $transport->car_rental_company ?? '' }}">
                                                    <span class="text-danger validation-class"
                                                        id="car_rental_company-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="car_type">Car Type / Category</label>
                                                    <input type="text" id="car_type" name="car_type"
                                                        class="form-control" placeholder="Economy, SUV, Luxury, etc."
                                                        value="{{ $transport->car_type ?? '' }}">
                                                    <span class="text-danger validation-class"
                                                        id="car_type-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="pickup_location">Pickup Location</label>
                                                    <input type="text" id="pickup_location" name="pickup_location"
                                                        class="form-control" placeholder="Pickup Location"
                                                        value="{{ $transport->pickup_location ?? '' }}">
                                                    <span class="text-danger validation-class"
                                                        id="pickup_location-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="pickup_datetime">Pickup Date &
                                                        Time</label>
                                                    <input type="datetime-local" id="pickup_datetime"
                                                        name="pickup_datetime" class="form-control"
                                                        value="{{ isset($transport->pickup_datetime) ? date('Y-m-d\TH:i', strtotime($transport->pickup_datetime)) : '' }}">
                                                    <span class="text-danger validation-class"
                                                        id="pickup_datetime-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="dropoff_location">Dropoff
                                                        Location</label>
                                                    <input type="text" id="dropoff_location" name="dropoff_location"
                                                        class="form-control" placeholder="Dropoff Location"
                                                        value="{{ $transport->dropoff_location ?? '' }}">
                                                    <span class="text-danger validation-class"
                                                        id="dropoff_location-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="dropoff_datetime">Dropoff Date &
                                                        Time</label>
                                                    <input type="datetime-local" id="dropoff_datetime"
                                                        name="dropoff_datetime" class="form-control"
                                                        value="{{ isset($transport->dropoff_datetime) ? date('Y-m-d\TH:i', strtotime($transport->dropoff_datetime)) : '' }}">
                                                    <span class="text-danger validation-class"
                                                        id="dropoff_datetime-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="driver_details">Driver Details</label>
                                                    <textarea id="driver_details" name="driver_details" class="form-control"
                                                        placeholder="Driver Name, Contact, License">{{ $transport->driver_details ?? '' }}</textarea>
                                                    <span class="text-danger validation-class"
                                                        id="driver_details-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="price">Price</label>
                                                    <input type="number" step="0.01" id="price" name="price"
                                                        class="form-control" placeholder="Transport Price"
                                                        value="{{ $transport->price ?? '' }}">
                                                    <span class="text-danger validation-class"
                                                        id="price-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="notes">Notes</label>
                                                    <textarea id="notes" name="notes" class="form-control" placeholder="Additional notes">{{ $transport->notes ?? '' }}</textarea>
                                                    <span class="text-danger validation-class"
                                                        id="notes-submit_errors"></span>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Next</button>
                                                <a href="{{ route('admin.quotes.hotels', $quote->id) }}"
                                                    class="btn btn-outline-secondary">Back</a>
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
                        window.location.href = res;
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
