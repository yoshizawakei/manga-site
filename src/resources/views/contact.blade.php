@extends('layouts.app')

@section('title', 'CONTACT')

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row justify-content-center">
            {{-- コンテンツ幅を読みやすく調整 --}}
            <div class="col-lg-8">
                <header class="mb-5">
                    <h1 class="fw-black mb-3"
                        style="font-size: 2.0rem; letter-spacing: 0.01em; text-transform: uppercase; color: #111;">
                        CONTACT
                    </h1>
                    <p class="text-secondary small" style="letter-spacing: 0.1em;">
                        お問い合わせ
                    </p>
                </header>

                {{-- 成功メッセージ --}}
                @if (session('success'))
                    <div class="alert alert-dark border-0 mb-5 p-4 rounded-0 d-flex align-items-center"
                        style="background-color: #111; color: #fff;">
                        <i class="fas fa-check-circle me-3"></i>
                        <div class="fw-bold small">{{ session('success') }}</div>
                    </div>
                @endif

                {{-- エラーメッセージ --}}
                @if ($errors->any())
                    <div class="alert alert-light border mb-5 p-4 rounded-0" style="color: #d00;">
                        <ul class="mb-0 small fw-bold list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-5">
                    <p class="text-secondary" style="font-size: 0.95rem; line-height: 1.8;">
                        当ブログに関するご質問、お仕事のご依頼などは以下のフォームよりお気軽にご連絡ください。<br>
                        通常、2〜3営業日以内に返信させていただきます。
                    </p>
                </div>

                <form action="{{ route('top.submitContact') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label small fw-bold text-uppercase"
                            style="letter-spacing: 0.1em;">Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control custom-input" placeholder="例：山田 太郎"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label small fw-bold text-uppercase"
                            style="letter-spacing: 0.1em;">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="form-control custom-input"
                            placeholder="example@mail.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="form-label small fw-bold text-uppercase"
                            style="letter-spacing: 0.1em;">Subject</label>
                        <select id="subject" name="subject" class="form-control form-select custom-input">
                            <option value="ご質問・ご相談">ご質問・ご相談</option>
                            <option value="お仕事のご依頼">お仕事のご依頼</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="message" class="form-label small fw-bold text-uppercase"
                            style="letter-spacing: 0.1em;">Message <span class="text-danger">*</span></label>
                        <textarea id="message" name="message" rows="8" class="form-control custom-input"
                            placeholder="詳細をご記入ください" required></textarea>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn-submit">
                            SEND MESSAGE →
                        </button>
                        <p class="text-secondary mt-4" style="font-size: 0.75rem;">
                            ※送信前に<a href="{{ route('top.privacyPolicy') }}" target="_blank"
                                class="text-dark fw-bold">プライバシーポリシー</a>をご確認ください。
                        </p>
                    </div>
                </form>

                <div class="mt-5 pt-5 text-center">
                    <a href="{{ route('top.index') }}" class="sidebar-link">BACK TO TOP →</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .fw-black {
            font-weight: 900 !important;
        }

        /* 入力フォーム：ABOUT ME等と同じ直線的なデザイン */
        .custom-input {
            border: 1px solid #ddd;
            border-radius: 0;
            /* 丸みを消す */
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            background-color: #fff;
            transition: border-color 0.2s;
        }

        .custom-input:focus {
            border-color: #111;
            box-shadow: none;
            /* 青い光を消す */
            background-color: #fff;
        }

        /* 送信ボタン：モノトーンかつ力強いデザイン */
        .btn-submit {
            background-color: #111;
            color: #fff;
            font-weight: 900;
            font-size: 0.9rem;
            letter-spacing: 0.2em;
            padding: 1.2rem 4rem;
            border: none;
            border-radius: 2px;
            transition: opacity 0.2s;
        }

        .btn-submit:hover {
            opacity: 0.8;
            color: #fff;
        }

        /* 共通リンクスタイル（他ページと同期） */
        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111;
            text-decoration: none;
            border-bottom: 1px solid #111;
            padding-bottom: 2px;
            display: inline-block;
        }

        /* プレースホルダーの色 */
        ::placeholder {
            color: #ccc !important;
            font-size: 0.85rem;
        }
    </style>
@endsection