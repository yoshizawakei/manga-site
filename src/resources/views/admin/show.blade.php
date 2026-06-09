@extends('layouts.admin')

@section('title', 'お問い合わせ詳細：' . $inquiry->name . '様')

@push('css')
    <style>
        /* クリーン・エメラルド・詳細画面カスタム */
        :root {
            --detail-card: #ffffff;
            --detail-primary: #059669;
            --detail-border: #e2e8f0;
            --detail-text: #1e293b;
            --detail-secondary: #64748b;
        }

        .inquiry-detail-container {
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
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
            /* 薄いエメラルド */
            padding: 2.5rem 2rem;
            border-bottom: 1px solid var(--detail-border);
            text-align: center;
        }

        .detail-card h1 {
            color: var(--detail-text);
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
        }

        .detail-body {
            padding: 3rem;
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
            width: 150px;
            flex-shrink: 0;
            font-size: 0.9rem;
        }

        .detail-value {
            color: var(--detail-text);
            font-weight: 500;
            word-break: break-all;
            /* 長いアドレスのハミ出し対策 */
        }

        .message-section {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
        }

        .message-label {
            color: var(--detail-text);
            font-weight: 800;
            font-size: 1rem;
            margin-bottom: 1.25rem;
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
        }

        .back-link {
            color: var(--detail-secondary);
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
        }

        .back-link:hover {
            color: var(--detail-primary);
        }

        /* 【重要修正】Bootstrap本来の挙動を壊さないカスタムグラデーション返信ボタン */
        .btn-admin-reply {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            font-weight: 800;
            font-size: 1.1rem;
            padding: 1rem 2.5rem;
            border-radius: 3rem;
            border: none;
            box-shadow: 0 6px 15px rgba(5, 150, 105, 0.2);
            transition: all 0.2s ease-in-out;
            text-decoration: none;
        }

        .btn-admin-reply:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
            filter: brightness(1.05);
        }

        .btn-admin-reply:active {
            transform: translateY(1px);
        }

        /* 【重要修正】削除ボタンの衝突を解消 */
        .btn-admin-delete {
            background-color: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
            font-weight: 700;
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-admin-delete:hover {
            background-color: #e11d48;
            color: #ffffff;
            border-color: #e11d48;
        }

        /* レスポンシブ微調整（スマホ閲覧時） */
        @media (max-width: 576px) {
            .detail-body {
                padding: 1.5rem;
            }

            .detail-group {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .detail-label {
                width: 100%;
            }

            .detail-message {
                padding: 1.25rem;
                font-size: 0.95rem;
            }

            .btn-admin-reply {
                width: 100%;
                padding: 1rem 1.5rem;
            }

            .top-action-bar {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .top-action-bar form {
                width: 100%;
            }

            .btn-admin-delete {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush

@section("content")
    <div class="inquiry-detail-container">
        {{-- 【修正】スマホ時に上下にきれいに並ぶようクラスを定義 --}}
        <div class="top-action-bar d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left me-2"></i>ダッシュボードに戻る
            </a>

            <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST"
                onsubmit="return confirm('このお問い合わせを完全に削除してもよろしいですか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-admin-delete">
                    <i class="fas fa-trash-alt me-2"></i>メッセージを削除
                </button>
            </form>
        </div>

        <div class="detail-card">
            <div class="detail-header">
                <h1><i class="fas fa-envelope-open-text me-2 text-success"></i>Inquiry Details</h1>
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
                                <a href="mailto:{{ $inquiry->email }}" class="text-success text-decoration-none fw-bold">
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
                    <span class="message-label"><i class="fas fa-comment-dots me-2 text-success"></i>お問い合わせ内容</span>
                    <div class="detail-message border">
                        {{ $inquiry->message }}
                    </div>
                </div>

                {{-- 返信ボタン --}}
                <div class="mt-5 pt-2 text-center">
                    @php
                        $replySubject = rawurlencode('【KEI BLOG】お問い合わせへのご返信');
                        $replyBody = rawurlencode("\n\n" . str_repeat('-', 20) . "\n" . "▼ 受信したお問い合わせ内容\n" . $inquiry->message);
                    @endphp
                    <a href="mailto:{{ $inquiry->email }}?subject={{ $replySubject }}&body={{ $replyBody }}"
                        class="btn-admin-reply">
                        <i class="fas fa-reply me-2"></i>メールソフトで返信する
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection