@extends('layouts.app') {{-- 共通のappレイアウトを使用 --}}

@section('title', '管理者ログイン')

@section("css")
    <style>
        /* クリーン・エメラルド・ログインカスタム */
        :root {
            --login-bg: #f8fafc;
            --login-card: #ffffff;
            --login-primary: #10b981;
            --login-border: #e2e8f0;
            --login-text: #1e293b;
            --login-secondary: #64748b;
        }

        /* 画面中央配置 */
        .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            width: 100%;
            background-color: var(--login-bg);
        }

        .login-container {
            max-width: 420px;
            width: 100%;
            padding: 3.5rem 2.5rem;
            background-color: var(--login-card);
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border: 1px solid var(--login-border);
            position: relative;
        }

        /* 上部のアクセントライン */
        .login-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--login-primary);
            border-radius: 1.5rem 1.5rem 0 0;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
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
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--login-secondary);
            font-size: 0.875rem;
        }

        /* ラベルと入力欄 */
        .form-label {
            font-weight: 700;
            color: var(--login-text);
            margin-bottom: 0.5rem;
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

        /* ★ログインボタンの劇的改善★ */
        .btn-login {
            display: block;
            width: 100%;
            padding: 1rem;
            margin-top: 2rem;
            /* 背景色をグラデーションにして「押しボタン」感を出す */
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            /* 境界線を少し暗い緑で縁取り、輪郭をはっきりさせる */
            border: 2px solid #047857 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            border-radius: 0.75rem;
            font-size: 1.1rem;
            /* 背景から浮かせるための強い影 */
            box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ホバー時はさらに明るく、浮かび上がるように */
        .btn-login:hover {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%) !important;
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(5, 150, 105, 0.4) !important;
            filter: brightness(1.1);
        }

        /* クリックした瞬間の沈み込み演出 */
        .btn-login:active {
            transform: translateY(0px);
            box-shadow: 0 5px 10px -3px rgba(5, 150, 105, 0.4) !important;
        }

        /* エラーメッセージ */
        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: block;
        }

        .is-invalid {
            border-color: #ef4444 !important;
        }

        .back-to-site {
            text-align: center;
            margin-top: 2rem;
        }

        .back-to-site a {
            color: var(--login-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: 0.2s;
        }

        .back-to-site a:hover {
            color: var(--login-primary);
        }
    </style>
@endsection

@section("content")
    <div class="center-wrapper">
        <div class="login-container">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h2 class="login-title">ADMIN LOGIN</h2>
                <p class="login-subtitle">管理者アカウントでログイン</p>
            </div>

            <form method="post" action="{{ route("admin.authenticate") }}" class="login-form">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="admin@example.com" autocomplete="email" autofocus required>
                    @error('email')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="••••••••" autocomplete="current-password" required>
                    @error('password')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>ログイン
                </button>
            </form>

            <div class="back-to-site">
                <a href="{{ route('top.index') }}">
                    <i class="fas fa-arrow-left me-1"></i> サイトに戻る
                </a>
            </div>
        </div>
    </div>
@endsection