@extends('layouts.admin')

@section("css")
    <style>
        /* ミッドナイト・エメラルド管理画面カスタム */
        :root {
            --admin-bg: #0f172a;
            --admin-card: #1e293b;
            --admin-primary: #10b981;
            --admin-border: #334155;
            --admin-text: #f1f5f9;
            --admin-secondary: #94a3b8;
        }

        .dashboard-container {
            padding: 2rem 1rem;
            background-color: var(--admin-bg);
            min-vh-100;
        }

        /* セクション共通 */
        .dashboard-section {
            margin-bottom: 2.5rem;
            padding: 2rem;
            background-color: var(--admin-card);
            border-radius: 1rem;
            border: 1px solid var(--admin-border);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* タイトル装飾 */
        .dashboard-h1 {
            color: var(--admin-primary);
            font-weight: 800;
            border-left: 5px solid var(--admin-primary);
            padding-left: 1.5rem;
            margin-bottom: 3rem;
            letter-spacing: -0.02em;
        }

        .section-header h2 {
            display: flex;
            align-items: center;
            font-size: 1.25rem;
            color: var(--admin-text);
        }
        .section-header h2::before {
            content: "";
            width: 12px;
            height: 12px;
            background-color: var(--admin-primary);
            border-radius: 50%;
            margin-right: 12px;
        }

        /* テーブルカスタム */
        .dashboard-table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }
        .dashboard-table thead th {
            background-color: rgba(15, 23, 42, 0.5);
            color: var(--admin-secondary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            border: none;
            padding: 1rem;
        }
        .dashboard-table tbody tr {
            background-color: rgba(15, 23, 42, 0.3);
            transition: transform 0.2s;
        }
        .dashboard-table tbody tr:hover {
            background-color: rgba(16, 185, 129, 0.05) !important;
            transform: scale(1.002);
        }
        .dashboard-table td {
            vertical-align: middle;
            border: none;
            padding: 1rem;
            color: var(--admin-text);
        }

        /* タグバッジ：エメラルドテーマ */
        .tag-badge {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--admin-primary);
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 0.2rem 0.6rem;
            border-radius: 2rem;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* ボタンカスタム */
        .btn-primary { background-color: var(--admin-primary); border: none; }
        .btn-primary:hover { background-color: #059669; }
        
        .btn-edit { background-color: #f59e0b; color: #fff; border-radius: 0.5rem; }
        .btn-delete { background-color: #ef4444; color: #fff; border-radius: 0.5rem; }
        .btn-view { background-color: #3b82f6; color: #fff; border-radius: 0.5rem; }

        .no-data { color: var(--admin-secondary); font-style: italic; }
    </style>
@endsection

@section("content")
    <div class="dashboard-container">
        <h1 class="dashboard-h1 h2">Administrator Control Panel</h1>

        {{-- アラート：通知もエメラルドトーンへ --}}
        @if (session('success'))
            <div class="alert alert-success bg-opacity-10 bg-success border-success text-success border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- コンテンツ一覧 --}}
        <section class="dashboard-section">
            <div class="section-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Review Management</h2>
                <a href="{{ route('admin.contents.create') }}" class="btn btn-primary px-4 fw-bold rounded-pill">
                    <i class="fas fa-plus-circle me-2"></i>新規追加
                </a>
            </div>

            <div class="table-responsive">
                <table class="table dashboard-table text-white">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>作品タイトル</th>
                            <th>要約</th>
                            <th>タグ</th>
                            <th>登録日</th>
                            <th class="text-end">アクション</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contents as $content)
                            <tr>
                                <td class="text-secondary font-monospace">{{ $content->id }}</td>
                                <td class="fw-bold">{{ $content->title }}</td>
                                <td class="text-secondary smaller">{{ Str::limit($content->description, 40) }}</td>
                                <td>
                                    @foreach($content->tags as $tag)
                                        <span class="tag-badge">#{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td class="smaller">{{ $content->created_at->format('Y/m/d') }}</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn btn-sm btn-edit px-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete px-3 ms-2" onclick="return confirm('本当に削除しますか？')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-data py-5">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>データが登録されていません。
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $contents->links('pagination::bootstrap-4') }}
            </div>
        </section>

        {{-- お問い合わせ --}}
        <section class="dashboard-section border-top border-primary border-4">
            <div class="section-header d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Inquiries</h2>
                <span class="badge rounded-pill bg-primary px-3">{{ $inquiries_count ?? 0 }} 未対応</span>
            </div>
            <div class="table-responsive">
                <table class="table dashboard-table text-white">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>送信者</th>
                            <th>メール</th>
                            <th>件名</th>
                            <th>受信日</th>
                            <th class="text-end">詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr>
                                <td class="text-secondary font-monospace">{{ $inquiry->id }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td class="smaller text-secondary">{{ $inquiry->email }}</td>
                                <td>{{ Str::limit($inquiry->subject, 30) }}</td>
                                <td class="smaller">{{ $inquiry->created_at->format('m/d H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="btn btn-sm btn-view px-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-data py-5">お問い合わせはありません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection