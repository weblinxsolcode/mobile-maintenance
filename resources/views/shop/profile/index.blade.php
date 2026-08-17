@extends('shop.layout.main')

@section('section')
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
                                        <label for="name">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Please enter username" value="{{ $shopInfo->username }}">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Please enter email" value="{{ $shopInfo->email }}">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Profile Image</label>
                                        <input type="file" name="profile" class="form-control" accept="image/*">
                                        @if ($shopInfo->profile)
                                            <img src="{{ asset($shopInfo->profile ?? 'common/blackicon.png') }}" onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';" class="mt-2" alt="Profile Image" width="100">
                                        @else
                                            <img src="{{ asset('common/default.png') }}" alt="Profile Image" width="100">
                                        @endif
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="name">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Please enter password" value="">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="name">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            placeholder="Please enter confirm password" value="">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="name">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Please enter title" value="{{ $shopInfo->title }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control"
                                            placeholder="Please enter phone number" value="{{ $shopInfo->phone_number }}">
                                    </div>

                                    <!-- ── Address + Location Button ─────────────────────── -->
                                    <div class="col-lg-6 form-group">
                                        <label>Address</label>
                                        <div class="d-flex gap-2 align-items-start">
                                            <div class="flex-grow-1">
                                                <input type="text" id="address" name="address"
                                                    value="{{ old('address') ?? $shopInfo->address }}"
                                                    class="form-control"
                                                    placeholder="Type address or search..."
                                                    autocomplete="off">
                                            </div>
                                            <!-- 🗺️ View on Google Maps Button -->
                                            @if($shopInfo->latitude && $shopInfo->longitude)
                                            <a href="https://www.google.com/maps?q={{ $shopInfo->latitude }},{{ $shopInfo->longitude }}"
                                               target="_blank"
                                               class="btn btn-outline-success flex-shrink-0"
                                               title="View saved location on Google Maps"
                                               style="white-space:nowrap; height:38px; margin-top:2px;">
                                                <i class="fa fa-map-marker-alt me-1"></i> View on Map
                                            </a>
                                            @else
                                            <button type="button" class="btn btn-outline-secondary flex-shrink-0 disabled"
                                                    style="white-space:nowrap; height:38px; margin-top:2px;"
                                                    title="No location saved yet">
                                                <i class="fa fa-map-marker-alt me-1"></i> No Location
                                            </button>
                                            @endif
                                        </div>

                                        <!-- Hidden lat/lon fields -->
                                        <input type="hidden" name="latitude"  id="latitude"  value="{{ $shopInfo->latitude }}">
                                        <input type="hidden" name="longitude" id="longitude" value="{{ $shopInfo->longitude }}">
                                    </div>

                                    <div class="col-lg-12 form-group">
                                        <label for="name">Description</label>
                                        <textarea name="description" class="form-control" style="height: 100px">{{ $shopInfo->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $google_api_key }}&libraries=places"></script>
    <script>
        // ── Google Places Autocomplete ───────────────────────────────────
        var autocomplete;

        function initAutocomplete() {
            var input    = document.getElementById('address');
            var latField = document.getElementById('latitude');
            var lngField = document.getElementById('longitude');

            autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode']
            });

            // ✅ Jab user dropdown se address select kare — lat/lon update hoga
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User ne select nahi kiya, sirf type kiya
                    latField.value = '';
                    lngField.value = '';
                    return;
                }
                latField.value = place.geometry.location.lat();
                lngField.value = place.geometry.location.lng();
            });

            // ✅ Jab user address field mein kuch type kare — purani lat/lon clear
            input.addEventListener('input', function () {
                latField.value = '';
                lngField.value = '';
            });
        }

        // Script synchronous load ho raha hai, DOMContentLoaded pe init karo
        document.addEventListener('DOMContentLoaded', initAutocomplete);
    </script>
@endsection
