@extends('layouts.admin')

{{--
親レイアウトの受け口が @stack('css') になっているため、
@push('css') に変更してスタイルを正常に届けます。
--}}
@push('css')
    <style>
        /* クリーン・エメラルド管理画面カスタム */
        :root {
            --admin-card: #ffffff;
            --admin-primary: #059669;
            --admin-border: #cbd5e1;
            --admin-text: #1e293b;
            --admin-secondary: #64748b;
        }

        /* 【修正】親レイアウトの main タグと喧嘩しないよう、
              無駄なフレックス設定や無理な高さを排除しました。
            */
        .dashboard-container {
            width: 100%;
        }

        .dashboard-section {
            margin-bottom: 2.5rem;
            padding: 2rem;
            background-color: var(--admin-card);
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .dashboard-h1 {
            color: var(--admin-text);
            font-weight: 800;
            border-left: 6px solid var(--admin-primary);
            padding-left: 1.25rem;
            margin-bottom: 2.5rem;
            letter-spacing: -0.02em;
        }

        /* テーブルヘッダー：視認性向上 */
        .dashboard-table thead th {
            background-color: #f1f5f9;
            color: var(--admin-text);
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 1rem;
            border: none;
        }

        .dashboard-table tbody tr {
            transition: 0.2s;
            border-bottom: 1px solid #f1f5f9;
        }

        .dashboard-table tbody tr:hover {
            background-color: #f0fdf4 !important;
        }

        /* カスタムボタン：Bootstrapのデフォルトと競合しない固有の名前へ変更 */
        .btn-admin-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2);
            border: none;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
        }

        .btn-admin-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(5, 150, 105, 0.3);
            filter: brightness(1.05);
        }

        /* アクションボタン（編集・削除・詳細） */
        .btn-action {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            transition: 0.2s;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            text-decoration: none;
        }

        .btn-edit {
            background-color: #fffbeb;
            color: #d97706;
            border-color: #fde68a;
        }

        .btn-edit:hover {
            background-color: #fef3c7;
        }

        .btn-delete {
            background-color: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .btn-delete:hover {
            background-color: #fee2e2;
        }

        .btn-view {
            background-color: #f5f3ff;
            color: #4f46e5;
            border-color: #c7d2fe;
        }

        .btn-view:hover {
            background-color: #ede9fe;
        }

        .tag-badge {
            background-color: #f0fdf4;
            color: var(--admin-primary);
            border: 1px solid #d1fae5;
            padding: 0.25rem 0.6rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* ステータスバッジのスタイル */
        .status-badge {
            padding: 0.25rem 0.6rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-block;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-draft {
            background-color: #e2e8f0;
            color: #475569;
        }

        /* スマホ用スタイル微調整 */
        @media (max-width: 576px) {
            .dashboard-section {
                padding: 1.25rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .section-header a,
            .section-header span {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush

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
                <h2 class="h4 fw-bold mb-0"><i class="fas fa-edit me-2 text-success"></i>Log Management</h2>
                <a href="{{ route('admin.contents.create') }}" class="btn btn-admin-primary px-4 fw-bold rounded-pill">
                    <i class="fas fa-plus me-2"></i>新規ログ作成
                </a>
            </div>

            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>タイトル</th>
                            <th>ステータス</th>
                            <th>カテゴリー</th>
                            <th>投稿日</th>
                            <th class="text-end">アクション</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contents as $content)
                            <tr>
                                <td class="text-secondary font-monospace">#{{ $content->id }}</td>
                                <td class="fw-bold text-wrap" style="min-width: 200px;">{{ $content->title }}</td>
                                <td>
                                    @if($content->status === 'published')
                                        <span class="status-badge status-published">公開中</span>
                                    @else
                                        <span class="status-badge status-draft">下書き</span>
                                    @endif
                                </td>
                                <td>
                                    @forelse($content->tags as $tag)
                                        <span class="tag-badge me-1">#{{ $tag->name }}</span>
                                    @empty
                                        <span class="text-muted small">-</span>
                                    @endforelse
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
                                <td colspan="6" class="no-data py-5 text-center text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>まだ記事がありません。
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($contents->hasPages())
                <div class="mt-4">
                    {{ $contents->links() }}
                </div>
            @endif
        </section>

        {{-- お問い合わせ管理セクション --}}
        <section class="dashboard-section">
            <div class="section-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 fw-bold mb-0"><i class="fas fa-envelope me-2 text-success"></i>Inquiries</h2>
                <span class="badge rounded-pill bg-danger px-3 py-2">{{ $inquiries->count() }} 件のメッセージ</span>
            </div>
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
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
                                <td class="text-secondary text-wrap" style="min-width: 200px;">
                                    {{ Str::limit($inquiry->subject, 40) }}</td>
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