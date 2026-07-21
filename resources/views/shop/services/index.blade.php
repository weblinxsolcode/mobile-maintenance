@extends('shop.layout.main')


@section('section')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                        <h3 class="page-title">{{ $title }}</h3>
                        <a class="btn btn-primary" href="{{ route('shop.services.create') }}">
                            <i class="fe fe-plus"></i>
                            Add
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service title</th>
                                            <th>Description</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Skill</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable-body">
                                        @foreach ($servicesList as $item)
                                            <tr data-id="{{ $item->id }}" style="cursor: grab;">
                                                <td class="drag-handle"><i class="fa fa-arrows-v text-muted me-2"></i> {{ $loop->iteration }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="javascript:void(0);" class="avatar avatar-sm me-2">
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('jobs/' . $item->cover_image ?: 'common/blackicon.png') }}"
                                                                onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';"
                                                                alt="User Image">
                                                        </a>
                                                        <a href="javascript:void(0);">{{ ucfirst($item->title ?? 'N/A') }}
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    {{ $item->description ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ optional($item->serviceMetas->where('type', 'brand')->first())->value ?? 'N/A' }}
                                                </td>

                                                <td>
                                                    {{ optional($item->serviceMetas->where('type', 'model')->first())->value ?? 'N/A' }}
                                                </td>

                                                <td>
                                                    {{ env('APP_CURRENCY', 'IQD') }}
                                                    {{ optional($item->serviceMetas->where('type', 'price')->first())->value ?? 'N/A' }}
                                                </td>

                                                <td>
                                                    {{ env('APP_CURRENCY', 'IQD') }}
                                                    {{ optional($item->serviceMetas->where('type', 'discount')->first())->value ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    @forelse($item->serviceMetas->where('type', 'skill') as $skill)
                                                        <span class="badge bg-primary">{{ $skill->value }}</span>
                                                    @empty
                                                        N/A
                                                    @endforelse
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    @php
                                                        $status = $item->status;
                                                        if ($status == 'active') {
                                                            $status = 'Active';
                                                        } elseif ($status == 'pending') {
                                                            $status = 'Pending';
                                                        }
                                                    @endphp

                                                    <span
                                                        class="badge bg-{{ $item->status == 'active' ? 'success' : ($item->status == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ $status }}
                                                    </span>

                                                </td>

                                                <td>

                                                    <button type="button" class="btn btn-sm bg-secondary text-white"
                                                        onclick="openModal('updateStatus{{ $item->id }}')">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                        Update Status
                                                    </button>

                                                    <a class="btn btn-sm bg-info text-white"
                                                        href="{{ route('shop.services.edit', $item->id) }}">

                                                        <i class="fe fe-edit"></i>
                                                        Edit

                                                    </a>


                                                    <button type="button" class="btn btn-sm bg-danger text-white"
                                                        onclick="openModal('deleteManagement{{ $item->id }}')">
                                                        <i class="fe fe-trash"></i>
                                                        Delete
                                                    </button>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
    ALL MODALS — outside table/tbody (iOS Safari fix)
    ============================================================ --}}
    @foreach ($servicesList as $item)

        {{-- Delete Modal --}}
        <div class="modal fade" id="deleteManagement{{ $item->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $item->id }}"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteLabel{{ $item->id }}">
                            Delete |
                            {{ ucfirst($item->title ?? 'N/A') }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="mb-0">Are you sure you want to delete this Services?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('shop.services.delete', $item->id) }}" class="btn btn-danger">
                            Yes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Update Status Modal --}}
        <div class="modal fade" id="updateStatus{{ $item->id }}" tabindex="-1"
            aria-labelledby="updateStatusLabel{{ $item->id }}" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="{{ route('shop.services.status', $item->id) }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="updateStatusLabel{{ $item->id }}">
                                Update Status | {{ ucfirst($item->title ?? 'N/A') }}
                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <p class="mb-3 text-center">
                                Select new status for this service
                            </p>

                            <select name="status" class="form-control" required>
                                <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Update Status
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        /**
         * iOS Safari safe modal opener.
         * data-bs-toggle on <button> inside <table> breaks on iOS Safari.
         * This JS approach works cross-platform.
         */
        function openModal(modalId) {
            var modalEl = document.getElementById(modalId);
            if (!modalEl) return;
            // Bootstrap 5
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            } else if (typeof $ !== 'undefined') {
                // Bootstrap 4 fallback
                $(modalEl).modal('show');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var el = document.getElementById('sortable-body');
            if (el) {
                Sortable.create(el, {
                    animation: 150,
                    ghostClass: 'bg-light',
                    onEnd: function(evt) {
                        var order = [];
                        document.querySelectorAll('#sortable-body tr').forEach(function(row) {
                            if (row.getAttribute('data-id')) {
                                order.push(row.getAttribute('data-id'));
                            }
                        });

                        fetch('{{ route('shop.services.reorder') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ orders: order })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                console.log('Reordered successfully');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            }
        });
    </script>
@endsection