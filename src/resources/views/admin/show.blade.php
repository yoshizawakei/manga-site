@extends('layouts.app')

@section('title', 'お問い合わせ詳細：' . $inquiry->name . '様')

@section("css")
    <style>
        :root {
            --detail-bg: #f8fafc;
            --detail-card: #ffffff;
            --detail-primary: #059669;
            /* より濃いグリーンに変更 */
            --detail-border: #e2e8f0;
            --detail-text: #1e293b;
            --detail-secondary: #64748b;
        }

        .inquiry-detail-container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 0 1rem;
        }

        .detail-card {
            background-color: var(--detail-card);
            border: 1px solid var(--detail-border);
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .detail-header {
            background-color: #f0fdf4;
            padding: 2.5rem;
            border-bottom: 1px solid var(--detail-border);
            text-align: center;
        }

        .detail-card h1 {
            color: var(--detail-text);
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .detail-body {
            padding: 3rem;
            text-align: left;
        }

        .detail-group {
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 0;
            display: flex;
            align-items: center;
        }

        .detail-group:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 700;
            color: var(--detail-secondary);
            width: 140px;
            flex-shrink: 0;
            font-size: 0.85rem;
        }

        .detail-value {
            color: var(--detail-text);
            font-weight: 500;
        }

        .message-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
        }

        .message-label {
            color: var(--detail-text);
            font-weight: 800;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .detail-message {
            background-color: #f8fafc;
            border: 1px solid var(--detail-border);
            padding: 2rem;
            border-radius: 1rem;
            white-space: pre-wrap;
            color: var(--detail-text);
            line-height: 1.8;
            font-size: 1.05rem;
            text-align: left;
        }

        .btn-back {
            color: var(--detail-secondary);
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
        }

        .btn-back:hover {
            color: var(--detail-primary);
        }

        /* ★返信ボタン：視認性大幅アップ★ */
        .btn-reply-action {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            font-size: 1.1rem !important;
            padding: 1.25rem 3rem !important;
            border-radius: 3rem !important;
            border: none !important;
            box-shadow: 0 10px 20px rgba(5, 150, 105, 0.2) !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
        }

        .btn-reply-action:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 15px 25px rgba(5, 150, 105, 0.3) !important;
            filter: brightness(1.1);
        }

        .btn-reply-action:active {
            transform: translateY(-1px) !important;
        }

        /* 削除ボタン */
        .btn-delete-custom {
            background-color: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
            font-weight: 700;
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            transition: 0.3s;
        }

        .btn-delete-custom:hover {
            background-color: #e11d48;
            color: #ffffff;
        }

        @media (max-width: 576px) {
            .detail-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .detail-label {
                margin-bottom: 0.25rem;
            }
        }
    </style>
@endsection

@section("content")
    <div class="inquiry-detail-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>ダッシュボードに戻る
            </a>

            <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST"
                onsubmit="return confirm('このお問い合わせを完全に削除してもよろしいですか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete-custom shadow-sm">
                    <i class="fas fa-trash-alt me-2"></i>メッセージを削除
                </button>
            </form>
        </div>

        <div class="detail-card">
            <div class="detail-header">
                <h1><i class="fas fa-envelope-open-text me-2 text-primary"></i>Inquiry Details</h1>
                <p class="text-secondary small mb-0">受信したメッセージの詳細を確認できます</p>
            </div>

            <div class="detail-body">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="detail-group">
                            <span class="detail-label">送信者</span>
                            <span class="detail-value fw-bold">{{ $inquiry->name }} 様</span>
                        </div>

                        <div class="detail-group">
                            <span class="detail-label">メールアドレス</span>
                            <span class="detail-value">
                                <a href="mailto:{{ $inquiry->email }}" class="text-primary text-decoration-none fw-bold">
                                    {{ $inquiry->email }} <i class="fas fa-external-link-alt ms-1 small"></i>
                                </a>
                            </span>
                        </div>

                        <div class="detail-group">
                            <span class="detail-label">件名</span>
                            <span class="detail-value fw-bold">{{ $inquiry->subject ?? '（件名なし）' }}</span>
                        </div>

                        <div class="detail-group">
                            <span class="detail-label">受信日時</span>
                            <span
                                class="detail-value text-secondary">{{ $inquiry->created_at->format('Y年m月d日 H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="message-section">
                    <span class="message-label"><i class="fas fa-comment-dots me-2 text-primary"></i>お問い合わせ内容</span>
                    <div class="detail-message shadow-sm">
                        {{ $inquiry->message }}
                    </div>
                </div>

                {{-- ★返信ボタン：デザイン変更箇所★ --}}
                <div class="mt-5 pt-4 text-center">
                    <a href="mailto:{{ $inquiry->email }}" class="btn-reply-action shadow">
                        <i class="fas fa-reply me-2"></i>メールソフトで返信する
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection