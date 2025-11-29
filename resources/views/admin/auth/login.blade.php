<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - {{ config('site.full_name', 'Admin Panel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .login-wrapper {
            width: 100%;
            max-width: 480px;
        }
        .login-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e9ecef;
        }
        .login-header {
            background: #ffffff;
            padding: 40px 40px 30px 40px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }
        .logo-container {
            margin-bottom: 20px;
        }
        .logo-container img {
            max-height: 60px;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        .login-header h2 {
            margin: 0;
            font-weight: 700;
            color: #0d6efd;
            font-size: 24px;
            margin-bottom: 8px;
        }
        .login-header p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }
        .login-body {
            padding: 40px;
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-group label {
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
            font-size: 14px;
            display: block;
        }
        .form-control {
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            outline: none;
        }
        .btn-login {
            background: #0d6efd;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-weight: 600;
            width: 100%;
            color: white;
            transition: all 0.3s;
            font-size: 15px;
        }
        .btn-login:hover {
            background: #0b5ed7;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
            color: white;
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .alert {
            border-radius: 8px;
            border: none;
            font-size: 14px;
        }
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 14px;
        }
        .input-icon .form-control {
            padding-left: 45px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .form-check-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }
        .form-check-label {
            color: #495057;
            font-size: 14px;
            cursor: pointer;
        }
        @media (max-width: 576px) {
            .login-header {
                padding: 30px 25px 20px 25px;
            }
            .login-body {
                padding: 30px 25px;
            }
            .logo-container img {
                max-height: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-header">
                <div class="logo-container">
                    <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }} Logo" class="img-fluid">
                </div>
                <h2>Admin Panel</h2>
                <p>Sign in to your account</p>
            </div>
            <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="Enter your email"
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required
                        >
                    </div>
                </div>

                <div class="form-group remember-me">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

