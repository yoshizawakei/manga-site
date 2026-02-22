@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('css')
    <style>
        /* サイトのテーマカラーに合わせたスタイル調整 */
        .contact-container h2 {
            color: var(--primary-color);
            font-weight: 800;
            border-left: 6px solid var(--primary-color);
            padding-left: 1rem;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 700;
            color: var(--text-main) !important;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #f8fafc;
            border: 2px solid var(--border-color);
            color: var(--text-main);
            padding: 0.8rem;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.1);
        }

        .required-badge {
            background-color: #ef4444;
            color: #fff;
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 0.4rem;
            margin-left: 0.5rem;
        }

        .submit-button {
            background-color: var(--primary-color);
            color: #fff !important;
            font-weight: 800;
            padding: 1rem 3rem;
            border-radius: 3rem;
            border: none;
            transition: 0.3s;
        }

        .submit-button:hover {
            background-color: #059669;
            transform: translateY(-2px);
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            {{-- .main-content-container クラスがある場合はそれを適用すると余白が統一されます --}}
            <div class="main-content-container shadow-sm border p-0 bg-white">
                <div class="p-4 p-md-5">
                    {{-- パンくずリスト --}}
                    <nav aria-label="breadcrumb" class="mb-4 small">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('top.index') }}"
                                    class="text-decoration-none">ホーム</a></li>
                            <li class="breadcrumb-item active">お問い合わせ</li>
                        </ol>
                    </nav>

                    <h2 class="h3">お問い合わせ</h2>

                    {{-- 成功メッセージの表示 --}}
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center" 
                            style="background-color: #d1fae5; color: #065f46; border-radius: 1rem;">
                            <i class="fas fa-check-circle me-3 fa-lg"></i>
                            <div class="fw-bold">{{ session('success') }}</div>
                        </div>
                    @endif

                    {{-- バリデーションエラーがあった場合（念のため） --}}
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4" 
                            style="background-color: #fef2f2; color: #991b1b; border-radius: 1rem;">
                            <ul class="mb-0 small fw-bold">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <p class="text-secondary mb-5">
                        当ブログに関するご質問、お仕事のご依頼などは以下のフォームよりお気軽にご連絡ください。<br>
                        通常、2〜3営業日以内に返信させていただきます。
                    </p>

                    {{-- action先は既存の route('top.submitContact') を維持 --}}
                    <form action="{{ route('top.submitContact') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">お名前 <span class="required-badge">必須</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="例：山田 太郎" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">メールアドレス <span class="required-badge">必須</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="example@mail.com"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="form-label">件名</label>
                            {{-- 自由入力の代わりにセレクトボックスにすると、何についての連絡か分かりやすくなります --}}
                            <select id="subject" name="subject" class="form-control form-select">
                                <option value="ご質問・ご相談">ご質問・ご相談</option>
                                <option value="お仕事のご依頼">お仕事のご依頼</option>
                                <option value="その他">その他</option>
                            </select>
                        </div>

                        <div class="mb-5">
                            <label for="message" class="form-label">お問い合わせ内容 <span class="required-badge">必須</span></label>
                            <textarea id="message" name="message" rows="6" class="form-control" placeholder="詳細をご記入ください"
                                required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="submit-button shadow-sm">
                                <i class="fas fa-paper-plane me-2"></i>メッセージを送信する
                            </button>
                            <p class="text-secondary smaller mt-4">
                                ※送信前に<a href="{{ route('top.privacyPolicy') }}" target="_blank">プライバシーポリシー</a>をご確認ください。
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection