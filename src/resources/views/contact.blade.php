@extends('layouts.admin')
{{-- NOTE: ユーザー向けのお問い合わせフォームであるため、通常はメインサイトのレイアウト(例: layouts.app)を継承しますが、デザイン統一のためBootstrapを適用します。 --}}

@section("css")
    <style>
        /* お問い合わせフォーム用スタイル */
        .main-content-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 2rem 1rem;
            background-color: var(--card-background);
            /* カード背景色を使用 */
            border-radius: 0.5rem;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
        }

        .main-content-container h2 {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        .main-content-container p {
            color: var(--text-color);
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: bold;
            color: var(--secondary-color);
            /* シアンの強調色 */
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #242424;
            /* 入力フィールドの背景を濃く */
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: #242424;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(187, 134, 252, 0.25);
        }

        .required {
            color: #DC3545;
            /* 赤色で必須を強調 */
            font-size: 0.8rem;
            margin-left: 0.25rem;
        }

        .submit-button {
            /* Bootstrapのbtn-primaryをカスタムテーマに合わせる */
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
            padding: 0.75rem 2rem;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: background-color 0.3s, border-color 0.3s;
            margin-top: 1rem;
            display: inline-block;
            border: none;
        }

        .submit-button:hover {
            background-color: #A064FF;
            border-color: #A064FF;
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
    <div class="main-content-container">
        <h2>お問い合わせ</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <p>当サイトに関するご質問、ご意見、ご要望は、下記のフォームよりお気軽にご連絡ください。</p>

        <form action="{{ route("top.submitContact") }}" method="POST" class="contact-form p-4">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">お名前<span class="required">（必須）</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス<span class="required">（必須）</span></label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">件名</label>
                <input type="text" id="subject" name="subject" class="form-control @error('subject') is-invalid @enderror"
                    value="{{ old('subject') }}">
                @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="form-label">お問い合わせ内容<span class="required">（必須）</span></label>
                <textarea id="message" name="message" rows="8" class="form-control @error('message') is-invalid @enderror"
                    required>{{ old('message') }}</textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="submit-button btn-lg">
                <i class="fas fa-paper-plane me-2"></i>送信する
            </button>
        </form>
    </div>
@endsection