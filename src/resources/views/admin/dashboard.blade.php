@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <style>
        /* 管理画面用のダークテーマ補助スタイル */
        .dashboard-container {
            padding: 1rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .dashboard-section {
            margin-bottom: 3rem;
            padding: 2rem;
            background-color: var(--card-background);
            /* common.cssの変数を使用 */
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }

        .dashboard-h1 {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        .dashboard-table th {
            background-color: #2a2a2a;
            /* ヘッダーを強調 */
            color: var(--secondary-color);
            border-bottom: 2px solid var(--primary-color);
        }

        .dashboard-table td {
            color: var(--text-color);
        }

        .dashboard-table tr:hover {
            background-color: #242424;
        }

        .tag-badge {
            background-color: var(--secondary-color);
            color: #121212;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.8rem;
            margin-right: 0.25rem;
            display: inline-block;
            margin-top: 0.2rem;
        }

        .no-data {
            color: #888;
            text-align: center;
            padding: 2rem !important;
        }

        /* ボタンの色の調整（Bootstrapの色を使用） */
        .btn-edit {
            background-color: #FFC107;
            /* warning */
            color: #000;
        }

        .btn-delete {
            background-color: #DC3545;
            /* danger */
            color: #fff;
        }

        .btn-view {
            background-color: #0DCAF0;
            /* info */
            color: #000;
        }
    </style>
@endsection

@section("content")
    <div class="dashboard-container">
        <h1 class="dashboard-h1 display-4">管理者ダッシュボード</h1>

        {{-- アラートメッセージ --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- 登録コンテンツ一覧セクション --}}
        <section class="dashboard-section shadow-lg">
            <div class="section-header">
                <h2 class="fs-4 fw-bold text-white">登録コンテンツ一覧</h2>
                {{-- コンテンツ作成ルート名を admin.contents.create に変更 --}}
                <a href="{{ route('admin.contents.create') }}" class="btn btn-primary fw-bold">
                    <i class="fas fa-plus-circle me-1"></i>コンテンツを追加
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-hover dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>タイトル</th>
                            <th>説明</th>
                            <th>タグ</th>
                            <th>作成日</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contents as $content)
                            <tr>
                                <td>{{ $content->id }}</td>
                                <td>{{ $content->title }}</td>
                                <td>{{ Str::limit($content->description, 50) }}</td>
                                <td>
                                    {{-- タグをループして表示 --}}
                                    @foreach($content->tags as $tag)
                                        <span class="tag-badge">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $content->created_at->format('Y/m/d') }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('admin.contents.edit', ['content' => $content->id]) }}"
                                        class="btn btn-sm btn-edit me-2">編集</a>
                                    <form action="{{ route('admin.contents.destroy', ['content' => $content->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('本当にID: {{ $content->id }} のコンテンツ「{{ $content->title }}」を削除しますか？');"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-data">まだコンテンツが登録されていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ページネーションリンクの追加 --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $contents->links('pagination::bootstrap-4') }}
            </div>
        </section>

        {{-- お問い合わせ内容セクション --}}
        <section class="dashboard-section shadow-lg">
            <div class="section-header">
                <h2 class="fs-4 fw-bold text-white">お問い合わせ</h2>
                <span class="badge text-bg-info fs-6 py-2 px-3 fw-bold">{{ $inquiries_count ?? 0 }}件の未読</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover dashboard-table inquiries-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>氏名</th>
                            <th>メールアドレス</th>
                            <th>件名</th>
                            <th>受信日</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->id }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ Str::limit($inquiry->subject, 50) }}</td>
                                <td>{{ $inquiry->created_at->format('Y/m/d') }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('admin.inquiries.show', ['inquiry' => $inquiry->id]) }}"
                                        class="btn btn-sm btn-view">詳細</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-data">まだ新しいお問い合わせはありません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <a href="{{ route("admin.contents.create") }}" class="d-none"></a>
    </div>
@endsection