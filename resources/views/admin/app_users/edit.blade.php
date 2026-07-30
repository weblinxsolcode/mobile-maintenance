@extends('admin.layout.main')

@section('extra-css')
<style>
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,.07);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        max-width: 720px;
        margin: 0 auto;
    }
    .form-card .form-card-header {
        padding: 22px 28px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; gap: 12px;
    }
    .form-card .form-card-header h5 {
        margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;
    }
    .form-card .form-card-body { padding: 28px; }
    .form-label-custom {
        font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; display: block;
    }
    .form-control-custom {
        width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0;
        border-radius: 10px; font-size: 14px; color: #0f172a;
        background: #f8fafc; transition: border-color .2s, box-shadow .2s;
        outline: none;
    }
    .form-control-custom:focus {
        border-color: #26ACE8; background: #fff;
        box-shadow: 0 0 0 3px rgba(38,172,232,.12);
    }
    .form-select-custom {
        width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0;
        border-radius: 10px; font-size: 14px; color: #0f172a;
        background: #f8fafc; transition: border-color .2s;
        outline: none; appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='%2364748b' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center;
    }
    .form-select-custom:focus {
        border-color: #26ACE8; background-color: #fff;
        box-shadow: 0 0 0 3px rgba(38,172,232,.12);
    }
    .avatar-preview-wrap {
        width: 80px; height: 80px; border-radius: 50%;
        border: 3px dashed #e2e8f0; overflow: hidden;
        display: flex; align-items: center; justify-content: center;
        background: #f8fafc; cursor: pointer; transition: border-color .2s;
    }
    .avatar-preview-wrap:hover { border-color: #26ACE8; }
    .avatar-preview-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .avatar-preview-wrap .placeholder-icon { font-size: 28px; color: #94a3b8; }
</style>
@endsection

@section('content')
<div class="form-card">
    <div class="form-card-header">
        <div style="width:38px;height:38px;border-radius:10px;background:#ede9fe;display:flex;align-items:center;justify-content:center;color:#7c3aed;font-size:18px;">
            <i class="bi bi-pencil-fill"></i>
        </div>
        <h5>Edit App User</h5>
    </div>

    <div class="form-card-body">
        <form action="{{ route('admin.app_users.update', $userItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Avatar Upload --}}
            <div class="mb-4 text-center">
                <label for="profile_picture" style="cursor:pointer;">
                    <div class="avatar-preview-wrap mx-auto" id="avatarWrap">
                        @if ($userItem->profile_picture && $userItem->profile_picture !== 'default.jpg')
                            <img id="avatarPreview" src="{{ asset('userImages/' . $userItem->profile_picture) }}" style="display:block;">
                        @else
                            <img id="avatarPreview" src="{{ asset('common/default.jpg') }}" style="display:block;">
                        @endif
                    </div>
                    <div style="font-size:12px; color:#64748b; margin-top:8px;">Click to change photo</div>
                </label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display:none;" onchange="previewAvatar(this)">
            </div>

            <div class="row g-3">
                {{-- Full Name --}}
                <div class="col-12">
                    <label class="form-label-custom">Full Name <span style="color:#dc2626">*</span></label>
                    <input type="text" name="full_name" class="form-control-custom @error('full_name') is-invalid @enderror"
                        placeholder="Enter full name" value="{{ old('full_name', $userItem->full_name) }}" required>
                    @error('full_name')<div class="text-danger" style="font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label class="form-label-custom">Email</label>
                    <input type="email" name="email" class="form-control-custom @error('email') is-invalid @enderror"
                        placeholder="user@email.com" value="{{ old('email', $userItem->email) }}">
                    @error('email')<div class="text-danger" style="font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                {{-- Phone --}}
                <div class="col-md-6">
                    <label class="form-label-custom">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control-custom @error('phone_number') is-invalid @enderror"
                        placeholder="+92 300 0000000" value="{{ old('phone_number', $userItem->phone_number) }}">
                    @error('phone_number')<div class="text-danger" style="font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                {{-- Password --}}
                <div class="col-12">
                    <label class="form-label-custom">New Password <span style="color:#94a3b8; font-weight:400;">(leave blank to keep current)</span></label>
                    <input type="password" name="password" class="form-control-custom @error('password') is-invalid @enderror"
                        placeholder="Minimum 6 characters">
                    @error('password')<div class="text-danger" style="font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6">
                    <label class="form-label-custom">Status <span style="color:#dc2626">*</span></label>
                    <select name="status" class="form-select-custom @error('status') is-invalid @enderror" required>
                        <option value="active"  {{ old('status', $userItem->status) == 'active'  ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ old('status', $userItem->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="blocked" {{ old('status', $userItem->status) == 'blocked' ? 'selected' : '' }}>Blocked</option>
                    </select>
                    @error('status')<div class="text-danger" style="font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Buttons --}}
            <div class="d-flex align-items-center gap-3 mt-4">
                <button type="submit" class="btn-admin-primary">
                    <i class="bi bi-check-circle-fill"></i> Update User
                </button>
                <a href="{{ route('admin.app_users.index') }}"
                   style="padding:9px 20px; border-radius:10px; font-weight:600; font-size:14px; color:#64748b; text-decoration:none; background:#f1f5f9; display:inline-flex; align-items:center; gap:6px;">
                    <i class="bi bi-arrow-left"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@section('extra-js')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
                document.getElementById('avatarPreview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@endsection
