@extends('layouts.admin')

@section('title', '管理者ログイン')

@push('css')
    <style>
        :root {
            --login-bg: #f8fafc;
            --login-card: #ffffff;
            --login-primary: #10b981;
            --login-border: #e2e8f0;
            --login-text: #1e293b;
            --login-secondary: #64748b;
        }

        /* 背景と上下中央配置のベース（Bootstrapのクラスと喧嘩しないように最小限に） */
        .login-page-wrapper {
            background-color: var(--login-bg);
            width: 100%;
        }

        /* ログインカード単体のデザイン */
        .login-card {
            background-color: var(--login-card);
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border: 1px solid var(--login-border);
            position: relative;
            overflow: hidden; /* 内部の要素が角丸からはみ出るのを防ぐ */
        }

        /* 上部のエメラルドグリーンのアクセントライン */
        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--login-primary);
        }

        .login-icon {
            width: 64px;
            height: 64px;
            background-color: #f0fdf4;
            color: var(--login-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            margin: 0 auto 1.5rem;
            font-size: 1.75rem;
        }

        .login-title {
            color: var(--login-text);
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
        }

        .login-subtitle {
            color: var(--login-secondary);
            font-size: 0.875rem;
        }

        .form-label {
            font-weight: 700;
            color: var(--login-text);
            font-size: 0.85rem;
        }

        .form-control {
            background-color: #f8fafc;
            border: 1.5px solid var(--login-border);
            color: var(--login-text);
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--login-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            color: var(--login-text);
        }

        /* ログインボタン（Bootstrapのデフォルトを綺麗に上書き） */
        .btn-login {
            padding: 1rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            border: 2px solid #047857 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            border-radius: 0.75rem;
            font-size: 1.1rem;
            box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.05em;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%) !important;
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(5, 150, 105, 0.4) !important;
        }

        .btn-login:active {
            transform: translateY(0px);
            box-shadow: 0 5px 10px -3px rgba(5, 150, 105, 0.4) !important;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: block;
        }

        .is-invalid {
            border-color: #ef4444 !important;
        }

        .back-to-site a {
            color: var(--login-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: 0.2s;
        }

        .back-to-site a:hover {
            color: var(--primary-color);
        }
    </style>
@endpush

@section("content")
    <div class="login-page-wrapper d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="container">
            <div class="row justify-content-center w-100 m-0">
                <div class="col-12 col-sm-10 col-md-6 col-lg-4" style="max-width: 440px;">
                    
                    <div class="login-card p-4 p-sm-5">
                        <div class="login-header text-center mb-4">
                            <div class="login-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h2 class="login-title mb-2">ADMIN LOGIN</h2>
                            <p class="login-subtitle mb-0">管理者アカウントでログイン</p>
                        </div>

                        <form method="post" action="{{ route("admin.authenticate") }}" class="login-form">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label mb-2">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="admin@example.com" autocomplete="email" autofocus required>
                                @error('email')
                                    <span class="error-message">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label mb-2">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="••••••••" autocomplete="current-password" required>
                                @error('password')
                                    <span class="error-message">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-login w-100 mt-2">
                                <i class="fas fa-sign-in-alt me-2"></i>ログイン
                            </button>
                        </form>

                        <div class="back-to-site text-center mt-4">
                            <a href="{{ route('top.index') }}">
                                <i class="fas fa-arrow-left me-1"></i> サイトに戻る
                            </a>
                        </div>
                    </div> </div>
            </div>
        </div>
    </div>
@endsection