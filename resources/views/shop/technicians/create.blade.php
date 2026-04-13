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
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('shop.technicians.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Full Name</label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                                            class="form-control" placeholder="Full Name" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="Email" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="" class="form-label">Phone Number</label>
                                        <input type="number" name="phone_number" value="{{ old('phone_number') }}"
                                            class="form-control" placeholder="Phone Number" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Profile Picture</label>
                                        <input type="file" name="profile_picture" class="form-control" accept="image/*"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Confrim Password</label>
                                        <input type="password" name="confirm_password" value="{{ old('confirm_password') }}"
                                            class="form-control" placeholder="Confrim Password" required>
                                    </div>
                                   
                                    

                                    <div class="card-footer">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save me-2"></i>Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
  
@endsection
