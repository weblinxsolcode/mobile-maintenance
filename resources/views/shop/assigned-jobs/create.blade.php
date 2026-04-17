@extends('shop.layout.main')

@section('section')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Assign Technician to Job</h3>

                    </div>
                    <div class="col-auto">
                        <a href="{{ route('shop.assignedJobs.index') }}" class="btn btn-outline-secondary">
                            <i class="fe fe-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Assignment Card -->
                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-header bg-white border-0 pt-4 pb-0">
                            <div class="text-center mb-2">
                                <div class="avatar avatar-xl bg-primary-soft rounded-circle p-2 mx-auto mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fe fe-user-plus display-4 text-primary" style="font-size: 2.5rem;"></i>
                                </div>
                                <h4 class="mb-1">New Technician Assignment</h4>
                                <p class="text-muted">Select the technician who will handle this job</p>
                            </div>
                        </div>

                        <div class="card-body p-4 p-lg-5">
                            <form action="{{ route('shop.assignedJobs.assignTechnician.store', $id) }}" method="POST"
                                enctype="multipart/form-data" id="assignForm">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $jobApplications->user_id }}">
                                <!-- Hidden job_id if needed – adjust according to your logic -->
                                {{-- <input type="hidden" name="job_id" value="{{ $jobId ?? '' }}"> --}}

                                <div class="mb-4">
                                    <label for="technician_id" class="form-label fw-semibold">
                                        <i class="fe fe-users me-1"></i> Choose Technician
                                    </label>
                                    <select name="technician_id" id="technician_id" class="form-select form-select-lg py-2"
                                        required>
                                        <option value="">-- Select Technician --</option>
                                        @foreach ($techniciansList as $item)
                                            @php
                                                $profileImage = asset(
                                                    'userImages/' . ($item->profile_picture ?: 'common/blackicon.png'),
                                                );
                                            @endphp
                                            <option value="{{ $item->id }}" data-name="{{ $item->full_name }}"
                                                data-email="{{ $item->email }}"
                                                data-phone="{{ $item->phone_number ?? 'N/A' }}"
                                                data-image="{{ $profileImage }}">
                                                {{ $item->full_name }} | {{ $item->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">Only available technicians are shown.</div>
                                </div>

                                <!-- Live Technician Preview (dynamic) -->
                                <div class="mb-4 d-none" id="technicianPreview">
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
                                                    <small class="text-muted"><i class="fe fe-phone"></i> <span
                                                            id="previewPhone">-</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-0 px-0 pb-0 pt-2">
                                    <div class="d-flex justify-content-end gap-2">

                                        <button type="submit" class="btn btn-primary px-5">
                                            <i class="fa fa-save me-2"></i>Assign Technician
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

                    // Update avatar
                    previewAvatar.innerHTML = ''; // clear existing content
                    if (imageUrl) {
                        const img = document.createElement('img');
                        img.src = imageUrl;
                        img.alt = name;
                        img.classList.add('avatar-img', 'rounded-circle');
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        img.onerror = function() {
                            // fallback to icon on error
                            previewAvatar.innerHTML =
                                '<i class="fe fe-user text-primary" style="font-size: 1.5rem;"></i>';
                        };
                        previewAvatar.appendChild(img);
                    } else {
                        previewAvatar.innerHTML =
                            '<i class="fe fe-user text-primary" style="font-size: 1.5rem;"></i>';
                    }

                    previewDiv.classList.remove('d-none');
                } else {
                    previewDiv.classList.add('d-none');
                }
            }

            selectEl.addEventListener('change', updatePreview);
            updatePreview(); // initial call
        });
    </script>
@endsection
