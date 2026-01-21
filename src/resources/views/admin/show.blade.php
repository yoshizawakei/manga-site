@extends('layouts.admin')

@section("css")
    <style>
        /* 管理画面 詳細ページ：ミッドナイト・エメラルド・システム */
        :root {
            --admin-bg: #0f172a;
            --admin-card: #1e293b;
            --admin-primary: #10b981;
            --admin-border: #334155;
            --admin-text: #f1f5f9;
            --admin-secondary: #94a3b8;
        }

        .inquiry-detail-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .detail-card {
            background-color: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            padding: 3rem;
        }

        /* ヘッダー装飾：エメラルドの垂直ライン */
        .detail-card h1 {
            color: var(--admin-primary);
            font-weight: 800;
            border-left: 5px solid var(--admin-primary);
            padding-left: 1.25rem;
            margin-bottom: 3rem;
            letter-spacing: -0.02em;
            font-size: 1.75rem;
        }

        /* 項目ごとのリスト形式スタイリング */
        .detail-group {
            border-bottom: 1px solid rgba(51, 65, 85, 0.5);
            padding: 1.25rem 0;
            display: flex;
            align-items: baseline;
        }

        .detail-label {
            font-weight: 600;
            color: var(--admin-secondary);
            width: 160px;
            flex-shrink: 0;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .detail-value {
            color: var(--admin-text);
            word-break: break-all;
            font-weight: 500;
            font-size: 1rem;
        }

        /* メッセージエリア：ソースコードエディタのような視認性 */
        .message-section {
            margin-top: 2.5rem;
        }

        .message-label {
            color: var(--admin-secondary);
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            display: block;
            text-transform: uppercase;
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

        /* ボタン：落ち着いたエメラルド・アウトライン */
        .btn-back {
            background-color: transparent;
            border: 1px solid var(--admin-secondary);
            color: var(--admin-secondary);
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-back:hover {
            background-color: var(--admin-secondary);
            color: var(--admin-bg);
            border-color: var(--admin-secondary);
        }

        @media (max-width: 576px) {
            .detail-group {
                flex-direction: column;
            }
            .detail-label {
                margin-bottom: 0.5rem;
            }
        }
    </style>
@endsection

@section("content")
    <div class="inquiry-detail-container">
        <div class="detail-card">
            <h1 class="h3">Inquiry Details</h1>

            <div class="detail-body mb-5">
                <div class="detail-group">
                    <span class="detail-label"><i class="fas fa-hashtag me-2"></i>ID</span>
                    <span class="detail-value font-monospace text-primary">{{ $inquiry->id }}</span>
                </div>

                <div class="detail-group">
                    <span class="detail-label"><i class="fas fa-user me-2"></i>氏名</span>
                    <span class="detail-value">{{ $inquiry->name }}</span>
                </div>

                <div class="detail-group">
                    <span class="detail-label"><i class="fas fa-envelope me-2"></i>メール</span>
                    <span class="detail-value">
                        <a href="mailto:{{ $inquiry->email }}" class="text-info text-decoration-none border-bottom border-info border-opacity-50">
                            {{ $inquiry->email }}
                        </a>
                    </span>
                </div>

                <div class="detail-group">
                    <span class="detail-label"><i class="fas fa-bookmark me-2"></i>件名</span>
                    <span class="detail-value fw-bold text-white">{{ $inquiry->subject ?? '（件名なし）' }}</span>
                </div>

                <div class="detail-group">
                    <span class="detail-label"><i class="fas fa-clock me-2"></i>受信日時</span>
                    <span class="detail-value">{{ $inquiry->created_at->format('Y/m/d H:i:s') }}</span>
                </div>
            </div>

            <div class="message-section mb-5">
                <span class="message-label"><i class="fas fa-comment-alt me-2"></i>お問い合わせ内容</span>
                <div class="detail-message shadow-inner">
                    {{ $inquiry->message }}
                </div>
            </div>

            <div class="footer-actions text-start pt-4 border-top border-secondary border-opacity-25">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-back">
                    <i class="fas fa-chevron-left me-2"></i>ダッシュボードに戻る
                </a>
            </div>
        </div>
    </div>
@endsection