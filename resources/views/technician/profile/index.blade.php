@extends('technician.layout.main')

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
                        <form action="{{ route('technician.profile.update', $technicianInfo->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="full_name" class="form-control"
                                            placeholder="Please enter full name" value="{{ $technicianInfo->full_name }}">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Please enter email" value="{{ $technicianInfo->email }}">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Profile Image</label>
                                        <input type="file" name="profile_picture" class="form-control" accept="image/*">
                                        @if ($technicianInfo->profile_picture)
                                            <img src="{{ asset('userImages/' . $technicianInfo->profile_picture ?? 'common/blackicon.png') }}" onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';" class="mt-2" alt="Profile Image" width="100">
                                        @else
                                            <img src="{{ asset('common/default.png') }}" alt="Profile Image" width="100">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="number" name="phone_number" class="form-control"
                                            placeholder="Please enter phone_number" value="{{ $technicianInfo->phone_number }}">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Please enter password" value="">
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="name">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            placeholder="Please enter confirm password" value="">
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
  
@endsection
