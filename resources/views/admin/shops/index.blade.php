@extends('admin.layout.main')

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-shop me-2" style="color:#6366f1;"></i>All Shops</h5>
        <a href="{{ route('admin.shops.create') }}" class="btn-admin-primary">
            <i class="bi bi-plus-circle"></i> Add New Shop
        </a>
    </div>
    <div class="card-body-custom">
        <div class="table-responsive">
            <table class="datatable table table-hover table-center mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Shop</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shopsList as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset($item->profile && $item->profile !== 'default.jpg' ? $item->profile : 'common/blackicon.png') }}"
                                         onerror="this.src='{{ asset('common/blackicon.png') }}'"
                                         width="42" height="42" class="rounded-circle border" alt="">
                                    <div>
                                        <div class="fw-semibold text-dark">{{ ucfirst($item->username ?? 'N/A') }}</div>
                                        <small class="text-muted">{{ $item->title ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $item->email ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $item->phone_number ?? '—' }}</small>
                            </td>
                            <td>{{ Str::limit($item->address ?? '—', 40) }}</td>
                            <td>
                                @if($item->status === 'active')
                                    <span class="badge rounded-pill badge-active px-3 py-2">Active</span>
                                @else
                                    <span class="badge rounded-pill badge-pending px-3 py-2">Pending</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.shops.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-primary rounded-pill me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.shops.toggleStatus', $item->id) }}"
                                   class="btn btn-sm rounded-pill me-1 {{ $item->status === 'active' ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                    <i class="bi bi-toggle-{{ $item->status === 'active' ? 'on' : 'off' }}"></i>
                                    {{ $item->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </a>
                                <button class="btn btn-sm btn-outline-danger rounded-pill"
                                        onclick="openModal('deleteShop{{ $item->id }}')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4 text-muted">No shops found. <a href="{{ route('admin.shops.create') }}">Create one now.</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($shopsList as $item)
    <div class="modal fade" id="deleteShop{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px; border:none;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div style="font-size:48px; margin-bottom:12px;">🗑️</div>
                    <p class="mb-1 fw-semibold">Delete <strong>{{ ucfirst($item->username) }}</strong>?</p>
                    <p class="text-muted small">This action is permanent and cannot be undone.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2">
                    <button class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('admin.shops.delete', $item->id) }}" class="btn btn-danger px-4 rounded-pill">
                        Yes, Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function openModal(id) {
        var el = document.getElementById(id);
        if (!el) return;
        if (typeof bootstrap !== 'undefined') {
            bootstrap.Modal.getOrCreateInstance(el).show();
        }
    }
</script>
@endsection
