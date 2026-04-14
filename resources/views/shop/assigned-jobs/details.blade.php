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
                        <a class="btn btn-primary btn-rounded" href="{{ route('shop.assignedJobs.index') }}">
                            <i class="fe fe-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-lg-12">
                    <!-- Job Details Card -->
                    <div class="card customShadow mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                Brand:
                                <span class="fw-bold text-underline">
                                    <u>
                                        {{ $jobApplications->jobInfo->brand ?? 'N/A' }}
                                        {{ $jobApplications->jobInfo->model ?? 'N/A' }}
                                    </u>
                                </span>
                            </h5>
                            <h5 class="card-title mt-2">
                                Description:
                                <span class="fw-bold text-underline">
                                    <u>
                                        {{ $jobApplications->jobInfo->description ?? 'N/A' }}
                                    </u>
                                </span>
                            </h5>
                        </div>
                    </div>

                    <!-- Technician Assignment Card (Single Technician Layout) -->
                    <div class="card customShadow">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title mb-0">
                                <i class="fe fe-user-check me-2"></i>
                                Technician Assignment
                            </h4>
                            @if ($jobApplications->technicianInfo)
                                <a href="{{ route('shop.assignedJobs.reassign', $jobApplications->id) }}"
                                    class="btn btn-warning btn-rounded mt-2 mt-sm-0">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Reassign Technician
                                </a>
                            @else
                                <a href="{{ route('shop.assignedJobs.assignTechnician', $jobApplications->id) }}"
                                    class="btn btn-success btn-rounded mt-2 mt-sm-0">
                                    <i class="fa-solid fa-circle-plus"></i>
                                    Assign Technician
                                </a>
                            @endif
                        </div>

                        <div class="card-body">
                            @if ($jobApplications->technicianInfo)
                                <!-- Professional Technician Profile Card (No Table) -->
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-4 mb-md-0">
                                        <div class="avatar avatar-xxl position-relative">
                                            <img class="avatar-img rounded-circle border border-3 border-white shadow"
                                                src="{{ asset('userImages/' . optional($jobApplications->technicianInfo)->profile_picture ?: 'common/blackicon.png') }}"
                                                onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';"
                                                alt="Technician Avatar"
                                                style="width: 135px; height: 130px; object-fit: cover;">
                                            <span
                                                class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-white"></span>
                                        </div>
                                        <h5 class="mt-3 mb-0">
                                            {{ ucfirst($jobApplications->technicianInfo->full_name ?? 'N/A') }}</h5>
                                        <span class="badge bg-success bg-opacity-10 text-white px-3 py-2 rounded-pill mt-2">
                                            <i class="fe fe-check-circle me-1"></i> Currently Assigned
                                        </span>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3">
                                                        <i class="fe fe-mail text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Email Address</small>
                                                        <strong>{{ $jobApplications->technicianInfo->email ?? 'N/A' }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3">
                                                        <i class="fe fe-phone text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Phone Number</small>
                                                        <strong>{{ $jobApplications->technicianInfo->phone_number ?? 'N/A' }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3">
                                                        <i class="fe fe-calendar text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Assigned Date</small>
                                                        <strong>{{ \Carbon\Carbon::parse($jobApplications->updated_at)->format('d M, Y') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3">
                                                        <i class="fa fa-briefcase text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Technician ID</small>
                                                        <strong>#{{ $jobApplications->technicianInfo->id ?? 'N/A' }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 text-md-end mt-4 mt-md-0">
                                        <button class="btn btn-danger btn-rounded w-100 w-md-auto delete-technician"
                                            data-id="{{ $jobApplications->technicianInfo->id ?? '' }}"
                                            data-job="{{ $jobApplications->id }}">
                                            <i class="fe fe-trash"></i> Remove Assignment
                                        </button>
                                        <p class="text-muted small mt-2 mb-0">
                                            <i class="fe fe-info"></i> Removing will unassign this technician
                                        </p>
                                    </div>
                                </div>
                            @else
                                <!-- Empty State: No Technician Assigned -->
                                <div class="text-center py-5">
                                    <div class="mb-4">
                                        <i class="fe fe-user-x display-1 text-muted"></i>
                                    </div>
                                    <h5 class="mb-2">No Technician Assigned Yet</h5>
                                    <p class="text-muted mb-4">Assign a technician to this job to start the workflow.</p>
                                    <a href="{{ route('shop.assignedJobs.assignTechnician', $jobApplications->id) }}"
                                        class="btn btn-primary btn-rounded">
                                        <i class="fa-solid fa-circle-plus"></i> Assign Technician Now
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Remove Assignment Confirmation Modal -->
    <div class="modal fade" id="removeTechnicianModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fe fe-alert-triangle text-danger me-2"></i>
                        Confirm Removal
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <strong>remove the assigned technician</strong> from this job?</p>
                    <p class="text-muted mb-0">The job will be unassigned and you can assign a different technician later.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="removeTechnicianForm" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fe fe-trash me-1"></i> Yes, Remove
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-technician');
            const modal = new bootstrap.Modal(document.getElementById('removeTechnicianModal'));
            const removeForm = document.getElementById('removeTechnicianForm');
    
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const jobId = this.getAttribute('data-job');
                    // Build the route for removing technician assignment
                    const actionUrl = "{{ route('shop.assignedJobs.removeTechnician', ':id') }}".replace(':id', jobId);
                    removeForm.action = actionUrl;
                    modal.show();
                });
            });
        });
    </script>
@endsection
