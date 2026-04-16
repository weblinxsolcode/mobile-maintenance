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
                            <div class="table-responsive">

                                <div class="tab-pane show active" id="tab1" bis_skin_checked="1">
                                    <table class="datatable table table-hover table-center mb-0">
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
                                                    <td>
                                                        <h2 class="table-avatar">


                                                            <div>
                                                                <a href="javascript:void(0);" class="d-block fw-bold">
                                                                    {{ $item->jobInfo->brand ?? 'N/A' }} -
                                                                    {{ $item->jobInfo->model ?? 'N/A' }}
                                                                </a>

                                                                <small class="text-muted d-block">
                                                                    Code: {{ $item->jobInfo->code ?? 'N/A' }}
                                                                </small>

                                                                <small class="text-muted d-block">
                                                                    Service:
                                                                    {{ $item->jobInfo->service_type ?? 'N/A' }}
                                                                </small>


                                                            </div>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        {{ env('APP_CURRENCY') }}{{ $item->price ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold">Time</span> : {{ $item->time ?? 'N/A' }}
                                                        hrs <br>
                                                        @if ($item->warranty == 1)
                                                            <span class="fw-bold">Warranty Months</span> :
                                                            {{ $item->warranty_months ?? 'N/A' }}
                                                        @else
                                                            <span class="fw-bold">Warranty</span> : No
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                        $statusColors = [
                                                            'pending'         => 'warning',
                                                            'accepted'        => 'success',
                                                            'under_review'    => 'info',
                                                            'under_repair'    => 'primary',
                                                            'ready_for_pickup'=> 'secondary',
                                                            'delivered'       => 'dark',
                                                        ];
                                                        $badgeColor = $statusColors[$item->status] ?? 'secondary';
                                                    @endphp
                                                    
                                                    <span class="badge bg-{{ $badgeColor }}">
                                                        {{ ucfirst(str_replace('_', ' ', $item->status ?? 'N/A')) }}
                                                    </span>
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    </td>



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
                                                        {{-- <a class="btn btn-sm bg-info text-white"
                                                            href="{{ route('admin.categories.edit', $item->id) }}">
    
                                                            <i class="fe fe-edit"></i>
                                                            Edit
    
                                                        </a> --}}

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
                    <!-- /Recent Orders -->

                </div>
            </div>
        </div>
    </div>
    @include('shop.orders.partials.modals')
@endsection
