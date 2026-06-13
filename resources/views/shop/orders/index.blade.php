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
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Quick Search Filter -->
                            <div class="mb-3 d-flex align-items-center gap-2">
                                <div class="input-group" style="max-width: 340px;">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fe fe-search text-muted"></i>
                                    </span>
                                    <input type="text" id="ordersSearchInput" class="form-control border-start-0"
                                        placeholder="Search by customer name, device, code…"
                                        oninput="filterOrdersTable()">
                                </div>
                                <span class="text-muted small" id="ordersResultCount"></span>
                            </div>

                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0" id="ordersTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Info</th>
                                            <th>Job Info</th>
                                            <th>Price</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appliedJobs as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                {{-- User Info --}}
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="javascript:void(0);" class="avatar avatar-sm me-2">
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('userImages/' . ($item->userInfo->profile_picture ?? 'common/blackicon.png')) }}"
                                                                onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';"
                                                                alt="User Image">
                                                        </a>
                                                        <a href="javascript:void(0);" class="d-block">
                                                            {{ ucfirst($item->userInfo->full_name ?? 'N/A') }}
                                                            <br>
                                                            <small class="text-muted">
                                                                {{ $item->userInfo->email ?? 'N/A' }}
                                                            </small>
                                                        </a>
                                                    </h2>
                                                </td>

                                                {{-- Job Info --}}
                                                <td>
                                                    <div>
                                                        <a href="javascript:void(0);" class="d-block fw-bold">
                                                            {{ $item->jobInfo->brand ?? 'N/A' }} -
                                                            {{ $item->jobInfo->model ?? 'N/A' }}
                                                        </a>
                                                        <small class="text-muted d-block">
                                                            Code: {{ $item->jobInfo->code ?? 'N/A' }}
                                                        </small>
                                                        <small class="text-muted d-block">
                                                            Service: {{ $item->jobInfo->service_type ?? 'N/A' }}
                                                        </small>
                                                    </div>
                                                </td>

                                                {{-- Price --}}
                                                <td>
                                                    {{ env('APP_CURRENCY', 'IQD') }} {{ $item->price ?? 'N/A' }}
                                                </td>

                                                {{-- Time / Warranty --}}
                                                <td>
                                                    <span class="fw-bold">Time</span> : {{ $item->time ?? 'N/A' }} hrs
                                                    <br>
                                                    @if ($item->warranty == 1)
                                                        <span class="fw-bold">Warranty</span> : {{ $item->warranty_months ?? 'N/A' }} months
                                                    @else
                                                        <span class="fw-bold">Warranty</span> : No
                                                    @endif
                                                </td>

                                                {{-- Status Badge --}}
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'pending'          => 'warning',
                                                            'accepted'         => 'success',
                                                            'under_review'     => 'info',
                                                            'under_repair'     => 'primary',
                                                            'ready_for_pickup' => 'secondary',
                                                            'delivered'        => 'dark',
                                                        ];
                                                        $badgeColor = $statusColors[$item->status] ?? 'secondary';
                                                    @endphp
                                                    <span class="badge bg-{{ $badgeColor }}">
                                                        {{ ucfirst(str_replace('_', ' ', $item->status ?? 'N/A')) }}
                                                    </span>
                                                </td>

                                                {{-- Date --}}
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                </td>

                                                {{-- Actions --}}
                                                <td class="text-end">

                                                    @if (!in_array($item->status, ['accepted', 'under_review', 'under_repair', 'ready_for_pickup', 'delivered']))
                                                        <button class="btn btn-sm bg-secondary text-white"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateStatus{{ $item->id }}">
                                                            <i class="fa-solid fa-toggle-on"></i>
                                                            Update Status
                                                        </button>
                                                    @endif

                                                    <a class="btn btn-sm bg-success text-white"
                                                        href="{{ route('shop.orders.details', $item->id) }}">
                                                        <i class="fe fe-eye"></i>
                                                        View
                                                    </a>

                                                    {{-- WhatsApp Quick Send --}}
                                                    @php
                                                        $customerPhone = preg_replace('/\D/', '', $item->userInfo->phone_number ?? $item->jobInfo->phone_number ?? '');
                                                        $customerName  = $item->userInfo->full_name ?? $item->jobInfo->full_name ?? 'Customer';
                                                        $device        = trim(($item->jobInfo->brand ?? '') . ' ' . ($item->jobInfo->model ?? ''));
                                                        $statusLabel   = ucwords(str_replace('_', ' ', $item->status ?? 'updated'));
                                                        $price         = env('APP_CURRENCY', 'IQD') . ' ' . ($item->price ?? 'N/A');
                                                        $waMsg         = "Hello {$customerName}!\n\nYour device repair status update:\nDevice: {$device}\nPrice: {$price}\nStatus: {$statusLabel}\n\nThank you for trusting us!";
                                                    @endphp
                                                    @if($customerPhone)
                                                        <a class="btn btn-sm btn-success text-white"
                                                            href="https://wa.me/{{ $customerPhone }}?text={{ urlencode($waMsg) }}"
                                                            target="_blank"
                                                            title="Send WhatsApp Update">
                                                            <i class="bi bi-whatsapp"></i>
                                                            WhatsApp
                                                        </a>
                                                    @endif

                                                    <button class="btn btn-sm bg-danger text-white"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteManagement{{ $item->id }}">
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

    @include('shop.orders.partials.modals')

    <script>
        function filterOrdersTable() {
            const query = document.getElementById('ordersSearchInput').value.toLowerCase();
            const rows  = document.querySelectorAll('#ordersTable tbody tr');
            let visible = 0;
            rows.forEach(row => {
                const match = row.innerText.toLowerCase().includes(query);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            const countEl = document.getElementById('ordersResultCount');
            countEl.textContent = query ? (visible + ' result(s) found') : '';
        }
    </script>
@endsection
