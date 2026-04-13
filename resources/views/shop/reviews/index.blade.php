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
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Info</th>
                                            <th>Job Info</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviewList as $item)
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
                                                    @php
                                                        $rating = $item->rating ?? 0;
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating)
                                                            <span style="color: gold;font-size : 20px">&#9733;</span> <!-- filled star -->
                                                        @else
                                                            <span style="color: lightgray;font-size : 20px">&#9733;</span>
                                                            <!-- unfilled star -->
                                                        @endif
                                                    @endfor
                                                </td>




                                                <td>
                                                    {{ ucfirst(Str::limit($item->review ?? 'N/A', 50)) }}
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                </td>


                                                <td>




                                                    <button class="btn btn-sm bg-danger text-white" data-bs-toggle="modal"
                                                        data-bs-target="#deleteJob{{ $item->id }}">
                                                        <i class="fe fe-trash"></i>
                                                        Delete
                                                    </button>

                                                </td>

                                            </tr>
                                            {{-- Delete Modal --}}
                                            <div class="modal fade" id="deleteJob{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="deleteJobLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteJobLabel{{ $item->id }}">
                                                                Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            Are you sure you want to delete this Transaction?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>

                                                            <a href="{{ route('shop.reviews.delete', $item->id) }}"
                                                                class="btn btn-danger">Delete</a>

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
                    <!-- /Recent Orders -->

                </div>
            </div>
        </div>
    </div>
@endsection
