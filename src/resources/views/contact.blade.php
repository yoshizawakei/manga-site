@extends('layouts.app')

@section('title', ' | お問い合わせ')

@section('css')
<style>
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
    {{-- col-md-10 などの指定で、コンテナが広がりすぎるのを防ぎつつ中央寄せ --}}
    <div class="col-12 col-lg-10 col-xl-8">
        <div class="contact-container shadow-sm border">
            {{-- 内側にパディング専用のラッパーを追加 --}}
            <div class="p-4 p-md-5">
                <nav aria-label="breadcrumb" class="mb-4 small">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('top.index') }}" class="text-decoration-none">ホーム</a></li>
                        <li class="breadcrumb-item active">お問い合わせ</li>
                    </ol>
                </nav>

                <h2 class="h3">お問い合わせ</h2>
                <p class="text-secondary mb-5">ご意見・ご要望は以下のフォームよりお気軽にご連絡ください。</p>

                <form action="{{ route('top.submitContact') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">お名前 <span class="required-badge">必須</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="例：山田 太郎" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">メールアドレス <span class="required-badge">必須</span></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="example@domain.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="form-label">件名</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="お問い合わせの件名">
                    </div>

                    <div class="mb-5">
                        <label for="message" class="form-label">お問い合わせ内容 <span class="required-badge">必須</span></label>
                        <textarea id="message" name="message" rows="6" class="form-control" placeholder="詳細をご記入ください" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="submit-button shadow-sm">
                            <i class="fas fa-paper-plane me-2"></i>メッセージを送信する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection