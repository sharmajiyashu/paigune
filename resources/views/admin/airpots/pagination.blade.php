<table class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Code</th>
            <th>City Code</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i = ($airpots->currentPage() - 1) * $airpots->perPage() + 1; @endphp
        @foreach ($airpots as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->city_code }}</td>
                <td>
                    <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                        {{ $item->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>{{ $item->created_at->format('d-m-Y h:i A') }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.airpots.edit', $item->id) }}">
                                <i data-feather="edit-2"></i> Edit
                            </a>

                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                                <i data-feather="trash"></i> Delete
                            </a>
                        </div>
                    </div>

                    <div class="modal fade" id="delete{{ $item->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Airplane</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this airplane?
                                </div>
                                <form action="{{ route('admin.airpots.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Delete</button>
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

@include('admin._pagination', ['data' => $airpots])
