@extends('layouts.admin')

@section("css")
    <style>
        /* 管理画面ログイン：ミッドナイト・エメラルド・カスタム */
        :root {
            --admin-bg: #0f172a;
            --admin-card: #1e293b;
            --admin-primary: #10b981;
            --admin-border: #334155;
            --admin-text: #f1f5f9;
            --admin-secondary: #94a3b8;
        }

        /* 画面中央配置 */
        .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh; /* ヘッダー・フッターを考慮して少し調整 */
            width: 100%;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 3rem;
            background-color: var(--admin-card);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--admin-border);
            position: relative;
            overflow: hidden;
        }

        /* 装飾用のエメラルドライン */
        .login-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--admin-primary), transparent);
        }

        .login-title {
            color: var(--admin-primary);
            font-weight: 800;
            margin-bottom: 2.5rem;
            text-align: center;
            font-size: 1.75rem;
            letter-spacing: -0.02em;
        }

        /* ラベルと入力欄 */
        .form-label {
            font-weight: 600;
            color: var(--admin-secondary);
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            background-color: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--admin-border);
            color: var(--admin-text);
            padding: 0.8rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: rgba(15, 23, 42, 0.8);
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.15);
            color: var(--admin-text);
        }

        /* ログインボタン：エメラルド・ソリッド */
        .btn-login {
            display: block;
            width: 100%;
            padding: 1rem;
            margin-top: 2rem;
            background-color: var(--admin-primary);
            border: none;
            color: #fff;
            font-weight: 800;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .btn-login:hover {
            background-color: #059669;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        /* エラーメッセージ */
        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .is-invalid {
            border-color: #ef4444 !important;
        }
    </style>
@endsection

@section("content")
    <div class="center-wrapper">
        <div class="login-container">
            <h2 class="login-title">ADMIN LOGIN</h2>
            
            <form method="post" action="{{ route("admin.authenticate") }}" class="login-form needs-validation" novalidate>
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="admin@example.com" autocomplete="email" autofocus required>
                    @error('email')
                        <span class="error-message" role="alert">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="••••••••" autocomplete="current-password" required>
                    @error('password')
                        <span class="error-message" role="alert">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn-login shadow-lg">
                    <i class="fas fa-shield-alt me-2"></i>Secure Login
                </button>
            </form>
        </div>
    </div>
@endsection