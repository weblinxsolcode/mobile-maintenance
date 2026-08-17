@extends('admin.layout.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header-custom">
                <h5><i class="bi bi-pencil-square me-2" style="color:#6366f1;"></i>Edit Shop: {{ ucfirst($shopItem->username) }}</h5>
                <a href="{{ route('admin.shops.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i>Back to List
                </a>
            </div>
            <div class="card-body-custom">
                <form action="{{ route('admin.shops.update', $shopItem->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <!-- Username -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control rounded-3"
                                   value="{{ old('username', $shopItem->username) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control rounded-3"
                                   value="{{ old('email', $shopItem->email) }}" required>
                        </div>

                        <!-- Password (optional) -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                            <input type="password" name="password" class="form-control rounded-3"
                                   placeholder="Enter new password" minlength="6">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control rounded-3"
                                   value="{{ old('phone_number', $shopItem->phone_number) }}">
                        </div>

                        <!-- Shop Title -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Shop Title</label>
                            <input type="text" name="title" class="form-control rounded-3"
                                   value="{{ old('title', $shopItem->title) }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="active"   {{ ($shopItem->status === 'active')  ? 'selected' : '' }}>Active</option>
                                <option value="pending"  {{ ($shopItem->status === 'pending') ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>

                        <!-- Address with Google Maps Autocomplete -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-geo-alt-fill me-1" style="color:#6366f1;"></i>Address
                            </label>
                            <div class="position-relative">
                                <input type="text"
                                       id="address_input_edit"
                                       name="address"
                                       class="form-control rounded-3 pe-5"
                                       value="{{ old('address', $shopItem->address) }}"
                                       placeholder="Type city or full address..."
                                       autocomplete="off">
                                <span id="address_loading_edit"
                                      class="position-absolute top-50 end-0 translate-middle-y me-3 d-none">
                                    <span class="spinner-border spinner-border-sm text-secondary"></span>
                                </span>
                            </div>
                            <!-- Hidden lat/lon (auto-filled by script) -->
                            <input type="hidden" name="latitude"  id="latitude_edit"  value="{{ old('latitude', $shopItem->latitude) }}">
                            <input type="hidden" name="longitude" id="longitude_edit" value="{{ old('longitude', $shopItem->longitude) }}">
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control rounded-3" rows="3">{{ old('description', $shopItem->description) }}</textarea>
                        </div>

                        <!-- Profile Image -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Profile Image</label>
                            <input type="file" name="profile" class="form-control rounded-3" accept="image/*"
                                   onchange="previewImage(this, 'imgPreview')">
                            <div class="mt-2">
                                <img id="imgPreview"
                                     src="{{ $shopItem->profile && $shopItem->profile !== 'default.jpg' ? asset($shopItem->profile) : asset('common/blackicon.png') }}"
                                     onerror="this.src='{{ asset('common/blackicon.png') }}'"
                                     width="80" height="80" class="rounded-circle border" style="object-fit:cover;">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="col-12 d-flex gap-2 mt-2">
                            <button type="submit" class="btn-admin-primary">
                                <i class="bi bi-check-circle"></i> Update Shop
                            </button>
                            <a href="{{ route('admin.shops.index') }}" class="btn btn-outline-secondary rounded-3">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ─── Google Maps Places Autocomplete ────────────────────────────
    function initGoogleAutocompleteEdit() {
        var input    = document.getElementById('address_input_edit');
        var latField = document.getElementById('latitude_edit');
        var lngField = document.getElementById('longitude_edit');

        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['geocode']
        });

        // ✅ Dropdown se address select karo — lat/lon update
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // Select nahi kiya — lat/lon clear
                latField.value = '';
                lngField.value = '';
                return;
            }
            latField.value = place.geometry.location.lat();
            lngField.value = place.geometry.location.lng();
        });

        // ✅ Type karne par purani lat/lon clear
        input.addEventListener('input', function () {
            latField.value = '';
            lngField.value = '';
        });
    }
</script>

@if(!empty($googleApiKey))
<script src="https://maps.googleapis.com/maps/api/js?key={{ $googleApiKey }}&libraries=places&callback=initGoogleAutocompleteEdit" async defer></script>
@endif

@endsection
