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
                        <a class="nav-link active" href="#">
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

                                    @if (!empty($quote->id))
                                        <form class="form" action="{{ route('admin.quotes.update', $quote->id) }}"
                                            method="POST" enctype="multipart/form-data" id="submitFrom">
                                            @method('put')
                                        @else
                                            <form class="form" action="{{ route('admin.quotes.store') }}" method="POST"
                                                enctype="multipart/form-data" id="submitFrom">
                                    @endif

                                    {{ csrf_field() }}

                                    <div class="row">

                                        {{-- Select Client --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="client_id">Select Client <span
                                                        class="error"></span></label>
                                                <select name="client_id" id="client_id" class="form-control">
                                                    <option value="">-- Select Client --</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}"
                                                            {{ isset($quote) && $quote->client_id == $client->id ? 'selected' : '' }}>
                                                            {{ $client->name }} ({{ $client->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger validation-class"
                                                    id="client_id-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Reference Number --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="reference_number">Reference Number <span
                                                        class="error"></span></label>
                                                <input type="text" id="reference_number" name="reference_number"
                                                    class="form-control" placeholder="Reference Number"
                                                    value="{{ $quote->reference_number ?? '' }}" />
                                                <span class="text-danger validation-class"
                                                    id="reference_number-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Internal Ref --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="internal_ref">Internal Ref <span
                                                        class="error"></span></label>
                                                <input type="text" id="internal_ref" name="internal_ref"
                                                    class="form-control" placeholder="Internal Ref Number"
                                                    value="{{ $quote->internal_ref ?? '' }}" />
                                                <span class="text-danger validation-class"
                                                    id="internal_ref-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Total Price --}}
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="total_price">Total Price <span
                                                        class="error"></span></label>
                                                <input type="number" step="0.01" id="total_price" name="total_price"
                                                    class="form-control" placeholder="Total Price"
                                                    value="{{ $quote->total_price ?? 0 }}" />
                                                <span class="text-danger validation-class"
                                                    id="total_price-submit_errors"></span>
                                            </div>
                                        </div>

                                        {{-- Notes --}}
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="notes">Notes <span
                                                        class="error"></span></label>
                                                <textarea id="notes" name="notes" class="form-control" placeholder="Notes">{{ $quote->notes ?? '' }}</textarea>
                                                <span class="text-danger validation-class"
                                                    id="notes-submit_errors"></span>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1">Next</button>
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
