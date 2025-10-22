@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/detail.css') }}">
    <style>
        /* 管理画面 詳細ページ用のダークテーマ補助スタイル */
        .inquiry-show-container {
            padding: 1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .detail-card {
            background-color: var(--card-background);
            /* common.cssの変数を使用 */
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            padding: 2rem;
        }

        .detail-card h1 {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        .detail-label {
            font-weight: bold;
            color: var(--secondary-color);
            /* シアンの強調色 */
            margin-right: 1rem;
            min-width: 120px;
            display: inline-block;
        }

        .detail-value {
            color: var(--text-color);
            word-break: break-all;
        }

        .detail-message {
            background-color: #242424;
            /* メッセージエリアの背景を少し濃く */
            border: 1px solid var(--border-color);
            padding: 1rem;
            border-radius: 0.25rem;
            white-space: pre-wrap;
            /* 改行を保持 */
            color: var(--text-color);
        }
    </style>
@endsection

@section("content")
    <div class="inquiry-show-container">
        <div class="detail-card">
            <h1 class="fs-3">お問い合わせ詳細</h1>

            <div class="row mb-3">
                <div class="col-12">
                    <span class="detail-label">ID:</span>
                    <span class="detail-value">{{ $inquiry->id }}</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <span class="detail-label">氏名:</span>
                    <span class="detail-value">{{ $inquiry->name }}</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <span class="detail-label">メールアドレス:</span>
                    <span class="detail-value">{{ $inquiry->email }}</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <span class="detail-label">件名:</span>
                    <span class="detail-value">{{ $inquiry->subject ?? '件名なし' }}</span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <span class="detail-label d-block mb-2">お問い合わせ内容:</span>
                    <div class="detail-message">
                        {{ $inquiry->message }}
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <span class="detail-label">受信日時:</span>
                    <span class="detail-value">{{ $inquiry->created_at->format('Y/m/d H:i') }}</span>
                </div>
            </div>

            <div class="back-button-container text-end pt-3 border-top border-secondary">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-info fw-bold">
                    <i class="fas fa-arrow-left me-2"></i>ダッシュボードに戻る
                </a>
            </div>
        </div>
    </div>
@endsection