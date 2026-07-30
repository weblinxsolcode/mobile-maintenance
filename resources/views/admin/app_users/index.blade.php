@extends('admin.layout.main')

@section('extra-css')
<style>
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }

    .user-avatar-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #26ACE8, #025BA0);
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #e2e8f0;
        flex-shrink: 0;
    }

    .badge-reg {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-reg.email {
        background: #ede9fe;
        color: #7c3aed;
    }

    .badge-reg.google {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-reg.facebook {
        background: #dbeafe;
        color: #2563eb;
    }

    .badge-reg.phone {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-reg.other {
        background: #f1f5f9;
        color: #64748b;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .status-dot.active {
        background: #16a34a;
    }

    .status-dot.blocked {
        background: #dc2626;
    }

    .status-dot.pending {
        background: #ca8a04;
    }

    .btn-block {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all .2s;
    }

    .btn-unblock {
        background: #dcfce7;
        color: #16a34a;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all .2s;
    }

    .btn-block:hover {
        background: #fecaca;
        color: #b91c1c;
    }

    .btn-unblock:hover {
        background: #bbf7d0;
        color: #15803d;
    }
</style>
@endsection

@section('content')

{{-- ── STATS ROW ── --}}
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe; color:#2563eb;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">Total App Users</div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a;">
                <i class="bi bi-person-check-fill"></i>
            </div>
            <div class="stat-number">{{ $activeUsers }}</div>
            <div class="stat-label">Active Users</div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fee2e2; color:#dc2626;">
                <i class="bi bi-person-x-fill"></i>
            </div>
            <div class="stat-number">{{ $blockedUsers }}</div>
            <div class="stat-label">Blocked Users</div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef9c3; color:#ca8a04;">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-number">{{ $pendingUsers }}</div>
            <div class="stat-label">Pending / Unverified</div>
        </div>
    </div>
</div>

{{-- ── USERS TABLE ── --}}
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-people-fill me-2" style="color:#2563eb;"></i>App Users</h5>
        <div class="d-flex align-items-center gap-3">
            <span class="badge" style="background:#dbeafe; color:#2563eb; font-size:13px; padding:6px 14px; border-radius:20px;">
                {{ $totalUsers }} {{ Str::plural('user', $totalUsers) }}
            </span>
            <a href="{{ route('admin.app_users.create') }}" class="btn-admin-primary">
                <i class="bi bi-plus-circle"></i> Add User
            </a>
        </div>
    </div>
    <div class="card-body-custom ">
        <div class="table-responsive">
            <table class="table datatable mb-0" style="width:100%;">
                <thead style="background:#f8fafc; font-size:13px; color:#64748b; font-weight:600;">
                    <tr>
                        <th style="padding:14px 20px;">#</th>
                        <th style="padding:14px 20px;">User</th>
                        <th style="padding:14px 20px;">Email</th>
                        <th style="padding:14px 20px;">Phone</th>
                        <th style="padding:14px 20px;">Signed Up Via</th>
                        <th style="padding:14px 20px;">Status</th>
                        <th style="padding:14px 20px;">Joined</th>
                        <th style="padding:14px 20px;">Actions</th>
                    </tr>
                </thead>
                <tbody style="font-size:14px; color:#0f172a;">
                    @forelse ($users as $index => $user)
                    <tr style="border-top: 1px solid #f1f5f9; vertical-align: middle;">

                        {{-- # --}}
                        <td style="padding:14px 20px; color:#94a3b8; font-weight:600;">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Avatar + Name --}}
                        <td style="padding:14px 20px;">
                            <div class="d-flex align-items-center gap-2">
                                @if ($user->profile_picture && $user->profile_picture !== 'default.jpg')
                                <img src="{{ asset('userImages/' . $user->profile_picture) }}" alt="avatar" class="user-avatar">
                                @else
                                <div class="user-avatar-placeholder">
                                    {{ strtoupper(substr($user->full_name ?? 'U', 0, 1)) }}
                                </div>
                                @endif
                                <div>
                                    <div style="font-weight:600; line-height:1.2;">
                                        {{ $user->full_name ?? '—' }}
                                    </div>
                                    <div style="font-size:12px; color:#94a3b8;">ID #{{ $user->id }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Email --}}
                        <td style="padding:14px 20px; color:#475569;">
                            {{ $user->email ?: '—' }}
                        </td>

                        {{-- Phone --}}
                        <td style="padding:14px 20px; color:#475569;">
                            {{ $user->phone_number ?: '—' }}
                        </td>

                        {{-- Registration Type --}}
                        <td style="padding:14px 20px;">
                            @php
                            $reg = strtolower($user->registration_type ?? 'other');
                            $regLabel = ucfirst($reg);
                            $regClass = in_array($reg, ['email','google','facebook','phone']) ? $reg : 'other';
                            $regIcon = match($reg) {
                            'google' => 'bi-google',
                            'facebook' => 'bi-facebook',
                            'phone' => 'bi-telephone-fill',
                            'email' => 'bi-envelope-fill',
                            default => 'bi-phone-fill',
                            };
                            @endphp
                            <span class="badge-reg {{ $regClass }}">
                                <i class="bi {{ $regIcon }} me-1"></i>{{ $regLabel }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td style="padding:14px 20px;">
                            @php
                            $st = strtolower($user->status ?? 'pending');
                            $stClass = match($st) {
                            'active' => 'active',
                            'blocked' => 'blocked',
                            default => 'pending',
                            };
                            $stLabel = match($st) {
                            'active' => 'Active',
                            'blocked' => 'Blocked',
                            default => 'Pending',
                            };
                            $stColor = match($st) {
                            'active' => '#16a34a',
                            'blocked' => '#dc2626',
                            default => '#ca8a04',
                            };
                            @endphp
                            <span class="d-flex align-items-center">
                                <span class="status-dot {{ $stClass }}"></span>
                                <span style="font-weight:600; font-size:13px; color:{{ $stColor }};">
                                    {{ $stLabel }}
                                </span>
                            </span>
                        </td>

                        {{-- Joined --}}
                        <td style="padding:14px 20px; color:#64748b; font-size:13px; white-space:nowrap;">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}
                        </td>

                        {{-- Actions --}}
                        <td style="padding:14px 20px;">
                            <div class="d-flex align-items-center gap-2">
                                {{-- Edit --}}
                                <a href="{{ route('admin.app_users.edit', $user->id) }}"
                                   style="background:#ede9fe; color:#7c3aed; border:none; padding:6px 12px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px;">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>

                                {{-- Block / Unblock --}}
                                @if ($user->status === 'blocked')
                                <button type="button" class="btn-unblock open-confirm-modal"
                                    data-url="{{ route('admin.app_users.toggleBlock', $user->id) }}"
                                    data-name="{{ addslashes($user->full_name) }}"
                                    data-action="unblock">
                                    <i class="bi bi-unlock-fill"></i>
                                </button>
                                @else
                                <button type="button" class="btn-block open-confirm-modal"
                                    data-url="{{ route('admin.app_users.toggleBlock', $user->id) }}"
                                    data-name="{{ addslashes($user->full_name) }}"
                                    data-action="block">
                                    <i class="bi bi-slash-circle"></i>
                                </button>
                                @endif

                                {{-- Delete --}}
                                <button type="button" class="open-confirm-modal"
                                    style="background:#fee2e2; color:#dc2626; border:none; padding:6px 12px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:4px;"
                                    data-url="{{ route('admin.app_users.delete', $user->id) }}"
                                    data-name="{{ addslashes($user->full_name) }}"
                                    data-action="delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:60px; color:#94a3b8;">
                            <i class="bi bi-people" style="font-size:48px; display:block; margin-bottom:12px; opacity:.4;"></i>
                            <div style="font-size:16px; font-weight:600;">No app users found</div>
                            <div style="font-size:13px; margin-top:4px;">Users who register through the mobile app will appear here.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ── CONFIRM MODAL ── --}}
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content" style="border-radius:16px; border:none; box-shadow:0 20px 60px rgba(0,0,0,.15);">

            <div class="modal-body" style="padding:36px 32px 24px; text-align:center;">
                <div id="modal-icon-wrap" style="width:72px; height:72px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; font-size:32px;"></div>
                <h5 id="modal-title" style="font-weight:700; font-size:18px; color:#0f172a; margin-bottom:8px;"></h5>
                <p id="modal-desc" style="color:#64748b; font-size:14px; margin:0;"></p>
            </div>

            <div class="modal-footer" style="border:none; padding:0 32px 28px; justify-content:center; gap:12px;">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                    style="padding:10px 28px; border-radius:10px; font-weight:600; font-size:14px;">
                    Cancel
                </button>
                <a id="modal-confirm-btn" href="#"
                    style="padding:10px 28px; border-radius:10px; font-weight:600; font-size:14px; color:#fff; text-decoration:none; display:inline-block;">
                    Confirm
                </a>
            </div>
        </div>
    </div>
</div>

@section('extra-js')
<script>
    document.querySelectorAll('.open-confirm-modal').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var action     = this.dataset.action;
            var name       = this.dataset.name;
            var url        = this.dataset.url;

            var iconWrap   = document.getElementById('modal-icon-wrap');
            var title      = document.getElementById('modal-title');
            var desc       = document.getElementById('modal-desc');
            var confirmBtn = document.getElementById('modal-confirm-btn');

            if (action === 'block') {
                iconWrap.style.background   = '#fee2e2';
                iconWrap.innerHTML          = '<i class="bi bi-slash-circle" style="color:#dc2626;"></i>';
                title.textContent           = 'Block User?';
                desc.textContent            = 'Are you sure you want to block "' + name + '"? They will not be able to use the app.';
                confirmBtn.style.background = '#dc2626';
                confirmBtn.textContent      = 'Yes, Block';
            } else if (action === 'unblock') {
                iconWrap.style.background   = '#dcfce7';
                iconWrap.innerHTML          = '<i class="bi bi-unlock-fill" style="color:#16a34a;"></i>';
                title.textContent           = 'Unblock User?';
                desc.textContent            = 'Are you sure you want to unblock "' + name + '"? They will be able to use the app again.';
                confirmBtn.style.background = '#16a34a';
                confirmBtn.textContent      = 'Yes, Unblock';
            } else if (action === 'delete') {
                iconWrap.style.background   = '#fee2e2';
                iconWrap.innerHTML          = '<i class="bi bi-trash-fill" style="color:#dc2626;"></i>';
                title.textContent           = 'Delete User?';
                desc.textContent            = 'Are you sure you want to permanently delete "' + name + '"? This action cannot be undone.';
                confirmBtn.style.background = '#dc2626';
                confirmBtn.textContent      = 'Yes, Delete';
            }

            confirmBtn.href = url;
            var modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
        });
    });
</script>
@endsection

@endsection