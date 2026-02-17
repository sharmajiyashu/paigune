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

               @include('admin.quotes.tabs', ['quote' => $quote ?? null])


                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">

                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">

                                        <div class="col-md-4">
                                            <label>From Airport</label>
                                            <select id="from_code" name="from_code" class="form-select select2">
                                                <option value="">Select Departure Airport</option>
                                                @foreach ($airpots as $airport)
                                                    <option value="{{ $airport->airport_code }}"
                                                        {{ old('from_code') == $airport->airport_code ? 'selected' : '' }}>

                                                        {{ $airport->city }}
                                                        ({{ $airport->airport_code }})
                                                        - {{ $airport->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label>To Airport</label>
                                            <select id="to_code" name="to_code" class="form-select select2">
                                                <option value="">Select Arrival Airport</option>
                                                @foreach ($airpots as $airport)
                                                    <option value="{{ $airport->airport_code }}"
                                                        {{ old('to_code') == $airport->airport_code ? 'selected' : '' }}>

                                                        {{ $airport->city }}
                                                        ({{ $airport->airport_code }})
                                                        - {{ $airport->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 d-flex align-items-end">
                                            <button type="button" id="searchFlightBtn" class="btn btn-info w-100">
                                                Search Flights
                                            </button>
                                        </div>

                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div id="flightResults" style="display:none;">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Flight</th>
                                                            <th>Aircraft</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Status</th>
                                                            <th>Select</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="flightTableBody"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-bordered table-hover align-middle" id="flightDetailsTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Departure</th>
                                                <th>Arrival</th>
                                                <th>Aircraft</th>
                                                <th>Reg</th>
                                                <th>Terminal</th>
                                                <th>Runway</th>
                                                <th>Baggage</th>
                                                <th>Delay (min)</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="11" class="text-center text-muted">
                                                    Search and select a flight to see history
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

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

                                        {{ csrf_field() }}

                                        <div class="row">

                                            <input type="hidden" name="quote_id" id=""
                                                value="{{ $quote->id ?? '' }}">

                                            <input type="hidden" name="flight_json" id="selected_flight_json" value="{{ $flight->flight_json ?? '' }}">


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
                                                    <input type="number" step="0.01" id="price" name="price"
                                                        class="form-control" placeholder="Price"
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




    <script>
        let flightsList = [];
        let flightHistoryList = [];



        $('#searchFlightBtn').on('click', function() {

            let from = $('#from_code').val();
            let to = $('#to_code').val();

            if (!from || !to) {
                alert('Enter both ICAO codes');
                return;
            }

            $.ajax({
                url: "{{ url('flightaware/from-to') }}/" + from + "/" + to,
                type: 'GET',
                success: function(res) {

                    if (!res.flights || res.flights.length === 0) {
                        alert('No flights found');
                        return;
                    }

                    flightsList = res.flights;

                    let table = '';

                    res.flights.forEach(function(flight, index) {

                        let status = flight.status ?? 'Live';
                        let progress = flight.progress_percent ? flight.progress_percent + '%' :
                            '';

                        table += `
        <tr>
            <td>${flight.ident_iata || flight.ident}</td>
            <td>${flight.aircraft_type || ''}</td>
            <td>${flight.origin?.code_iata || ''}</td>
            <td>${flight.destination?.code_iata || ''}</td>
            <td>${status} ${progress}</td>
            <td>
                <button type="button"
                    class="btn btn-sm btn-primary selectFlight"
                    data-index="${index}">
                    Select
                </button>
            </td>
        </tr>`;
                    });

                    $('#flightTableBody').html(table);
                    $('#flightResults').show();
                }

            });
        });

        function getBestTime(flight, type) {

            let time = null;

            if (type === 'departure') {
                time = flight.actual_out || flight.estimated_out || flight.scheduled_out;
            }

            if (type === 'arrival') {
                time = flight.actual_in || flight.estimated_in || flight.scheduled_in;
            }

            if (!time) return '';

            let d = new Date(time);

            return {
                date: d.toISOString().slice(0, 10),
                time: d.toISOString().slice(11, 16)
            };
        }



        $(document).on('click', '.selectFlight', function() {

            let index = $(this).data('index');
            let flight = flightsList[index];

            $('#flight_number').val(flight.ident_iata || flight.ident || '');
            $('#airline_operator').val(flight.operator_iata || flight.operator || '');
            $('#aircraft_type').val(flight.aircraft_type || '');
            $('#departure_airport').val(flight.origin?.code_iata || '');
            $('#arrival_airport').val(flight.destination?.code_iata || '');

            $.ajax({
                url: "{{ url('flightaware/flight') }}/" + flight.ident,
                type: 'GET',
                success: function(res) {

                    let tbody = $('#flightDetailsTable tbody');
                    tbody.empty();

                    if (!res.flights || res.flights.length === 0) {
                        tbody.append(`
            <tr>
                <td colspan="11" class="text-center text-danger">
                    No flight history found
                </td>
            </tr>
        `);
                        return;
                    }

                    window.flightHistory = res.flights;

                    res.flights.forEach(function(f, i) {

                        let dep = getBestTime(f, 'departure');
                        let arr = getBestTime(f, 'arrival');

                        let delay = f.departure_delay ?
                            Math.round(f.departure_delay / 60) :
                            0;

                        let runway = (f.actual_runway_off || '-') +
                            ' → ' +
                            (f.actual_runway_on || '-');

                        let statusBadge =
                            `<span class="badge bg-secondary">${f.status || 'Unknown'}</span>`;

                        if (f.status === 'Arrived') {
                            statusBadge = `<span class="badge bg-success">Arrived</span>`;
                        }

                        if (f.status === 'Cancelled') {
                            statusBadge = `<span class="badge bg-danger">Cancelled</span>`;
                        }

                        let row = `
        <tr class="historyRow" data-index="${i}" style="cursor:pointer;">
            <td>${dep.date || ''}</td>
            <td>${statusBadge}</td>
            <td>${dep.time || ''}</td>
            <td>${arr.time || ''}</td>
            <td>${f.aircraft_type || ''}</td>
            <td>${f.registration || ''}</td>
            <td>${f.terminal_origin || '-'} → ${f.terminal_destination || '-'}</td>
            <td>${runway}</td>
            <td>${f.baggage_claim || '-'}</td>
            <td>${delay}</td>
            <td>${f.progress_percent || 0}%</td>
        </tr>
        `;

                        tbody.append(row);
                    });
                }
            });

        });


        $(document).on('click', '.historyRow', function() {

            // Remove previous highlight
            $('.historyRow').removeClass('table-primary');

            // Highlight selected row
            $(this).addClass('table-primary');

            let index = $(this).data('index');
            let flight = window.flightHistory[index];

            let dep = getBestTime(flight, 'departure');
            let arr = getBestTime(flight, 'arrival');

            // Fill form fields
            $('#departure_date').val(dep.date || '');
            $('#departure_time').val(dep.time || '');
            $('#arrival_time').val(arr.time || '');

            // Save FULL flight object in hidden input
            $('#selected_flight_json').val(JSON.stringify(flight));

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
