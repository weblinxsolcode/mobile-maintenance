@extends('technician.layout.main')

@section('section')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                        <h3 class="page-title">{{ $title }}</h3>
                        <span class="badge bg-primary bg-opacity-10 text-white p-2">
                            Total Jobs: {{ $assignJob->count() }}
                        </span>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                @forelse($assignJob as $job)
                    <div class="col-md-6 col-xl-4 mb-4">
                        <div class="card customShadow h-100">
                            <div
                                class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fa fa-briefcase me-2"></i>
                                    Job {{ $job->jobInfo->code ?? $job->id }}
                                </h5>
                                <span id="job-status-badge-{{ $job->id }}"
                                    class="badge rounded-pill 
                                @if ($job->status == 'under_review') bg-warning 
                                @elseif($job->status == 'under_repair') bg-info 
                                @elseif($job->status == 'ready_for_pickup') bg-primary 
                                @else bg-success @endif">
                                    {{ ucwords(str_replace('_', ' ', $job->status)) }}
                                </span>
                            </div>

                            <div class="card-body">
                                <!-- Shop Information -->
                                <div class="shop-info mb-3 pb-2 border-bottom">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <i class="fe fe-home text-primary fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">{{ $job->shopInfo->title ?? 'Shop Name N/A' }}</h6>
                                            <small class="text-muted">
                                                {{ $job->shopInfo->address ?? 'Address not provided' }}
                                            </small>
                                            <div class="mt-1">
                                                <small><i class="fe fe-mail"></i>
                                                    {{ $job->shopInfo->email ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Job Details -->
                                <div class="job-details">
                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <small class="text-muted">Brand/Model</small>
                                            <p class="mb-0 fw-semibold">{{ $job->jobInfo->brand ?? 'N/A' }}
                                                {{ $job->jobInfo->model ?? '' }}</p>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Service Type</small>
                                            <p class="mb-0">{{ $job->jobInfo->service_type ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Description</small>
                                        <p class="mb-0 small">
                                            {{ Str::limit($job->jobInfo->description ?? 'No description', 80) }}</p>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <small class="text-muted">Price</small>
                                            <p class="mb-0 fw-bold">{{ env('APP_CURRENCY') }}{{ $job->price ?? '0' }}</p>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Est. Time</small>
                                            <p class="mb-0">{{ $job->time ?? '—' }} hrs</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent">
                                @if ($job->status != 'delivered')
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm w-100 update-status-btn"
                                        data-job-id="{{ $job->id }}"
                                        data-current-status="{{ $job->repair_status ?? $job->status }}"
                                        data-bs-toggle="modal" data-bs-target="#statusUpdateModal">
                                        <i class="fe fe-edit me-1"></i> Update Status
                                    </button>
                                @endif
                                <div class="mt-2 text-end">
                                    <small class="text-muted">Assigned on:
                                        {{ \Carbon\Carbon::parse($job->updated_at)->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fe fe-folder-off display-1 text-muted"></i>
                                <h5 class="mt-3">No Assigned Jobs</h5>
                                <p class="text-muted">You have not been assigned any jobs yet.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-labelledby="statusUpdateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusUpdateModalLabel">Update Job Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modal_job_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select New Status</label>
                        <select id="modal_status_select" class="form-select">
                            <option value="under_review">🔍 Under Review</option>
                            <option value="under_repair">🔧 Under Repair</option>
                            <option value="ready_for_pickup">📦 Ready For Pickup</option>
                            <option value="delivered">✅ Delivered</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmStatusUpdate">Update Status</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let currentJobId = null;

            // When "Update Status" button is clicked, populate modal with current status
            $('.update-status-btn').on('click', function() {
                currentJobId = $(this).data('job-id');
                let currentStatus = $(this).data('current-status');
                $('#modal_job_id').val(currentJobId);
                $('#modal_status_select').val(currentStatus);
            });

            // Handle confirm update
            $('#confirmStatusUpdate').on('click', function() {
                let jobId = $('#modal_job_id').val();
                let newStatus = $('#modal_status_select').val();

                if (!jobId || !newStatus) return;

                // Disable button to prevent double submission
                let confirmBtn = $(this);
                confirmBtn.prop('disabled', true).html(
                    '<i class="fe fe-loader fa-spin me-1"></i> Updating...');

                $.ajax({
                    url: "{{ route('technician.assignedJobs.updateStatus', ':id') }}".replace(
                        ':id', jobId),
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "PUT",
                        repair_status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update the badge in the corresponding card
                            let badge = $(`.update-status-btn[data-job-id="${jobId}"]`)
                                .closest('.card')
                                .find('.badge.rounded-pill');

                            let label = newStatus.replaceAll('_', ' ')
                                .replace(/\b\w/g, l => l.toUpperCase());

                            badge
                                .removeClass('bg-warning bg-info bg-primary bg-success')
                                .addClass(
                                    newStatus == 'under_review' ? 'bg-warning' :
                                    newStatus == 'under_repair' ? 'bg-info' :
                                    newStatus == 'ready_for_pickup' ? 'bg-primary' :
                                    'bg-success'
                                )
                                .text(label);

                            // Also update the data-current-status attribute on the button
                            $(`.update-status-btn[data-job-id="${jobId}"]`).data(
                                'current-status', newStatus);

                            toastr.options.positionClass = 'toast-bottom-right';
                            toastr.success('Status updated to ' + label);

                            // Close modal
                            $('#statusUpdateModal').modal('hide');
                        } else {
                            toastr.error(response.message || 'Something went wrong');
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = xhr.responseJSON?.message || 'Failed to update status';
                        toastr.error(errorMsg);
                    },
                    complete: function() {
                        confirmBtn.prop('disabled', false).html('Update Status');
                    }
                });
            });

            // Reset modal when closed
            $('#statusUpdateModal').on('hidden.bs.modal', function() {
                $('#modal_job_id').val('');
                $('#modal_status_select').val('');
                $('#confirmStatusUpdate').prop('disabled', false).html('Update Status');
            });
        });
    </script>
@endsection
