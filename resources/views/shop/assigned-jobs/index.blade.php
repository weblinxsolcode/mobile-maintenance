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
                        {{-- <a class="btn btn-primary" href="{{ route('shop.assignedJobs.create') }}">
                            <i class="fe fe-plus"></i>
                            Assigned Jobs
                        </a> --}}
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
                                                <th>Job Info</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assignedJobs as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

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
                                                        {{ Str::limit($item->jobInfo->description ?? 'N/A', 50) }}
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
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    </td>



                                                    <td class="">
                                                        
                                                        <a href="{{ route('shop.assignedJobs.details', $item->id) }}" class="btn btn-primary text-white btn-sm" type="button">
                                                            <i class="fa-solid fa-list"></i>
                                                            Assigned Jobs
                                                        </a>


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
    {{-- @include('shop.orders.partials.modals') --}}
@endsection
