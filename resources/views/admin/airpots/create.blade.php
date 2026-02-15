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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.airpots.index') }}">airpots</a>
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

                                    @if (!empty($airpot->id))
                                        <form class="form" action="{{ route('admin.airpots.update', $airpot->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('admin.airpots.store') }}" method="POST"
                                                enctype="multipart/form-data" id="submitFrom">
                                    @endif

                                    {{ csrf_field() }}

                                    <div class="row">

                                        {{-- Name --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $airpot->name ?? '' }}" placeholder="Airport Name">
                                                <span class="text-danger validation-class" id="name-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Code --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Code</label>
                                                <input type="text" name="code" class="form-control"
                                                    value="{{ $airpot->code ?? '' }}" placeholder="Code">
                                                <span class="text-danger validation-class" id="code-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Airport Code --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Airport Code</label>
                                                <input type="text" name="airport_code" class="form-control"
                                                    value="{{ $airpot->airport_code ?? '' }}" placeholder="Airport Code">
                                                <span class="text-danger validation-class"
                                                    id="airport_code-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Alternate Ident --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Alternate Ident</label>
                                                <input type="text" name="alternate_ident" class="form-control"
                                                    value="{{ $airpot->alternate_ident ?? '' }}"
                                                    placeholder="Alternate Ident">
                                                <span class="text-danger validation-class"
                                                    id="alternate_ident-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- ICAO --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>ICAO Code</label>
                                                <input type="text" name="code_icao" class="form-control"
                                                    value="{{ $airpot->code_icao ?? '' }}" placeholder="ICAO Code">
                                                <span class="text-danger validation-class"
                                                    id="code_icao-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- IATA --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>IATA Code</label>
                                                <input type="text" name="code_iata" class="form-control"
                                                    value="{{ $airpot->code_iata ?? '' }}" placeholder="IATA Code">
                                                <span class="text-danger validation-class"
                                                    id="code_iata-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- LID --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>LID Code</label>
                                                <input type="text" name="code_lid" class="form-control"
                                                    value="{{ $airpot->code_lid ?? '' }}" placeholder="LID Code">
                                                <span class="text-danger validation-class"
                                                    id="code_lid-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- City Code --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>City Code</label>
                                                <input type="text" name="city_code" class="form-control"
                                                    value="{{ $airpot->city_code ?? '' }}" placeholder="City Code">
                                                <span class="text-danger validation-class"
                                                    id="city_code-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Type --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Type</label>
                                                <input type="text" name="type" class="form-control"
                                                    value="{{ $airpot->type ?? '' }}" placeholder="Airport Type">
                                                <span class="text-danger validation-class" id="type-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Elevation --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Elevation</label>
                                                <input type="number" name="elevation" class="form-control"
                                                    value="{{ $airpot->elevation ?? '' }}" placeholder="Elevation">
                                                <span class="text-danger validation-class"
                                                    id="elevation-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- City --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>City</label>
                                                <input type="text" name="city" class="form-control"
                                                    value="{{ $airpot->city ?? '' }}" placeholder="City">
                                                <span class="text-danger validation-class" id="city-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- State --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>State</label>
                                                <input type="text" name="state" class="form-control"
                                                    value="{{ $airpot->state ?? '' }}" placeholder="State">
                                                <span class="text-danger validation-class"
                                                    id="state-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Country Code --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Country Code</label>
                                                <input type="text" name="country_code" class="form-control"
                                                    value="{{ $airpot->country_code ?? '' }}" placeholder="Country Code">
                                                <span class="text-danger validation-class"
                                                    id="country_code-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Timezone --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Timezone</label>
                                                <input type="text" name="timezone" class="form-control"
                                                    value="{{ $airpot->timezone ?? '' }}" placeholder="Timezone">
                                                <span class="text-danger validation-class"
                                                    id="timezone-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Latitude --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Latitude</label>
                                                <input type="text" name="latitude" class="form-control"
                                                    value="{{ $airpot->latitude ?? '' }}" placeholder="Latitude">
                                                <span class="text-danger validation-class"
                                                    id="latitude-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Longitude --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Longitude</label>
                                                <input type="text" name="longitude" class="form-control"
                                                    value="{{ $airpot->longitude ?? '' }}" placeholder="Longitude">
                                                <span class="text-danger validation-class"
                                                    id="longitude-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Wiki URL --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Wiki URL</label>
                                                <input type="text" name="wiki_url" class="form-control"
                                                    value="{{ $airpot->wiki_url ?? '' }}" placeholder="Wiki URL">
                                                <span class="text-danger validation-class"
                                                    id="wiki_url-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Flights URL --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Airport Flights URL</label>
                                                <input type="text" name="airport_flights_url" class="form-control"
                                                    value="{{ $airpot->airport_flights_url ?? '' }}"
                                                    placeholder="Flights URL">
                                                <span class="text-danger validation-class"
                                                    id="airport_flights_url-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Alternatives --}}
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label>Alternatives (JSON)</label>
                                                <textarea name="alternatives" class="form-control" rows="3" placeholder="Alternatives JSON">{{ $airpot->alternatives ?? '' }}</textarea>
                                                <span class="text-danger validation-class"
                                                    id="alternatives-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="1"
                                                        {{ isset($airpot) && $airpot->status == 1 ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0"
                                                        {{ isset($airpot) && $airpot->status == 0 ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                                <span class="text-danger validation-class"
                                                    id="status-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Buttons --}}
                                        <div class="col-12 mt-2">
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
