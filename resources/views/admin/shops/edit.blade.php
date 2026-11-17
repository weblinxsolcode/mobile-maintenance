@extends('admin.layout.main')

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

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

                        <!-- Address & OpenStreetMap (Leaflet) -->
                        <div class="col-12">
                            <label class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-geo-alt-fill me-1" style="color:#6366f1;"></i>Address & Map Location</span>
                                <span id="coord_badge_edit" class="badge {{ $shopItem->latitude && $shopItem->longitude ? 'bg-success text-white' : 'bg-light text-secondary border' }} fw-normal" style="font-size: 0.78rem;">
                                    {{ $shopItem->latitude && $shopItem->longitude ? 'Lat: '.round($shopItem->latitude, 4).', Lng: '.round($shopItem->longitude, 4) : 'Drag pin or click map to set' }}
                                </span>
                            </label>

                            <div class="input-group">
                                <input type="text"
                                       id="address_input_edit"
                                       name="address"
                                       class="form-control rounded-start-3"
                                       value="{{ old('address', $shopItem->address) }}"
                                       placeholder="Type city, area, or street (e.g. Mansour, Baghdad)..."
                                       autocomplete="off">
                                <button type="button" id="btn_search_edit" class="btn btn-outline-primary px-3">
                                    <i class="bi bi-search me-1"></i> Search
                                </button>
                                <button type="button" id="btn_locate_edit" class="btn btn-outline-secondary px-3" title="Use current GPS location">
                                    <i class="bi bi-crosshair me-1"></i> My Location
                                </button>
                            </div>

                            <div id="search_feedback_edit" class="small mt-1 text-muted">
                                <i class="bi bi-info-circle me-1"></i>Type address & click <b>Search</b>, or drag the marker / click anywhere on the map to change the shop's pinned spot.
                            </div>

                            <!-- Map container -->
                            <div id="shop_map_edit" style="height: 320px; width: 100%; border-radius: 10px; border: 1px solid #dee2e6; margin-top: 10px; z-index: 1;"></div>

                            <!-- Hidden lat/lon (auto-filled by Leaflet marker) -->
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

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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

    // ─── OpenStreetMap (Leaflet) Interactive Map ─────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        L.Icon.Default.imagePath = 'https://unpkg.com/leaflet@1.9.4/dist/images/';

        var latInput = document.getElementById('latitude_edit');
        var lngInput = document.getElementById('longitude_edit');
        var addrInput = document.getElementById('address_input_edit');
        var coordBadge = document.getElementById('coord_badge_edit');
        var feedback = document.getElementById('search_feedback_edit');
        var searchBtn = document.getElementById('btn_search_edit');
        var locateBtn = document.getElementById('btn_locate_edit');

        var initialLat = parseFloat(latInput.value);
        var initialLng = parseFloat(lngInput.value);
        var hasInitialCoords = !isNaN(initialLat) && !isNaN(initialLng) && initialLat !== 0;

        // Default: Existing shop coordinates or Baghdad center (33.3152, 44.3661)
        var defaultLat = hasInitialCoords ? initialLat : 33.3152;
        var defaultLng = hasInitialCoords ? initialLng : 44.3661;
        var defaultZoom = hasInitialCoords ? 15 : 12;

        var map = L.map('shop_map_edit').setView([defaultLat, defaultLng], defaultZoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        function updateCoords(lat, lng, popupText) {
            var latFixed = Number(lat).toFixed(6);
            var lngFixed = Number(lng).toFixed(6);

            latInput.value = latFixed;
            lngInput.value = lngFixed;
            coordBadge.textContent = 'Lat: ' + latFixed + ', Lng: ' + lngFixed;
            coordBadge.className = 'badge bg-success text-white fw-normal';

            if (popupText) {
                marker.bindPopup(popupText).openPopup();
            }
        }

        if (hasInitialCoords) {
            updateCoords(initialLat, initialLng, 'Current Shop Location');
        }

        // Drag marker
        marker.on('dragend', function (e) {
            var pos = marker.getLatLng();
            updateCoords(pos.lat, pos.lng, 'Adjusted Pin: ' + pos.lat.toFixed(5) + ', ' + pos.lng.toFixed(5));
            feedback.innerHTML = '<span class="text-success"><i class="bi bi-check-circle me-1"></i>Pin adjusted! Exact coordinates captured.</span>';
        });

        // Click on map to move marker
        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            updateCoords(e.latlng.lat, e.latlng.lng, 'Pinned here');
            feedback.innerHTML = '<span class="text-success"><i class="bi bi-check-circle me-1"></i>Pin placed! You can drag it to fine-tune.</span>';
        });

        // Search address via Nominatim API
        function doSearch() {
            var query = addrInput.value.trim();
            if (!query) {
                feedback.innerHTML = '<span class="text-warning"><i class="bi bi-exclamation-triangle me-1"></i>Please enter an area or address to search.</span>';
                return;
            }

            searchBtn.disabled = true;
            searchBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Searching...';
            feedback.innerHTML = '<span class="text-muted"><i class="bi bi-hourglass-split me-1"></i>Searching OpenStreetMap...</span>';

            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(query) + '&limit=1')
                .then(function (response) { return response.json(); })
                .then(function (data) {
                    if (data && data.length > 0) {
                        var result = data[0];
                        var newLat = parseFloat(result.lat);
                        var newLng = parseFloat(result.lon);

                        map.flyTo([newLat, newLng], 16);
                        marker.setLatLng([newLat, newLng]);
                        updateCoords(newLat, newLng, result.display_name.substring(0, 50) + '...');

                        feedback.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>Location found! Drag pin to fine-tune exact spot.</span>';
                    } else {
                        feedback.innerHTML = '<span class="text-danger"><i class="bi bi-x-circle me-1"></i>Address not found. Try searching for a broader area or city name, or drag the pin manually.</span>';
                    }
                })
                .catch(function (err) {
                    console.error(err);
                    feedback.innerHTML = '<span class="text-danger"><i class="bi bi-wifi-off me-1"></i>Search error. You can still drag the pin or click on the map directly.</span>';
                })
                .finally(function () {
                    searchBtn.disabled = false;
                    searchBtn.innerHTML = '<i class="bi bi-search me-1"></i> Search';
                });
        }

        searchBtn.addEventListener('click', doSearch);

        // Prevent Enter from submitting form when typing in address input
        addrInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                doSearch();
            }
        });

        // Use Current Location
        locateBtn.addEventListener('click', function () {
            if (!navigator.geolocation) {
                alert('Geolocation is not supported by your browser.');
                return;
            }
            locateBtn.disabled = true;
            locateBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Locating...';

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;
                    map.flyTo([userLat, userLng], 16);
                    marker.setLatLng([userLat, userLng]);
                    updateCoords(userLat, userLng, 'Current GPS Location');
                    feedback.innerHTML = '<span class="text-success"><i class="bi bi-crosshair me-1"></i>Current GPS location detected!</span>';
                    locateBtn.disabled = false;
                    locateBtn.innerHTML = '<i class="bi bi-crosshair me-1"></i> My Location';
                },
                function (err) {
                    alert('Unable to retrieve your location. Please check browser permissions.');
                    locateBtn.disabled = false;
                    locateBtn.innerHTML = '<i class="bi bi-crosshair me-1"></i> My Location';
                },
                { enableHighAccuracy: true, timeout: 8000 }
            );
        });

        // Ensure tiles render correctly without grey area
        setTimeout(function () {
            map.invalidateSize();
        }, 300);
    });
</script>
@endsection