@extends('shop.layout.main')

@section('section')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap');

        .backup-wrap {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            /* padding: 1.5rem; */
        }

        .backup-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .backup-card-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 1.5rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .backup-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .backup-card-body {
            padding: 2rem 1.5rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-badge.failed {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-badge.manual {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .status-badge.auto {
            background-color: #f5f3ff;
            color: #5b21b6;
        }

        .form-group label {
            font-weight: 600;
            color: #334155;
            font-size: 0.9rem;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            padding: 0.75rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .info-alert {
            background-color: #eff6ff;
            border-left: 4px solid #2563eb;
            border-radius: 0 10px 10px 0;
            padding: 1rem;
            font-size: 0.88rem;
            color: #1e3a8a;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .info-alert i {
            font-size: 1.1rem;
            margin-top: 2px;
        }

        .table-container {
            overflow-x: auto;
        }

        .backup-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .backup-table th {
            background-color: #f1f5f9;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
        }

        .backup-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: middle;
        }

        .backup-table tr:hover td {
            background-color: #f8fafc;
        }

        .mono-text {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: #0f172a;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            cursor: pointer;
        }

        .action-btn.download {
            color: #2563eb;
        }

        .action-btn.download:hover {
            background-color: #eff6ff;
            border-color: #bfdbfe;
        }

        .action-btn.delete {
            color: #dc2626;
        }

        .action-btn.delete:hover {
            background-color: #fef2f2;
            border-color: #fca5a5;
        }

        .action-btn.restore {
            color: #059669;
        }

        .action-btn.restore:hover {
            background-color: #ecfdf5;
            border-color: #a7f3d0;
        }

        .btn-backup-trigger {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: 10px;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .btn-backup-trigger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 12px -1px rgba(37, 99, 235, 0.3);
        }

        .btn-backup-trigger:active {
            transform: translateY(0);
        }

        /* Toggle switch customization */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .3s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2563eb;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2563eb;
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1.5rem;
            border-bottom: 1px dashed #e2e8f0;
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="page-wrapper backup-wrap">
        <div class="content container-fluid">

            {{-- Session Flash Notifications --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert"
                    style="background-color: #d1fae5; color: #065f46;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa fa-check-circle" style="font-size: 18px;"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                        style="filter: invert(1); opacity: 0.6;"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert"
                    style="background-color: #fee2e2; color: #991b1b;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa fa-exclamation-circle" style="font-size: 18px;"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                        style="filter: invert(1); opacity: 0.6;"></button>
                </div>
            @endif

            {{-- Page Header --}}
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h3 class="page-title fw-bold" style="font-size: 1.6rem; color: #0f172a;">Backup & Restore Center</h3>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Configure scheduled daily backups or compile
                        system records locally and externally.</p>
                </div>
                <div class="col-auto">
                    <form action="{{ route('shop.backups.run') }}" method="POST" onsubmit="showProcessingSpinner()">
                        @csrf
                        <button type="submit" class="btn-backup-trigger d-flex align-items-center gap-2" id="btnRunBackup">
                            <i class="fa fa-play"></i>
                            <span>Generate Backup Now</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Main Sections --}}
            <div class="row">
                {{-- Configurations Column --}}
                <div class="col-lg-5">
                    <div class="backup-card">
                        <div class="backup-card-header">
                            <span class="backup-card-title">
                                <i class="fa fa-cog"></i> Backup Policy Settings
                            </span>
                        </div>
                        <div class="backup-card-body">
                            <form action="{{ route('shop.backups.settings') }}" method="POST">
                                @csrf

                                {{-- Schedule switch --}}
                                <div class="setting-item">
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #334155;">Daily Automatic Backup</h6>
                                        <p class="text-muted mb-0" style="font-size: 0.8rem; max-width: 250px;">Run full
                                            database and uploaded asset exports automatically each day.</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" name="auto_backup" value="1" {{ $settings->auto_backup ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>

                                {{-- Retention Policy --}}
                                <div class="form-group mb-4">
                                    <label for="retention_days">Backup Retention Limit (Days)</label>
                                    <input type="number" name="retention_days" id="retention_days" class="form-control"
                                        min="1" max="365" value="{{ $settings->retention_days }}" required>
                                    <small class="text-muted mt-1 d-block">Backups older than this number of days will be
                                        deleted to conserve server space.</small>
                                </div>

                                {{-- External Storage Path --}}
                                <div class="form-group mb-4">
                                    <label for="external_path">Secondary External Backup Folder</label>
                                    <input type="text" name="external_path" id="external_path"
                                        class="form-control mono-text" placeholder="e.g. D:\Backups or /mnt/usb/backups"
                                        value="{{ $settings->external_path }}">
                                    <small class="text-muted mt-1 d-block">Specify a writable absolute path on an external
                                        storage drive, network share, or secondary local directory. Copies are safely
                                        replicated there.</small>
                                </div>

                                <div class="info-alert">
                                    <i class="fa fa-info-circle"></i>
                                    <div>
                                        <strong>Dual-Storage Replication Strategy:</strong> By configuring a valid secondary
                                        folder, the system replicates your backup file across two separate directories on
                                        each run, guarding against local disk failures!
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary w-100 py-2.5 fw-semibold border-0 rounded-3 shadow-sm"
                                    style="background-color: #2563eb;">
                                    <i class="fa fa-save me-1"></i> Save Configuration Policy
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="backup-card">
                        <div class="backup-card-header"
                            style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                            <span class="backup-card-title">
                                <i class="fa fa-upload"></i> Restore from Local File
                            </span>
                        </div>
                        <div class="backup-card-body">
                            <form action="{{ route('shop.backups.restoreFromFile') }}" method="POST"
                                enctype="multipart/form-data" onsubmit="return confirmLocalRestore(event);">
                                @csrf

                                <div class="form-group mb-4">
                                    <label for="backup_file" class="form-label fw-bold">Select Backup ZIP File</label>
                                    <input type="file" name="backup_file" id="backup_file" class="form-control"
                                        accept=".zip" required>
                                    <small class="text-muted mt-1 d-block">Choose a previously generated `.zip` backup file
                                        from your local storage to restore the system database and uploaded assets.</small>
                                </div>

                                <div class="info-alert"
                                    style="background-color: #fffbeb; border-left-color: #d97706; color: #78350f;">
                                    <i class="fa fa-warning me-1"></i>
                                    <div>
                                        <strong>Destructive Action Warning:</strong> Restoring will completely overwrite the
                                        existing database tables and public uploaded files. An automatic safety backup will
                                        be created beforehand.
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn w-100 py-2.5 fw-semibold border-0 rounded-3 shadow-sm text-white"
                                    style="background-color: #d97706;">
                                    <i class="fa fa-upload me-1"></i> Upload & Restore System
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- History / Archive Log Column --}}
                <div class="col-lg-7">
                    <div class="backup-card">
                        <div class="backup-card-header">
                            <span class="backup-card-title">
                                <i class="fa fa-history"></i> Backup Archive Logs
                            </span>
                            @if($settings->last_backup_at)
                                <small class="opacity-75">Last success: {{ $settings->last_backup_at->diffForHumans() }}</small>
                            @endif
                        </div>
                        <div class="backup-card-body p-0">
                            <div class="table-container">
                                <table class="backup-table">
                                    <thead>
                                        <tr>
                                            <th>Log ID</th>
                                            <th>Backup Filename & size</th>
                                            <th>Trigger type</th>
                                            <th>Execution Status</th>
                                            <th>Date & Time</th>
                                            <th style="width: 100px; text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($logs as $log)
                                            <tr>
                                                <td class="mono-text">#{{ $log->id }}</td>
                                                <td>
                                                    <div class="fw-semibold text-truncate"
                                                        style="max-width: 180px; color: #1e293b;" title="{{ $log->filename }}">
                                                        {{ $log->filename }}
                                                    </div>
                                                    <small class="text-muted d-block font-bold">Size: {{ $log->size }}</small>
                                                </td>
                                                <td>
                                                    <span class="status-badge {{ $log->type }}">
                                                        {{ $log->type }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($log->status == 'success')
                                                        <span class="status-badge success">
                                                            <i class="fa fa-check-circle me-1"></i> Success
                                                        </span>
                                                    @else
                                                        <span class="status-badge failed" title="{{ $log->error_message }}"
                                                            style="cursor: help;">
                                                            <i class="fa fa-times-circle me-1"></i> Failed
                                                        </span>
                                                        @if($log->error_message)
                                                            <small class="d-block text-danger text-truncate mt-1"
                                                                style="max-width: 120px;"
                                                                title="{{ $log->error_message }}">{{ $log->error_message }}</small>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <div style="font-size: 0.8rem; color: #475569;">
                                                        {{ $log->created_at->format('M d, Y') }}
                                                    </div>
                                                    <small
                                                        class="text-muted d-block">{{ $log->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        @if($log->status == 'success')
                                                            <a href="{{ route('shop.backups.download', $log->id) }}"
                                                                class="action-btn download" title="Download ZIP Archive">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                            <form action="{{ route('shop.backups.restore', $log->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirmRestore(event, '{{ $log->filename }}');">
                                                                @csrf
                                                                <button type="submit" class="action-btn restore"
                                                                    title="Restore System State">
                                                                    <i class="fa fa-undo"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <form action="{{ route('shop.backups.delete', $log->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to permanently delete this backup log and its stored storage archive file?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="action-btn delete"
                                                                title="Delete Archive">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-muted">
                                                    <i class="fa fa-folder-open d-block mb-2"
                                                        style="font-size: 2.5rem; opacity: 0.4;"></i>
                                                    <span class="fw-semibold">No backup archive records found.</span>
                                                    <p class="mb-0 text-muted mt-1" style="font-size: 0.8rem;">Click "Generate
                                                        Backup Now" at the top right to start your first system compile!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showProcessingSpinner() {
            var btn = document.getElementById('btnRunBackup');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Compiling Backup File...';
        }

        function confirmRestore(event, filename) {
            var msg = "WARNING: Restoring this backup (" + filename + ") will OVERWRITE all current database tables and uploaded media assets.\n\n" +
                "A safety backup of the current state will be created automatically before starting.\n\n" +
                "This action is destructive and cannot be undone. Are you absolutely sure you want to proceed?";
            if (!confirm(msg)) {
                event.preventDefault();
                return false;
            }

            // Show a loading overlay
            var overlay = document.createElement('div');
            overlay.id = 'restore-loading-overlay';
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(15, 23, 42, 0.85)';
            overlay.style.zIndex = '999999';
            overlay.style.display = 'flex';
            overlay.style.flexDirection = 'column';
            overlay.style.justifyContent = 'center';
            overlay.style.alignItems = 'center';
            overlay.style.color = '#ffffff';
            overlay.style.fontFamily = "'Outfit', sans-serif";

            overlay.innerHTML = `
                <div style="text-align: center; max-width: 400px; padding: 2rem; background: #1e293b; border-radius: 18px; border: 1px solid #334155; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.5);">
                    <i class="fa fa-spinner fa-spin" style="font-size: 3rem; color: #10b981; margin-bottom: 1.5rem;"></i>
                    <h4 style="font-weight: 700; margin-bottom: 0.5rem; color: #ffffff;">Restoring System Backup</h4>
                    <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.5; margin-bottom: 0.5rem;">Please do not close this window, refresh the page, or navigate away.</p>
                    <small style="color: #64748b; font-family: monospace;">Processing database & assets...</small>
                </div>
            `;
            document.body.appendChild(overlay);
            return true;
        }

        function confirmLocalRestore(event) {
            var fileInput = document.getElementById('backup_file');
            if (!fileInput || !fileInput.files.length) {
                alert('Please select a backup ZIP file first.');
                event.preventDefault();
                return false;
            }

            var filename = fileInput.files[0].name;
            var msg = "WARNING: Uploading and restoring this backup file (" + filename + ") will OVERWRITE all current database tables and uploaded media assets.\n\n" +
                "A safety backup of the current state will be created automatically before starting.\n\n" +
                "This action is destructive and cannot be undone. Are you absolutely sure you want to proceed?";
            if (!confirm(msg)) {
                event.preventDefault();
                return false;
            }

            // Show a loading overlay
            var overlay = document.createElement('div');
            overlay.id = 'restore-loading-overlay';
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(15, 23, 42, 0.85)';
            overlay.style.zIndex = '999999';
            overlay.style.display = 'flex';
            overlay.style.flexDirection = 'column';
            overlay.style.justifyContent = 'center';
            overlay.style.alignItems = 'center';
            overlay.style.color = '#ffffff';
            overlay.style.fontFamily = "'Outfit', sans-serif";

            overlay.innerHTML = `
                <div style="text-align: center; max-width: 400px; padding: 2rem; background: #1e293b; border-radius: 18px; border: 1px solid #334155; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.5);">
                    <i class="fa fa-spinner fa-spin" style="font-size: 3rem; color: #d97706; margin-bottom: 1.5rem;"></i>
                    <h4 style="font-weight: 700; margin-bottom: 0.5rem; color: #ffffff;">Uploading & Restoring Backup</h4>
                    <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.5; margin-bottom: 0.5rem;">Please wait while the system uploads, unpacks, and restores. Do not close this window, refresh the page, or navigate away.</p>
                    <small style="color: #64748b; font-family: monospace;">Processing local storage & DB...</small>
                </div>
            `;
            document.body.appendChild(overlay);
            return true;
        }
    </script>
@endsection