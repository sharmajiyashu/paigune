@extends('admin.layouts.app')

@section('content')
    <!-- BEGIN: Content-->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">

                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <!-- Responsive tables start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Quote Details</h4>
                                    <a href="{{ route('admin.quotes.edit', $quote->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit Quote
                                    </a>
                                </div>

                                <div class="card-body">

                                    {{-- Basic --}}
                                    <h5 class="text-primary border-bottom pb-1">Basic Information</h5>
                                    <div class="row">
                                        <div class="col-md-3"><b>Client</b><br>{{ $quote->client->name }}</div>
                                        <div class="col-md-3"><b>Reference</b><br>{{ $quote->reference_number }}</div>
                                        <div class="col-md-3"><b>Internal Ref</b><br>{{ $quote->internal_ref }}</div>
                                        <div class="col-md-3"><b>Total Price</b><br>₹
                                            {{ number_format($quote->total_price, 2) }}</div>
                                    </div>

                                    {{-- Flight --}}
                                    @if ($quote->flight)
                                        <hr>
                                        <h5 class="text-success">✈ Flight Details</h5>
                                        <div class="row">
                                            <div class="col-md-3"><b>Booking
                                                    Type</b><br>{{ $quote->flight->type_of_booking }}</div>
                                            <div class="col-md-3"><b>Flight No</b><br>{{ $quote->flight->flight_number }}
                                            </div>
                                            <div class="col-md-3"><b>From</b><br>{{ $quote->flight->departure_airport }}
                                            </div>
                                            <div class="col-md-3"><b>To</b><br>{{ $quote->flight->arrival_airport }}</div>
                                            <div class="col-md-3 mt-2">
                                                <b>Departure</b><br>{{ $quote->flight->departure_date }}
                                                {{ $quote->flight->departure_time }}</div>
                                            <div class="col-md-3 mt-2"><b>Arrival</b><br>{{ $quote->flight->arrival_time }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Hotel --}}
                                    @if ($quote->hotel)
                                        <hr>
                                        <h5 class="text-warning">🏨 Hotel Details</h5>
                                        <div class="row">
                                            <div class="col-md-3"><b>Hotel</b><br>{{ $quote->hotel->hotel_name }}</div>
                                            <div class="col-md-3"><b>City</b><br>{{ $quote->hotel->location }}</div>
                                            <div class="col-md-3"><b>Check-in</b><br>{{ $quote->hotel->checkin_date }}
                                            </div>
                                            <div class="col-md-3"><b>Check-out</b><br>{{ $quote->hotel->checkout_date }}
                                            </div>
                                            <div class="col-md-3 mt-2"><b>Room</b><br>{{ $quote->hotel->room_type }}</div>
                                            <div class="col-md-3 mt-2"><b>Guests</b><br>{{ $quote->hotel->guests }}</div>
                                        </div>
                                    @endif

                                    {{-- Transport --}}
                                    @if ($quote->transport)
                                        <hr>
                                        <h5 class="text-info">🚗 Transport</h5>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b>Company</b><br>{{ $quote->transport->car_rental_company }}</div>
                                            <div class="col-md-3"><b>Car Type</b><br>{{ $quote->transport->car_type }}
                                            </div>
                                            <div class="col-md-3"><b>Pickup</b><br>{{ $quote->transport->pickup_location }}
                                            </div>
                                            <div class="col-md-3">
                                                <b>Dropoff</b><br>{{ $quote->transport->dropoff_location }}</div>
                                        </div>
                                    @endif

                                    {{-- Other --}}
                                    @if ($quote->other)
                                        <hr>
                                        <h5 class="text-secondary">📌 Other Services</h5>
                                        <div class="row">
                                            <div class="col-md-3"><b>Title</b><br>{{ $quote->other->title }}</div>
                                            <div class="col-md-3"><b>Date</b><br>{{ $quote->other->date }}
                                                {{ $quote->other->time }}</div>
                                            <div class="col-md-3"><b>Price</b><br>₹
                                                {{ number_format($quote->other->price, 2) }}</div>
                                            <div class="col-md-6 mt-2"><b>Notes</b><br>{{ $quote->other->notes }}</div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Responsive tables end -->
                </section>

                <!--/ Ajax Sourced Server-side -->



            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
