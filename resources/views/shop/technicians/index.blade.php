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
                        <a class="btn btn-primary" href="{{ route('shop.technicians.create') }}">
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
                                            <th>User Info</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($techniciansList as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="javascript:void(0);" class="avatar avatar-sm me-2">
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('userImages/' . $item->profile_picture ?: 'common/blackicon.png') }}"
                                                                onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';"
                                                                alt="User Image">
                                                        </a>
                                                        <a href="javascript:void(0);">{{ ucfirst($item->full_name ?? 'N/A') }}
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    {{ $item->email ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $item->phone_number ?? 'N/A' }}
                                                </td>

                                                {{-- @php

                                                    $status = $item->status;
                                                    if ($status == 'active') {
                                                        $status = 'Active';
                                                    } elseif ($status == 'pending') {
                                                        $status = 'Pending';
                                                    } elseif ($status == 'blocked') {
                                                        $status = 'Blocked';
                                                    }

                                                @endphp
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $item->status == 'active' ? 'success' : ($item->status == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ $status }}
                                                    </span>
                                                </td> --}}
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                </td>


                                                <td>
                                                    <a class="btn btn-sm bg-info text-white"
                                                        href="{{ route('shop.technicians.edit', $item->id) }}">

                                                        <i class="fe fe-edit"></i>
                                                        Edit

                                                    </a>
                                                    {{-- <button class="btn btn-sm bg-secondary text-white"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateStatus{{ $item->id }}">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                        Update Status
                                                    </button> --}}
                                                    {{-- <a href=""
                                                        class="btn btn-sm bg-primary text-white">
                                                        <i class="fe fe-user"></i>
                                                        Profile
                                                    </a> --}}

                                                    <button class="btn btn-sm bg-danger text-white" data-bs-toggle="modal"
                                                        data-bs-target="#deleteManagement{{ $item->id }}">
                                                        <i class="fe fe-trash"></i>
                                                        Delete
                                                    </button>

                                                </td>

                                            </tr>
                                            <div class="modal fade" id="deleteManagement{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Delete |
                                                                {{ ucfirst($item->full_name ?? 'N/A') }}</h1>   
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p class="mb-0">Are you sure you want to delete this
                                                                user?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="{{ route('shop.technicians.delete', $item->id) }}"
                                                                class="btn btn-danger">
                                                                Yes
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection
