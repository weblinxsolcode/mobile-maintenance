<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – Mobile Maintenance</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('common/default.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body {
          
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background blobs */
        body::before, body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .25;
            animation: float 8s ease-in-out infinite;
        }
        /* body::before {
            width: 500px; height: 500px;
            background: #26ACE8;
            top: -100px; left: -100px;
        }
        body::after {
            width: 400px; height: 400px;
            background: #5ae8ff;
            bottom: -100px; right: -100px;
            animation-delay: 4s;
        } */

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(30px, -30px) scale(1.05); }
        }

        .login-card {
              background: linear-gradient(135deg, #025BA0 0%, #0389D1 50%, #025BA0 100%);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 24px;
            padding: 48px 44px;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 10;
            box-shadow: 0 32px 64px rgba(0,0,0,.4);
            animation: slideUp .5s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo .icon-wrap {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, #025BA0, #26ACE8);
            border-radius: 20px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 32px; color: #fff;
            box-shadow: 0 8px 24px rgba(38,172,232,.4);
            margin-bottom: 16px;
        }

        .login-logo h3 { color: #fff; font-weight: 700; font-size: 22px; margin: 0; }
        .login-logo p  { color: rgba(255,255,255,.55); font-size: 14px; margin: 4px 0 0; }

        .form-label {
            color: rgba(255,255,255,.8);
            font-size: 13px; font-weight: 600;
            margin-bottom: 6px;
        }

        .form-control {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 12px;
            color: #fff;
            padding: 12px 16px;
            font-size: 14px;
            transition: all .2s ease;
        }

        .form-control:focus {
            background: rgba(255,255,255,.12);
            border-color: #26ACE8;
            box-shadow: 0 0 0 3px rgba(38,172,232,.2);
            color: #fff;
        }

        .form-control::placeholder { color: rgba(255,255,255,.3); }

        .input-group-text {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            border-right: none;
            color: rgba(255,255,255,.5);
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control { border-left: none; border-radius: 0 12px 12px 0; }

        .btn-login {
            background: linear-gradient(135deg, #025BA0, #26ACE8);
            color: #fff; border: none;
            padding: 13px; font-weight: 700; font-size: 15px;
            border-radius: 12px; width: 100%;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 4px 16px rgba(38,172,232,.4);
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(38,172,232,.5);
        }

        .btn-login:active { transform: translateY(0); }

        .alert {
            border-radius: 12px;
            font-size: 13px;
            padding: 12px 16px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <div class="icon-wrap"><i class="bi bi-shield-lock-fill"></i></div>
            <h3>Admin Portal</h3>
            <p>Mobile Maintenance Management</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mb-3">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.loginCheck') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control"
                           placeholder="admin@example.com" value="{{ old('email') }}" required autocomplete="email">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="passwordField" class="form-control"
                           placeholder="••••••••" required autocomplete="current-password">
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="showPass" onchange="document.getElementById('passwordField').type = this.checked ? 'text' : 'password'">
                    <label class="form-check-label" for="showPass" style="color:rgba(255,255,255,.5); font-size:12px;">Show password</label>
                </div>
            </div>

            <button type="submit" class="btn-login mt-2">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>
        </form>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
