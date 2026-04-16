@extends('shop.layout.main')

@section('section')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Reassign Technician</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('shop.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('shop.assignedJobs.index') }}">Assigned Jobs</a></li>
                        <li class="breadcrumb-item active">Reassign</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('shop.assignedJobs.details', $jobApplication->id) }}" class="btn btn-outline-secondary">
                        <i class="fe fe-arrow-left me-1"></i> Back to Details
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <!-- Current Assignment Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="rounded-circle border" 
                                     src="{{ asset('userImages/' . optional($jobApplication->technicianInfo)->profile_picture ?: 'common/blackicon.png') }}"
                                     onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';"
                                     width="60" height="60" style="object-fit: cover;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Currently Assigned Technician</h6>
                                <strong>{{ ucfirst($jobApplication->technicianInfo->full_name ?? 'N/A') }}</strong><br>
                                <small class="text-muted">{{ $jobApplication->technicianInfo->email ?? 'N/A' }}</small>
                            </div>
                            <div>
                                <span class="badge bg-primary">Assigned on {{ \Carbon\Carbon::parse($jobApplication->updated_at)->format('d M, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reassignment Form Card -->
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <div class="text-center mb-2">
                            <div class="avatar avatar-xl bg-warning-soft rounded-circle p-2 mx-auto mb-3"
                                 style="width: 80px; height: 80px;">
                                <i class="fe fe-user-rotate display-4 text-warning" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="mb-1">Change Technician</h4>
                            <p class="text-muted">Select a different technician for this job</p>
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('shop.assignedJobs.reassign.update', $jobApplication->id) }}" 
                              method="POST" enctype="multipart/form-data" id="reassignForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="technician_id" class="form-label fw-semibold">
                                    <i class="fe fe-users me-1"></i> New Technician
                                </label>
                                <select name="technician_id" id="technician_id" class="form-select form-select-lg py-2" required>
                                    <option value="" selected disabled>-- Select Technician --</option>
                                    @foreach ($techniciansList as $item)
                                        @php
                                            $profileImage = asset('userImages/' . ($item->profile_picture ?: 'common/blackicon.png'));
                                        @endphp
                                        <option value="{{ $item->id }}" 
                                                data-name="{{ $item->full_name }}"
                                                data-email="{{ $item->email }}"
                                                data-phone="{{ $item->phone_number ?? 'N/A' }}"
                                                data-image="{{ $profileImage }}"
                                                {{ $item->id == $jobApplication->technician_id ? 'selected' : '' }}>
                                            {{ $item->full_name }} | {{ $item->email }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">Choose a new technician to replace the current one.</div>
                            </div>

                            <!-- Live Technician Preview -->
                            <div class="mb-4 {{ $jobApplication->technician_id ? '' : 'd-none' }}" id="technicianPreview">
                                <div class="card bg-light border-0 rounded-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div id="previewAvatar"
                                                     class="avatar avatar-md rounded-circle bg-white p-1 d-flex align-items-center justify-content-center"
                                                     style="width: 48px; height: 48px;">
                                                    <i class="fe fe-user text-primary" style="font-size: 1.5rem;"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0" id="previewName">-</h6>
                                                <small class="text-muted" id="previewEmail">-</small>
                                                <br>
                                                <small class="text-muted"><i class="fe fe-phone"></i> <span id="previewPhone">-</span></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-0 px-0 pb-0 pt-2">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('shop.assignedJobs.details', $jobApplication->id) }}" class="btn btn-light px-4">Cancel</a>
                                    <button type="submit" class="btn btn-warning px-5">
                                        <i class="fa fa-sync-alt me-2"></i> Reassign Technician
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectEl = document.getElementById('technician_id');
        const previewDiv = document.getElementById('technicianPreview');
        const previewName = document.getElementById('previewName');
        const previewEmail = document.getElementById('previewEmail');
        const previewPhone = document.getElementById('previewPhone');
        const previewAvatar = document.getElementById('previewAvatar');

        function updatePreview() {
            const selectedOption = selectEl.options[selectEl.selectedIndex];
            if (selectEl.value && selectedOption) {
                const name = selectedOption.getAttribute('data-name') || '';
                const email = selectedOption.getAttribute('data-email') || '';
                const phone = selectedOption.getAttribute('data-phone') || 'N/A';
                const imageUrl = selectedOption.getAttribute('data-image') || '';

                previewName.innerText = name;
                previewEmail.innerText = email;
                previewPhone.innerText = phone;

                previewAvatar.innerHTML = '';
                if (imageUrl) {
                    const img = document.createElement('img');
                    img.src = imageUrl;
                    img.alt = name;
                    img.classList.add('avatar-img', 'rounded-circle');
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.onerror = function() {
                        previewAvatar.innerHTML = '<i class="fe fe-user text-primary" style="font-size: 1.5rem;"></i>';
                    };
                    previewAvatar.appendChild(img);
                } else {
                    previewAvatar.innerHTML = '<i class="fe fe-user text-primary" style="font-size: 1.5rem;"></i>';
                }

                previewDiv.classList.remove('d-none');
            } else {
                previewDiv.classList.add('d-none');
            }
        }

        selectEl.addEventListener('change', updatePreview);
        updatePreview(); // initial call (will show current technician)
    });
</script>
@endsection