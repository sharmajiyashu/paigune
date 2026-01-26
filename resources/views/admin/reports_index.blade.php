@extends('admin.layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard-assets/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">

                <!-- Basic multiple Column Form section start -->

                <section id="multiple-column-form">
                    <div class="row">



                        @if (auth()->user()->hasRole('Super-Admin'))
                            @foreach ($reports as $key => $val)
                                <div class="col-12 col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>{{ $val }}</h4>
                                        </div>
                                        <div class="card-body">

                                            <form action='{{ route("admin.reports.{$key}") }}'' method="GET"
                                                target="_blank">
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                                                <div class="row">


                                                    @if ($key == 'sales_reports')
                                                        <div class="col-md-6 col-12">
                                                            <div class="mb-1">
                                                                <div class="d-flex flex-column">
                                                                    <label class="" for="customSwitch3">Date
                                                                        Range</label>
                                                                    <input type="text" id="fp-range" name = "date_range"
                                                                        class="form-control flatpickr-range"
                                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 col-12">
                                                            <label for="">Select Sales Man</label>
                                                            <div class="mb-1">
                                                                <select name="sales_man_id" id=""
                                                                    class="form-select select2">
                                                                    <option value="">(All)</option>
                                                                    @foreach ($sales_mans as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-12 col-12">
                                                            <div class="mb-1">
                                                                <div class="d-flex flex-column">
                                                                    <label class="form-check-label mb-50"
                                                                        for="customSwitch3">Date
                                                                        Range</label>
                                                                    <input type="text" id="fp-range" name = "date_range"
                                                                        class="form-control flatpickr-range"
                                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif




                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                        <button type="reset"
                                                            class="btn btn-outline-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach ($reports as $key => $val)
                                @if ($key == 'sales_reports')
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>{{ $val }}</h4>
                                            </div>
                                            <div class="card-body">

                                                <form action='{{ route("admin.reports.{$key}") }}'' method="GET"
                                                    target="_blank">
                                                    <input type="hidden" name="sales_man_id"
                                                        value="{{ auth()->user()->id ?? '' }}">
                                                    <div class="row">

                                                        <div class="col-md-12 col-12">
                                                            <div class="mb-1">
                                                                <div class="d-flex flex-column">
                                                                    <label class="" for="customSwitch3">Date
                                                                        Range</label>
                                                                    <input type="text" id="fp-range" name = "date_range"
                                                                        class="form-control flatpickr-range"
                                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                                </div>
                                                            </div>
                                                        </div>








                                                        <div class="col-12">
                                                            <button type="submit"
                                                                class="btn btn-primary me-1">Submit</button>
                                                            <button type="reset"
                                                                class="btn btn-outline-secondary">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif



                        {{-- <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Payment Report ✓</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.reports.payments') }}" method="GET" target="_blank">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <div class="d-flex flex-column">
                                                        <label class="form-check-label mb-50" for="customSwitch3">Date
                                                            Range</label>
                                                        <input type="text" id="fp-range" name = "date_range"
                                                            class="form-control flatpickr-range"
                                                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                    </div>
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

                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>GST Report ✓</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.reports.gst') }}" method="GET" target="_blank">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <div class="d-flex flex-column">
                                                        <label class="form-check-label mb-50" for="customSwitch3">Date
                                                            Range</label>
                                                        <input type="text" id="fp-range" name = "date_range"
                                                            class="form-control flatpickr-range"
                                                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                                    </div>
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
                        </div> --}}








                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->




            </div>
        </div>
    </div>


    <script src="{{ url('public/dashboard-assets/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ url('public/dashboard-assets/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
@endsection
