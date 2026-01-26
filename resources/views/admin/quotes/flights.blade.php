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
                        <a class="nav-link active" href="#">
                            <i class="bi bi-airplane-engines font-medium-3 me-50"></i>
                            <span class="fw-bold">Flight Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-building font-medium-3 me-50"></i>
                            <span class="fw-bold">Hotel Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
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


                                    <form class="form" action="{{ route('admin.quotes.flights.store') }}" method="POST"
                                        enctype="multipart/form-data" id="submitFrom">

                                        {{ csrf_field() }}

                                        <div class="row">

                                            <input type="hidden" name="quote_id" id="" value="{{ $quote->id ?? '' }}">

                                            {{-- Select Client --}}
                                            <!-- Flight Fields -->
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="type_of_booking">Type of Booking <span
                                                            class="error"></span></label>
                                                    <select name="type_of_booking" id="type_of_booking"
                                                        class="form-control">
                                                        <option value="">-- Select Booking Type --</option>
                                                        <option value="one_way"
                                                            {{ isset($flight) && $flight->type_of_booking == 'one_way' ? 'selected' : '' }}>
                                                            One Way</option>
                                                        <option value="return"
                                                            {{ isset($flight) && $flight->type_of_booking == 'return' ? 'selected' : '' }}>
                                                            Return</option>
                                                    </select>
                                                    <span class="text-danger validation-class"
                                                        id="type_of_booking-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="flight_number">Flight Number <span
                                                            class="error"></span></label>
                                                    <input type="text" id="flight_number" name="flight_number"
                                                        class="form-control" placeholder="Flight Number"
                                                        value="{{ $flight->flight_number ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="flight_number-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="airline_operator">Airline / Charter
                                                        Operator
                                                        <span class="error"></span></label>
                                                    <input type="text" id="airline_operator" name="airline_operator"
                                                        class="form-control" placeholder="Airline Operator"
                                                        value="{{ $flight->airline_operator ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="airline_operator-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="aircraft_type">Aircraft / Plane Type
                                                        <span class="error"></span></label>
                                                    <input type="text" id="aircraft_type" name="aircraft_type"
                                                        class="form-control" placeholder="Aircraft Type"
                                                        value="{{ $flight->aircraft_type ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="aircraft_type-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="departure_date">Departure Date <span
                                                            class="error"></span></label>
                                                    <input type="date" id="departure_date" name="departure_date"
                                                        class="form-control"
                                                        value="{{ $flight->departure_date ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="departure_date-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="departure_airport">Departure Airport
                                                        <span class="error"></span></label>
                                                    <input type="text" id="departure_airport" name="departure_airport"
                                                        class="form-control" placeholder="Departure Airport"
                                                        value="{{ $flight->departure_airport ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="departure_airport-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="arrival_airport">Arrival Airport <span
                                                            class="error"></span></label>
                                                    <input type="text" id="arrival_airport" name="arrival_airport"
                                                        class="form-control" placeholder="Arrival Airport"
                                                        value="{{ $flight->arrival_airport ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="arrival_airport-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="departure_time">Departure Time <span
                                                            class="error"></span></label>
                                                    <input type="time" id="departure_time" name="departure_time"
                                                        class="form-control"
                                                        value="{{ $flight->departure_time ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="departure_time-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="arrival_time">Arrival Time <span
                                                            class="error"></span></label>
                                                    <input type="time" id="arrival_time" name="arrival_time"
                                                        class="form-control" value="{{ $flight->arrival_time ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="arrival_time-submit_errors"></span>
                                                </div>
                                            </div>

                                            <!-- Return Flight Fields -->
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="return_arrival_date">Return Arrival
                                                        Date
                                                        <span class="error"></span></label>
                                                    <input type="date" id="return_arrival_date"
                                                        name="return_arrival_date" class="form-control"
                                                        value="{{ $flight->return_arrival_date ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="return_arrival_date-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="return_departure_time">Return Departure
                                                        Time <span class="error"></span></label>
                                                    <input type="time" id="return_departure_time"
                                                        name="return_departure_time" class="form-control"
                                                        value="{{ $flight->return_departure_time ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="return_departure_time-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="return_arrival_time">Return Arrival
                                                        Time
                                                        <span class="error"></span></label>
                                                    <input type="time" id="return_arrival_time"
                                                        name="return_arrival_time" class="form-control"
                                                        value="{{ $flight->return_arrival_time ?? '' }}" />
                                                    <span class="text-danger validation-class"
                                                        id="return_arrival_time-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="empty_leg">Empty Leg</label>
                                                    <input type="checkbox" id="empty_leg" name="empty_leg"
                                                        value="1"
                                                        {{ isset($flight) && $flight->empty_leg ? 'checked' : '' }} />
                                                    <span class="text-danger validation-class"
                                                        id="empty_leg-submit_errors"></span>
                                                </div>
                                            </div>

                                            {{-- Total Price --}}
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="price">Price <span
                                                            class="error"></span></label>
                                                    <input type="number" step="0.01" id="price"
                                                        name="price" class="form-control" placeholder="Price"
                                                        value="{{ $flight->price ?? 0 }}" />
                                                    <span class="text-danger validation-class"
                                                        id="price-submit_errors"></span>
                                                </div>
                                            </div>

                                            {{-- Notes --}}
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="notes">Notes <span
                                                            class="error"></span></label>
                                                    <textarea id="notes" name="notes" class="form-control" placeholder="Notes">{{ $flight->notes ?? '' }}</textarea>
                                                    <span class="text-danger validation-class"
                                                        id="notes-submit_errors"></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Next</button>

                                                <a href="{{ route('admin.quotes.edit', $quote->id) }}"
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
