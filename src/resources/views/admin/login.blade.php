@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
    <style>
        /* 管理者ログインページ用のダークテーマ補助スタイル */
        /* 🚨 修正: body への Flexbox スタイルを削除 */
        /* body {
                min-height: 100vh;
                margin: 0;
                background-color: var(--background-color) !important;
            } */

        /* ログインコンテンツ全体を画面の中央に配置するためのラッパー */
        .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            /* 親要素 (main) の高さを利用して中央寄せ */
            min-height: 100vh;
            width: 100%;
            /* ヘッダーやフッターの分だけ調整したい場合は min-height: calc(100vh - header_height - footer_height); */
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 2.5rem;
            background-color: var(--card-background);
            /* common.cssのカード背景を使用 */
            border-radius: 1rem;
            box-shadow: var(--shadow-heavy);
            /* 強い影で浮き立たせる */
            border: 1px solid var(--border-color);
        }

        .login-title {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: bold;
            font-size: 1.8rem;
        }

        .form-label {
            font-weight: bold;
            color: var(--secondary-color);
            /* シアンの強調色 */
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #242424;
            /* 入力フィールドの背景を少し濃く */
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: #242424;
            border-color: var(--primary-color);
            /* フォーカス時に紫 */
            box-shadow: 0 0 0 0.25rem rgba(187, 134, 252, 0.25);
        }

        .btn-primary {
            /* Bootstrapのbtn-primaryをカスタムテーマに合わせる */
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin-top: 1.5rem;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #A064FF;
            /* 少し明るい紫 */
            border-color: #A064FF;
            transform: translateY(-2px);
        }

        .error-message {
            color: #DC3545;
            /* BootstrapのDanger (赤) */
            font-size: 0.875em;
            display: block;
            margin-top: 0.25rem;
        }
    </style>
@endsection

@section("content")
    <div class="center-wrapper">
        <div class="login-container">
            <h2 class="login-title">管理者ログイン</h2>
            <form method="post" action="{{ route("admin.authenticate") }}" class="login-form needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" autocomplete="email" autofocus required>
                    @error('email')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">パスワード</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="current-password" required>
                    @error('password')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>管理者ログインする
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection