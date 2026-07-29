@extends('admin.layout.main')

@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="admin-card">
            <div class="card-header-custom">
                <h5>Profile Settings</h5>
            </div>
            <div class="card-body-custom">
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                    </div>

                    <hr class="my-4">
                    <p class="text-muted small mb-3">Leave password fields blank if you do not want to change your password.</p>

                    <div class="mb-3">
                        <label class="form-label fw-bold">New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
