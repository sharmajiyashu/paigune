<table class="table table-striped align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Client</th>
            <th>Reference</th>
            <th>Internal Ref</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Created By</th>
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
                <td>
                    @if ($item->status === 'pending')
                        <span style="color: #f1c40f; font-weight: 600;">Pending</span>
                    @elseif($item->status === 'rejected')
                        <span style="color: #e74c3c; font-weight: 600;">Rejected</span>
                    @elseif($item->status === 'accepted')
                        <span style="color: #2ecc71; font-weight: 600;">Accepted</span>
                    @else
                        <span>{{ ucfirst($item->status) }}</span>
                    @endif
                </td>
                <td>{{ $item->createdBy->name ?? 'System' }}</td>
                <td>{{ $item->created_at->format('d M Y') }}</td>

                <td class="text-center">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.quotes.show', $item->id) }}">
                                <i data-feather="eye" class="me-50"></i> View
                            </a>

                            <a class="dropdown-item" href="{{ route('admin.quotes.edit', $item->id) }}">
                                <i data-feather="edit-2" class="me-50"></i> Edit
                            </a>

                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                data-bs-target="#deleteQuote{{ $item->id }}">
                                <i data-feather="trash" class="me-50"></i> Delete
                            </a>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="deleteQuote{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Quote</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this quote?
                                </div>
                                <form action="{{ route('admin.quotes.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
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
