@extends('layouts.admin')

@section("css")
    <style>
        /* 管理画面 詳細ページ：ミッドナイト・エメラルド・カスタム */
        :root {
            --admin-bg: #0f172a;
            --admin-card: #1e293b;
            --admin-primary: #10b981;
            --admin-border: #334155;
            --admin-text: #f1f5f9;
            --admin-secondary: #94a3b8;
        }

        .inquiry-show-container {
            padding: 2rem 1rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .detail-card {
            background-color: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 3rem;
        }

        /* ヘッダー装飾 */
        .detail-card h1 {
            color: var(--admin-primary);
            font-weight: 800;
            border-left: 5px solid var(--admin-primary);
            padding-left: 1.25rem;
            margin-bottom: 3rem;
            letter-spacing: -0.02em;
        }

        /* ラベルと値のスタイリング */
        .detail-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(51, 65, 85, 0.5);
        }

        .detail-label {
            font-weight: 600;
            color: var(--admin-secondary);
            width: 160px;
            flex-shrink: 0;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .detail-value {
            color: var(--admin-text);
            word-break: break-all;
            font-weight: 500;
        }

        /* メッセージエリア：エディタ風の落ち着いたデザイン */
        .message-label {
            color: var(--admin-secondary);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .detail-message {
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--admin-border);
            padding: 1.5rem;
            border-radius: 0.75rem;
            white-space: pre-wrap;
            color: var(--admin-text);
            line-height: 1.8;
            font-family: 'Inter', 'Noto Sans JP', sans-serif;
        }

        /* ボタン：エメラルドテーマに合わせた青（infoの代わり） */
        .btn-back {
            background-color: transparent;
            border: 1px solid var(--admin-secondary);
            color: var(--admin-secondary);
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background-color: var(--admin-secondary);
            color: var(--admin-bg);
        }
    </style>
@endsection

@section("content")
    <div class="inquiry-show-container">
        <div class="detail-card">
            <h1 class="h3">Inquiry Details</h1>

            <div class="detail-list mb-5">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-fingerprint me-2"></i>ID</span>
                    <span class="detail-value font-monospace text-primary">{{ $inquiry->id }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user me-2"></i>氏名</span>
                    <span class="detail-value">{{ $inquiry->name }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-envelope me-2"></i>メール</span>
                    <span class="detail-value">
                        <a href="mailto:{{ $inquiry->email }}" class="text-info text-decoration-underline">{{ $inquiry->email }}</a>
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-tag me-2"></i>件名</span>
                    <span class="detail-value fw-bold">{{ $inquiry->subject ?? '（件名なし）' }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-calendar-alt me-2"></i>受信日時</span>
                    <span class="detail-value">{{ $inquiry->created_at->format('Y/m/d H:i:s') }}</span>
                </div>
            </div>

            <div class="mb-5">
                <div class="message-label"><i class="fas fa-comment-alt me-2"></i>お問い合わせ内容</div>
                <div class="detail-message shadow-inner">
                    {{ $inquiry->message }}
                </div>
            </div>

            <div class="back-button-container text-start pt-4 border-top border-secondary">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-back">
                    <i class="fas fa-chevron-left me-2"></i>ダッシュボードに戻る
                </a>
            </div>
        </div>
    </div>
@endsection