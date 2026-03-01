@extends('admin.layouts.app')

@section('content')
    @push('css_links')
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

                @include('admin.quotes.tabs', ['quote' => $quote ?? null])


                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">

                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">

                                        <div class="col-md-5">
                                            <label>Flight Number</label>
                                            <input type="text" name="flight_number" id="search_flight_number"
                                                class="form-control" placeholder="e.g. AI202">
                                        </div>

                                        <div class="col-md-5">
                                            <label>Departure Date</label>
                                            <input type="date" name="departure_date" id="search_departure_date"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" id="searchFlightBtn" class="btn btn-info w-100">
                                                Search Flights
                                            </button>
                                        </div>

                                    </div>


                                    <div id="returnSearchSection" style="display:none;" class="mt-2">
                                        <div class="row mb-2">
                                            <div class="col-md-5">
                                                <label>Return Flight Number</label>
                                                <input type="text" id="search_return_flight_number" class="form-control">
                                            </div>

                                            <div class="col-md-5">
                                                <label>Return Departure Date</label>
                                                <input type="date" id="search_return_departure_date"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button" id="searchReturnFlightBtn"
                                                    class="btn btn-warning w-100">
                                                    Search Return
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">


                                    <form class="form" action="{{ route('admin.quotes.flights.store') }}" method="POST"
                                        enctype="multipart/form-data" id="submitFrom">

                                        @csrf

                                        <input type="hidden" name="quote_id" value="{{ $quote->id ?? '' }}">

                                        <input type="hidden" name="flight_json" id="selected_flight_json"
                                            value="{{ $flight->flight_json ?? '' }}">

                                        <div class="row g-2">

                                            <!-- ===================== -->
                                            <!-- BOOKING TYPE -->
                                            <!-- ===================== -->
                                            <div class="col-md-6">
                                                <label class="form-label">Type of Booking</label>
                                                <select name="type_of_booking" id="type_of_booking" class="form-control">
                                                    <option value="">-- Select Booking Type --</option>
                                                    <option value="one_way"
                                                        {{ isset($flight) && $flight->type_of_booking == 'one_way' ? 'selected' : '' }}>
                                                        One Way
                                                    </option>
                                                    <option value="return"
                                                        {{ isset($flight) && $flight->type_of_booking == 'return' ? 'selected' : '' }}>
                                                        Return
                                                    </option>
                                                </select>
                                                <span class="text-danger validation-class"
                                                    id="type_of_booking-submit_errors"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Type of Flight</label>
                                                <select name="type_of_flight" id="type_of_flight" class="form-control">
                                                    <option value="">-- Select Flight Type --</option>

                                                    <option value="commercial"
                                                        {{ old('type_of_flight', $flight->type_of_flight ?? '') == 'commercial' ? 'selected' : '' }}>
                                                        Commercial Flight
                                                    </option>

                                                    <option value="private_jet"
                                                        {{ old('type_of_flight', $flight->type_of_flight ?? '') == 'private_jet' ? 'selected' : '' }}>
                                                        Private Jet Flight
                                                    </option>
                                                </select>

                                                <span class="text-danger validation-class"
                                                    id="type_of_flight-submit_errors"></span>
                                            </div>

                                        </div>

                                        <hr class="my-2">

                                        <!-- ===================== -->
                                        <!-- OUTBOUND SECTION -->
                                        <!-- ===================== -->
                                        <h5 class="mb-2">Outbound Flight Details</h5>

                                        <div class="row g-2">

                                            <div class="col-md-6">
                                                <label class="form-label">Flight Number</label>
                                                <input type="text" id="flight_number" name="flight_number"
                                                    class="form-control" value="{{ $flight->flight_number ?? '' }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Airline / Operator</label>
                                                <input type="text" id="airline_operator" name="airline_operator"
                                                    class="form-control" value="{{ $flight->airline_operator ?? '' }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Aircraft Type</label>
                                                <input type="text" id="aircraft_type" name="aircraft_type"
                                                    class="form-control" value="{{ $flight->aircraft_type ?? '' }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Departure Date</label>
                                                <input type="date" id="departure_date" name="departure_date"
                                                    class="form-control" value="{{ $flight->departure_date ?? '' }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Departure Airport</label>
                                                <input type="text" id="departure_airport" name="departure_airport"
                                                    class="form-control" value="{{ $flight->departure_airport ?? '' }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Arrival Airport</label>
                                                <input type="text" id="arrival_airport" name="arrival_airport"
                                                    class="form-control" value="{{ $flight->arrival_airport ?? '' }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Departure Time</label>
                                                <input type="time" id="departure_time" name="departure_time"
                                                    class="form-control" value="{{ $flight->departure_time ?? '' }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Arrival Time</label>
                                                <input type="time" id="arrival_time" name="arrival_time"
                                                    class="form-control" value="{{ $flight->arrival_time ?? '' }}">
                                            </div>

                                        </div>

                                        <!-- ===================== -->
                                        <!-- RETURN SECTION -->
                                        <!-- ===================== -->
                                        <div id="returnFlightSection" style="display:none;">

                                            <hr class="my-3">
                                            <h5 class="mb-2">Return Flight Details</h5>

                                            <div class="row g-2">

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Flight Number</label>
                                                    <input type="text" id="return_flight_number"
                                                        name="return_flight_number" class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Airline / Operator</label>
                                                    <input type="text" id="return_airline_operator"
                                                        name="return_airline_operator" class="form-control"
                                                        value="{{ old('return_airline_operator', $flight->return_airline_operator ?? '') }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Aircraft Type</label>
                                                    <input type="text" id="return_aircraft_type"
                                                        name="return_aircraft_type" class="form-control"
                                                        value="{{ old('return_aircraft_type', $flight->return_aircraft_type ?? '') }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Departure Date</label>
                                                    <input type="date" id="return_departure_date"
                                                        name="return_departure_date" class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Departure Airport</label>
                                                    <input type="text" id="return_departure_airport"
                                                        name="return_departure_airport" class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Arrival Airport</label>
                                                    <input type="text" id="return_arrival_airport"
                                                        name="return_arrival_airport" class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Departure Time</label>
                                                    <input type="time" id="return_departure_time"
                                                        name="return_departure_time" class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Return Arrival Time</label>
                                                    <input type="time" id="return_arrival_time"
                                                        name="return_arrival_time" class="form-control">
                                                </div>

                                            </div>

                                        </div>

                                        <!-- ===================== -->
                                        <!-- EXTRA DETAILS -->
                                        <!-- ===================== -->
                                        <hr class="my-3">

                                        <div class="row g-2">

                                            <div class="col-md-6">
                                                <label class="form-label">Empty Leg</label>
                                                <div class="form-check mt-1">
                                                    <input type="checkbox" class="form-check-input" id="empty_leg"
                                                        name="empty_leg" value="1"
                                                        {{ isset($flight) && $flight->empty_leg ? 'checked' : '' }}>
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Price</label>
                                                <input type="number" step="0.01" name="price" class="form-control"
                                                    value="{{ $flight->price ?? 0 }}">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Notes</label>
                                                <textarea name="notes" class="form-control" rows="3">{{ $flight->notes ?? '' }}</textarea>
                                            </div>

                                        </div>

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>

                                            <a href="{{ route('admin.quotes.edit', $quote->id) }}"
                                                class="btn btn-outline-secondary">
                                                Back
                                            </a>
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

            /* ========================================
               TOGGLE BOOKING TYPE (ONE WAY / RETURN)
            ========================================= */
            function toggleReturnSection() {
                let type = $('#type_of_booking').val();

                if (type === 'return') {
                    $('#returnFlightSection').slideDown();
                    $('#returnSearchSection').slideDown();
                } else {
                    $('#returnFlightSection').slideUp();
                    $('#returnSearchSection').slideUp();

                    // Clear return fields
                    $('#returnFlightSection').find('input').val('');
                }
            }

            $('#type_of_booking').on('change', function() {
                toggleReturnSection();
            });

            // Trigger on page load (edit case support)
            toggleReturnSection();


            /* ========================================
               OUTBOUND FLIGHT SEARCH
            ========================================= */
            $('#searchFlightBtn').on('click', function() {

                let flightNumber = $('#search_flight_number').val();
                let departureDate = $('#search_departure_date').val();

                if (!flightNumber || !departureDate) {
                    alert('Please enter Flight Number and Departure Date');
                    return;
                }

                $.ajax({
                    url: "{{ url('flightaware/search-by-flightnumber-date') }}",
                    type: 'GET',
                    data: {
                        flight_number: flightNumber,
                        departure_date: departureDate
                    },
                    success: function(res) {

                        if (!res.flight) {
                            alert('Flight data not found');
                            return;
                        }

                        let flight = res.flight;

                        function formatDate(isoString) {
                            if (!isoString) return '';
                            return new Date(isoString).toISOString().split('T')[0];
                        }

                        function formatTime(isoString) {
                            if (!isoString) return '';
                            return new Date(isoString).toTimeString().slice(0, 5);
                        }

                        // Fill outbound fields
                        $('#flight_number').val(flight.ident_iata || flight.ident || '');
                        $('#airline_operator').val(flight.operator_iata || flight.operator ||
                            '');
                        $('#aircraft_type').val(flight.aircraft_type || '');
                        $('#departure_airport').val(flight.origin?.code_iata || '');
                        $('#arrival_airport').val(flight.destination?.code_iata || '');
                        $('#departure_date').val(formatDate(flight.scheduled_out || flight
                            .estimated_out));
                        $('#departure_time').val(formatTime(flight.scheduled_off || flight
                            .estimated_off));
                        $('#arrival_time').val(formatTime(flight.scheduled_on || flight
                            .estimated_on));

                        // Save full object
                        $('#selected_flight_json').val(JSON.stringify(flight));
                    },
                    error: function() {
                        alert('Error fetching flight data');
                    }
                });

            });


            /* ========================================
               RETURN FLIGHT SEARCH
            ========================================= */
            $('#searchReturnFlightBtn').on('click', function() {

                let flightNumber = $('#search_return_flight_number').val();
                let departureDate = $('#search_return_departure_date').val();

                if (!flightNumber || !departureDate) {
                    alert('Please enter Return Flight Number and Date');
                    return;
                }

                $.ajax({
                    url: "{{ url('flightaware/search-by-flightnumber-date') }}",
                    type: 'GET',
                    data: {
                        flight_number: flightNumber,
                        departure_date: departureDate
                    },
                    success: function(res) {

                        if (!res.flight) {
                            alert('Return flight not found');
                            return;
                        }

                        let flight = res.flight;

                        function formatDate(isoString) {
                            if (!isoString) return '';
                            return new Date(isoString).toISOString().split('T')[0];
                        }

                        function formatTime(isoString) {
                            if (!isoString) return '';
                            return new Date(isoString).toTimeString().slice(0, 5);
                        }

                        // Fill return fields
                        $('#return_flight_number').val(flight.ident_iata || flight.ident || '');
                        $('#return_airline_operator').val(flight.operator_iata || flight
                            .operator || '');
                        $('#return_aircraft_type').val(flight.aircraft_type || '');
                        $('#return_departure_airport').val(flight.origin?.code_iata || '');
                        $('#return_arrival_airport').val(flight.destination?.code_iata || '');
                        $('#return_departure_date').val(formatDate(flight.scheduled_out ||
                            flight.estimated_out));
                        $('#return_departure_time').val(formatTime(flight.scheduled_off ||
                            flight.estimated_off));
                        $('#return_arrival_time').val(formatTime(flight.scheduled_on || flight
                            .estimated_on));

                    },
                    error: function() {
                        alert('Error fetching return flight');
                    }
                });

            });


            /* ========================================
               AJAX FORM SUBMIT
            ========================================= */
            $('#submitFrom').on('submit', function(e) {
                e.preventDefault();

                var $form = $(this);
                var url = $form.attr('action');
                var formData = new FormData(this);

                $('.validation-class').html('');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#form-loader').show();
                        $('.spinner-loader').show();
                    },
                    success: function(res) {
                        window.location.reload();
                    },
                    error: function(res) {

                        if (res.status === 400 || res.status === 422) {
                            if (res.responseJSON?.errors) {
                                $.each(res.responseJSON.errors, function(key, value) {
                                    $("#" + key + "-submit_errors").text(value[0]);
                                });
                            }
                        }

                        $('#form-loader').hide();
                        $('.spinner-loader').hide();
                    }
                });
            });

        });
    </script>
@endsection
