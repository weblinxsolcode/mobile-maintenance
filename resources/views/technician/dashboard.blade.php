@extends('technician.layout.main')

@section('section')
    <div class="page-wrapper">
        <div class="content container-fluid">

            {{-- Page Header --}}
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <h3 class="page-title">Technician Dashboard</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="row g-3 mb-4">

                {{-- Technicians --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm ">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="text-muted small mb-1">Technicians</p>
                                    <h3 class="mb-0 fw-semibold">9</h3>
                                </div>
                                <div class="rounded-3 p-2" style="background:#E6F1FB;">
                                    <i class="fe fe-users" style="color:#185FA5;font-size:20px;"></i>
                                </div>
                            </div>
                            <div class="progress" style="height:4px;">
                                <div class="progress-bar" style="width:65%;background:#378ADD;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending Applications --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="text-muted small mb-1">Pending Applications</p>
                                    <h3 class="mb-0 fw-semibold">9</h3>
                                </div>
                                <div class="rounded-3 p-2" style="background:#FAEEDA;">
                                    <i class="fe fe-clock" style="color:#BA7517;font-size:20px;"></i>
                                </div>
                            </div>
                            <div class="progress" style="height:4px;">
                                <div class="progress-bar" style="width:40%;background:#EF9F27;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Accepted Applications --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm ">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="text-muted small mb-1">Accepted Applications</p>
                                    <h3 class="mb-0 fw-semibold">9</h3>
                                </div>
                                <div class="rounded-3 p-2" style="background:#EAF3DE;">
                                    <i class="fe fe-check-circle" style="color:#3B6D11;font-size:20px;"></i>
                                </div>
                            </div>
                            <div class="progress" style="height:4px;">
                                <div class="progress-bar" style="width:75%;background:#639922;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Reviews --}}
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="text-muted small mb-1">Total Reviews</p>
                                    <h3 class="mb-0 fw-semibold">9</h3>
                                </div>
                                <div class="rounded-3 p-2" style="background:#FBEAF0;">
                                    <i class="fe fe-star" style="color:#993556;font-size:20px;"></i>
                                </div>
                            </div>
                            <div class="progress" style="height:4px;">
                                <div class="progress-bar" style="width:55%;background:#D4537E;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Recent Reviews --}}
            

        </div>
    </div>
@endsection
