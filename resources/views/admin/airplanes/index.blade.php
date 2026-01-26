@extends('admin.layouts.app')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Airplanes</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Airplanes</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-end">
                    <a href="{{ route('admin.airplanes.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>

            <div class="content-body">
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-company-table">
                                <div class="card-header d-flex justify-content-end">
                                    <input type="text" id="searchInput" class="form-control w-25" placeholder="Search">
                                </div>

                                <div class="table-responsive" id="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Airline Operator</th>
                                                <th>Airplane Type</th>
                                                <th>Flight Number</th>
                                                <th>Seats</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = ($airplanes->currentPage() - 1) * $airplanes->perPage() + 1; @endphp
                                            @foreach ($airplanes as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->airline_operator }}</td>
                                                    <td>{{ $item->airplane_type }}</td>
                                                    <td>{{ $item->flight_number }}</td>
                                                    <td>{{ $item->seats }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm dropdown-toggle"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.airplanes.edit', $item->id) }}">
                                                                    <i data-feather="edit-2"></i> Edit
                                                                </a>

                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#delete{{ $item->id }}">
                                                                    <i data-feather="trash"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="delete{{ $item->id }}">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delete Airplane</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this airplane?
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('admin.airplanes.destroy', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
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

                                    @include('admin._pagination', ['data' => $airplanes])
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

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
                        search: query
                    },
                    success: function(data) {
                        $('#table-responsive').html(data);
                    }
                });
            }
        });
    </script>
@endsection
