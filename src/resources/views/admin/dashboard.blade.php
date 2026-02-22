@extends('layouts.admin')

@section("css")
    <style>
        /* クリーン・エメラルド管理画面カスタム */
        :root {
            --admin-bg: #f1f5f9;
            --admin-card: #ffffff;
            --admin-primary: #059669;
            --admin-border: #cbd5e1;
            --admin-text: #1e293b;
            --admin-secondary: #64748b;
        }

        /* フッター崩れ対策：画面全体の高さを確保して背景色を広げる */
        .dashboard-container {
            padding: 2.5rem 1.5rem;
            background-color: var(--admin-bg);
            /* 画面全体の高さからフッター分（約60-100px）を引いた最小高さを確保 */
            min-height: calc(100vh - 100px);
            display: flex;
            flex-direction: column;
        }

        .dashboard-section {
            margin-bottom: 2.5rem;
            padding: 2rem;
            background-color: var(--admin-card);
            border-radius: 1rem;
            border: 2px solid #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .dashboard-h1 {
            color: var(--admin-text);
            font-weight: 800;
            border-left: 6px solid var(--admin-primary);
            padding-left: 1.5rem;
            margin-bottom: 3rem;
            letter-spacing: -0.02em;
        }

        /* テーブルヘッダー：視認性向上 */
        .dashboard-table thead th {
            background-color: #e2e8f0;
            color: var(--admin-text);
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 1.25rem 1rem;
            border: none;
        }

        .dashboard-table tbody tr {
            transition: 0.2s;
            border-bottom: 1px solid #e2e8f0;
        }

        .dashboard-table tbody tr:hover {
            background-color: #f0fdf4 !important;
        }

        /* ボタン：グラデーションと影で背景から浮かせる */
        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            box-shadow: 0 4px 6px rgba(5, 150, 105, 0.3);
            border: none !important;
            transition: 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(5, 150, 105, 0.4);
        }

        /* アクションボタン（編集・削除・詳細） */
        .btn-action {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            transition: 0.2s;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-edit {
            background-color: #fffbeb;
            color: #d97706;
            border-color: #fde68a;
        }

        .btn-delete {
            background-color: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .btn-view {
            background-color: #f5f3ff;
            color: #4f46e5;
            border-color: #c7d2fe;
        }

        .tag-badge {
            background-color: #f0fdf4;
            color: var(--admin-primary);
            border: 1px solid #d1fae5;
            padding: 0.3rem 0.8rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 700;
        }
    </style>
@endsection {{-- ★ここが抜けていました --}}

@section("content")
    <div class="dashboard-container">
        <h1 class="dashboard-h1 h2">Admin Control Panel</h1>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center" role="alert"
                style="background-color: #d1fae5; color: #065f46;">
                <i class="fas fa-check-circle me-3 fa-lg"></i>
                <div class="fw-bold">{{ session('success') }}</div>
            </div>
        @endif

        {{-- ログ（記事）管理セクション --}}
        <section class="dashboard-section">
            <div class="section-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold"><i class="fas fa-edit me-2 text-primary"></i>Log Management</h2>
                <a href="{{ route('admin.contents.create') }}" class="btn btn-primary px-4 fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-plus me-2"></i>新規ログ作成
                </a>
            </div>

            <div class="table-responsive">
                <table class="table dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>タイトル</th>
                            <th>カテゴリー</th>
                            <th>投稿日</th>
                            <th class="text-end">アクション</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contents as $content)
                            <tr>
                                <td class="text-secondary font-monospace">#{{ $content->id }}</td>
                                <td class="fw-bold">{{ $content->title }}</td>
                                <td>
                                    @foreach($content->tags as $tag)
                                        <span class="tag-badge me-1">#{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-secondary small">{{ $content->created_at->format('Y/m/d') }}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn-action btn-edit"
                                            title="編集">
                                            <i class="fas fa-pen-nib"></i>
                                        </a>
                                        <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="削除"
                                                onclick="return confirm('この記事を削除してもよろしいですか？')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="no-data py-5 text-center text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>まだ記事がありません。
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $contents->links() }}
            </div>
        </section>

        {{-- お問い合わせ管理セクション --}}
        <section class="dashboard-section">
            <div class="section-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold"><i class="fas fa-envelope me-2 text-primary"></i>Inquiries</h2>
                <span class="badge rounded-pill bg-danger px-3">{{ $inquiries->count() }} 件のメッセージ</span>
            </div>
            <div class="table-responsive">
                <table class="table dashboard-table">
                    <thead>
                        <tr>
                            <th>送信者</th>
                            <th>件名</th>
                            <th>受信日時</th>
                            <th class="text-end">確認</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr>
                                <td class="fw-bold">{{ $inquiry->name }}</td>
                                <td class="text-secondary">{{ Str::limit($inquiry->subject, 40) }}</td>
                                <td class="small text-secondary">{{ $inquiry->created_at->format('m/d H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="btn-action btn-view"
                                        title="詳細を表示">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="no-data py-4 text-center text-muted">お問い合わせは届いていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection