@extends('shop.layout.main')

@section('section')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <div class="page-wrapper" style="min-height: 503px;">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">{{ $title }}</h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card customShadow">
                        <form action="{{ route('shop.profile.update', $shopInfo->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Please enter username" value="{{ $shopInfo->username }}">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Please enter email" value="{{ $shopInfo->email }}">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="profile">Profile Image</label>
                                        <input type="file" name="profile" class="form-control" accept="image/*">
                                        @if ($shopInfo->profile)
                                            <img src="{{ asset($shopInfo->profile ?? 'common/blackicon.png') }}" onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';" class="mt-2" alt="Profile Image" width="100">
                                        @else
                                            <img src="{{ asset('common/default.png') }}" alt="Profile Image" width="100">
                                        @endif
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Please enter password" value="">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            placeholder="Please enter confirm password" value="">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Please enter title" value="{{ $shopInfo->title }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control"
                                            placeholder="Please enter phone number" value="{{ $shopInfo->phone_number }}">
                                    </div>

                                    <!-- ── Shop Address & Interactive Map (Leaflet) ─────────────────────── -->
                                    <div class="col-lg-12 form-group">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label class="mb-0 fw-bold"><i class="fa fa-map-marker-alt text-danger me-1"></i>Shop Address & Map Location</label>
                                            <div class="d-flex align-items-center gap-2">
                                                <span id="coord_badge_profile" class="badge {{ $shopInfo->latitude && $shopInfo->longitude ? 'bg-success text-white' : 'bg-light text-secondary border' }}">
                                                    {{ $shopInfo->latitude && $shopInfo->longitude ? 'Lat: '.round($shopInfo->latitude, 4).', Lng: '.round($shopInfo->longitude, 4) : 'Drag pin or click map to set' }}
                                                </span>
                                                @if($shopInfo->latitude && $shopInfo->longitude)
                                                <a href="https://www.google.com/maps?q={{ $shopInfo->latitude }},{{ $shopInfo->longitude }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-success py-0 px-2"
                                                   title="Open current location in Google Maps">
                                                    <i class="fa fa-external-link-alt me-1"></i> Google Maps
                                                </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group mb-2">
                                            <input type="text" id="address" name="address"
                                                value="{{ old('address') ?? $shopInfo->address }}"
                                                class="form-control"
                                                placeholder="Type area, landmark, or street name (e.g. Mansour, Baghdad)..."
                                                autocomplete="off">
                                            <button type="button" id="btn_search_profile" class="btn btn-outline-primary px-3">
                                                <i class="fa fa-search me-1"></i> Search
                                            </button>
                                            <button type="button" id="btn_locate_profile" class="btn btn-outline-secondary px-3" title="Use current GPS location">
                                                <i class="fa fa-crosshairs me-1"></i> My Location
                                            </button>
                                        </div>

                                        <div id="search_feedback_profile" class="small text-muted mb-2">
                                            <i class="fa fa-info-circle me-1"></i>Search address or drag the marker / click anywhere on the map to set your shop's exact location.
                                        </div>

                                        <!-- Map container -->
                                        <div id="shop_map_profile" style="height: 320px; width: 100%; border-radius: 8px; border: 1px solid #ced4da; z-index: 1;"></div>

                                        <!-- Hidden lat/lon fields -->
                                        <input type="hidden" name="latitude"  id="latitude"  value="{{ old('latitude', $shopInfo->latitude) }}">
                                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $shopInfo->longitude) }}">
                                    </div>

                                    <div class="col-lg-12 form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" style="height: 100px">{{ $shopInfo->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            L.Icon.Default.imagePath = 'https://unpkg.com/leaflet@1.9.4/dist/images/';

            var latInput = document.getElementById('latitude');
            var lngInput = document.getElementById('longitude');
            var addrInput = document.getElementById('address');
            var coordBadge = document.getElementById('coord_badge_profile');
            var feedback = document.getElementById('search_feedback_profile');
            var searchBtn = document.getElementById('btn_search_profile');
            var locateBtn = document.getElementById('btn_locate_profile');

            var initialLat = parseFloat(latInput.value);
            var initialLng = parseFloat(lngInput.value);
            var hasInitialCoords = !isNaN(initialLat) && !isNaN(initialLng) && initialLat !== 0;

            // Default: Existing shop coordinates or Baghdad center (33.3152, 44.3661)
            var defaultLat = hasInitialCoords ? initialLat : 33.3152;
            var defaultLng = hasInitialCoords ? initialLng : 44.3661;
            var defaultZoom = hasInitialCoords ? 15 : 12;

            var map = L.map('shop_map_profile').setView([defaultLat, defaultLng], defaultZoom);

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
                coordBadge.className = 'badge bg-success text-white';

                if (popupText) {
                    marker.bindPopup(popupText).openPopup();
                }
            }

            if (hasInitialCoords) {
                updateCoords(initialLat, initialLng, 'Shop Location: ' + initialLat.toFixed(4) + ', ' + initialLng.toFixed(4));
            }

            // Drag marker
            marker.on('dragend', function (e) {
                var pos = marker.getLatLng();
                updateCoords(pos.lat, pos.lng, 'Adjusted Pin: ' + pos.lat.toFixed(5) + ', ' + pos.lng.toFixed(5));
                feedback.innerHTML = '<span class="text-success"><i class="fa fa-check-circle me-1"></i>Pin moved! New shop location coordinates saved.</span>';
            });

            // Click on map to move marker
            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                updateCoords(e.latlng.lat, e.latlng.lng, 'Pinned here');
                feedback.innerHTML = '<span class="text-success"><i class="fa fa-check-circle me-1"></i>Pin placed! Drag to adjust exact building spot.</span>';
            });

            // Search address via Nominatim API
            function doSearch() {
                var query = addrInput.value.trim();
                if (!query) {
                    feedback.innerHTML = '<span class="text-warning"><i class="fa fa-exclamation-triangle me-1"></i>Please enter an area or address to search.</span>';
                    return;
                }

                searchBtn.disabled = true;
                searchBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Searching...';
                feedback.innerHTML = '<span class="text-muted"><i class="fa fa-spinner fa-spin me-1"></i>Searching OpenStreetMap...</span>';

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

                            feedback.innerHTML = '<span class="text-success"><i class="fa fa-check-circle me-1"></i>Location found! Drag marker to fine-tune.</span>';
                        } else {
                            feedback.innerHTML = '<span class="text-danger"><i class="fa fa-times-circle me-1"></i>Address not found. Try searching for a neighborhood or city name, or drag the marker manually.</span>';
                        }
                    })
                    .catch(function (err) {
                        console.error(err);
                        feedback.innerHTML = '<span class="text-danger"><i class="fa fa-exclamation-circle me-1"></i>Search error. You can still drag the pin or click on the map directly.</span>';
                    })
                    .finally(function () {
                        searchBtn.disabled = false;
                        searchBtn.innerHTML = '<i class="fa fa-search me-1"></i> Search';
                    });
            }

            searchBtn.addEventListener('click', doSearch);

            // Prevent Enter key in address input from submitting the profile form prematurely
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
                        feedback.innerHTML = '<span class="text-success"><i class="fa fa-crosshairs me-1"></i>Current GPS location detected!</span>';
                        locateBtn.disabled = false;
                        locateBtn.innerHTML = '<i class="fa fa-crosshairs me-1"></i> My Location';
                    },
                    function (err) {
                        alert('Unable to retrieve your location. Please check browser permissions.');
                        locateBtn.disabled = false;
                        locateBtn.innerHTML = '<i class="fa fa-crosshairs me-1"></i> My Location';
                    },
                    { enableHighAccuracy: true, timeout: 8000 }
                );
            });

            // Ensure tiles render correctly without grey areas
            setTimeout(function () {
                map.invalidateSize();
            }, 300);
        });
    </script>
@endsection