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
                            <h2 class="content-header-title float-start mb-0">Log</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>

                                    <li class="breadcrumb-item active">Logs
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="col-md-3" style="text-align: end">
                    <a href="{{ route('admin.clients.create') }}" class=" btn btn-primary btn-gradient round  ">Create</a>
                </div> --}}
            </div>
            <div class="content-body">

                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <!-- Responsive tables start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-company-table">
                                {{-- <div class="card-header">
                                    <h4 class="card-title"></h4>
                                    <div class="col-md-3" style="text-align: end">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search">
                                    </div>
                                </div> --}}
                                <div class="table-responsive" id="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Module</th>
                                                <th>Action</th>
                                                <th>Record ID</th>
                                                <th>Old Data</th>
                                                <th>New Data</th>
                                                <th>IP</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = ($logs->currentPage() - 1) * $logs->perPage() + 1; @endphp

                                            @foreach ($logs as $log)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $log->user->name ?? 'System' }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $log->model }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($log->action == 'create')
                                                            <span class="badge bg-success">Created</span>
                                                        @elseif($log->action == 'update')
                                                            <span class="badge bg-warning">Updated</span>
                                                        @else
                                                            <span class="badge bg-danger">Deleted</span>
                                                        @endif
                                                    </td>
                                                    <td>#{{ $log->model_id }}</td>

                                                    <td>
                                                        <button class="btn btn-sm btn-outline-secondary"
                                                            data-bs-toggle="modal" data-bs-target="#old{{ $log->id }}">
                                                            View
                                                        </button>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#new{{ $log->id }}">
                                                            View
                                                        </button>
                                                    </td>

                                                    <td>{{ $log->ip }}</td>
                                                    <td>{{ $log->created_at->format('d-m-Y h:i A') }}</td>
                                                </tr>

                                                <!-- Old Data Modal -->
                                                <div class="modal fade" id="old{{ $log->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5>Old Data</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <pre>{{ json_encode($log->old_data, JSON_PRETTY_PRINT) }}</pre>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- New Data Modal -->
                                                <div class="modal fade" id="new{{ $log->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5>New Data</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <pre>{{ json_encode($log->new_data, JSON_PRETTY_PRINT) }}</pre>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @php $i++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>

                                    @include('admin._pagination', ['data' => $logs])

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
