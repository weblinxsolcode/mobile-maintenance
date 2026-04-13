@extends('shop.layout.main')

@section('section')
    <div class="page-wrapper" bis_skin_checked="1" style="min-height: 503px;">
        <div class="content container-fluid" bis_skin_checked="1">
            <!-- Page Header -->
            <div class="page-header" bis_skin_checked="1">
                <div class="row" bis_skin_checked="1">
                    <div class="col-sm-12" bis_skin_checked="1">
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
                                        <label>Address</label>
                                        <input type="text" id="address" name="address"
                                            value="{{ old('address') ?? $shopInfo->address }}" class="form-control"
                                            placeholder="Address">
                                        <input type="hidden" name="latitude" id="latitude"
                                            value="{{ $shopInfo->latitude }}">
                                        <input type="hidden" name="longitude" id="longitude"
                                            value="{{ $shopInfo->longitude }}">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label for="name">Description</label>
                                        <textarea name="description" class="form-control" style="height: 100px" id="">{{ $shopInfo->description }}</textarea>
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
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $google_api_key }}&libraries=places"></script>
    <script>
        function initAutocomplete() {

            var input = document.getElementById('address');

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {

                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    return;
                }

                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });

        }

        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>
@endsection
