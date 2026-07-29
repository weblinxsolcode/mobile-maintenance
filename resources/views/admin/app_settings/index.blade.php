@extends('admin.layout.main')

@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="admin-card">
            <div class="card-header-custom">
                <h5>App Settings</h5>
            </div>
            <div class="card-body-custom">
                <form action="{{ route('admin.app_settings.update') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Google API Key</label>
                            <input type="text" name="google_api_key" class="form-control"
                                value="{{ old('google_api_key', $settings->google_api_key) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Near By Location Radius (or query)</label>
                            <input type="text" name="near_by_location" class="form-control"
                                value="{{ old('near_by_location', $settings->near_by_location) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Privacy Policy</label>
                            <textarea name="privacy_policy" class="form-control" rows="5">{{ old('privacy_policy', $settings->privacy_policy) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Terms & Conditions</label>
                            <textarea name="terms_and_condition" class="form-control" rows="5">{{ old('terms_and_condition', $settings->terms_and_condition) }}</textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">About Us</label>
                            <textarea name="about_us" class="form-control" rows="5">{{ old('about_us', $settings->about_us) }}</textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-save"></i> Save App Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection