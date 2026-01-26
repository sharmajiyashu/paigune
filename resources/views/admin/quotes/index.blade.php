@extends('admin.layouts.app')

@section('content')
    <!-- BEGIN: Content-->
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
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3" style="text-align: end">
                    <a href="{{ route('admin.quotes.create') }}" class=" btn btn-primary btn-gradient round  ">Create</a>
                </div>
            </div>
            <div class="content-body">

                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <!-- Responsive tables start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-company-table">
                                <div class="card-header">
                                    <h4 class="card-title"></h4>
                                    <div class="col-md-3" style="text-align: end">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search">
                                    </div>
                                </div>
                                <div class="table-responsive" id="table-responsive">
                                    <table class="table table-striped align-middle mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Client</th>
                                                <th>Reference</th>
                                                <th>Internal Ref</th>
                                                <th>Total Price</th>
                                                <th>Created</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = ($quotes->currentPage() - 1) * $quotes->perPage() + 1; @endphp
                                            @foreach ($quotes as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>
                                                        <strong>{{ $item->client->name ?? '-' }}</strong><br>
                                                        <small class="text-muted">{{ $item->client->email ?? '' }}</small>
                                                    </td>
                                                    <td>{{ $item->reference_number }}</td>
                                                    <td>{{ $item->internal_ref }}</td>
                                                    <td>₹ {{ number_format($item->total_price, 2) }}</td>
                                                    <td>{{ $item->created_at->format('d M Y') }}</td>

                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-light dropdown-toggle"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.quotes.show', $item->id) }}">
                                                                    <i data-feather="eye" class="me-50"></i> View
                                                                </a>

                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.quotes.edit', $item->id) }}">
                                                                    <i data-feather="edit-2" class="me-50"></i> Edit
                                                                </a>

                                                                <a class="dropdown-item text-danger" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteQuote{{ $item->id }}">
                                                                    <i data-feather="trash" class="me-50"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>

                                                        {{-- Delete Modal --}}
                                                        <div class="modal fade" id="deleteQuote{{ $item->id }}"
                                                            tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delete Quote</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this quote?
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('admin.quotes.destroy', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Yes, Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    @include('admin._pagination', ['data' => $quotes])
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
    <!-- END: Content-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                fetch_data($(this).val());
            });

            function fetch_data(query = '') {
                $.ajax({
                    url: "?page=1",
                    method: 'GET',
                    data: {
                        search: query,
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#table-responsive').html(data);
                    }
                });
            }


        });


        function changeStatus(id) {
            $.ajax({
                url: "",
                method: 'GET',
                data: {
                    change_status: id
                },
                // dataType: 'html',
                success: function(data) {
                    console.log(data);
                    Toastify({
                        text: `${data}`,
                        className: "success",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        }
                    }).showToast();
                }
            });
        }

        function copyToClipboard(text) {
            // Get the text content of the element
            // const text = document.getElementById(elementId).textContent;

            // Use the Clipboard API to copy the text
            navigator.clipboard.writeText(text)
                .then(() => {

                    Toastify({
                        text: `Code copied to clipboard!`,
                        className: "success",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        }
                    }).showToast();


                    // alert('Text copied to clipboard!');
                })
                .catch(err => {
                    console.error('Failed to copy text: ', err);
                });
        }
    </script>
@endsection
