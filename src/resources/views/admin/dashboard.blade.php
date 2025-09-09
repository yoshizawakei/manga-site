@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section("content")
    <div class="dashboard-container">
        <h1 class="dashboard-h1">管理者ダッシュボード</h1>

        {{-- 登録コンテンツ一覧セクション --}}
        <section class="dashboard-section">
            <div class="section-header">
                <h2>登録コンテンツ一覧</h2>
                <a href="{{ route('admin.index') }}" class="btn btn-primary">コンテンツを追加</a>
            </div>
            <div class="table-responsive">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>タイトル</th>
                            <th>説明</th>
                            <th>タグ</th>
                            <th>作成日</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($contents) && $contents->count() > 0)
                            @foreach($contents as $content)
                                <tr>
                                    <td>{{ $content->id }}</td>
                                    <td>{{ $content->title }}</td>
                                    <td>{{ Str::limit($content->description, 50) }}</td>
                                    <td>{{ $content->tag }}</td>
                                    <td>{{ $content->created_at->format('Y/m/d') }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('admin.edit', ['content' => $content->id]) }}" class="btn btn-edit">編集</a>
                                        <form action="{{ route('admin.destroy', ['content' => $content->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="no-data">まだコンテンツが登録されていません。</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>

        {{-- お問い合わせ内容セクション --}}
        <section class="dashboard-section">
            <div class="section-header">
                <h2>お問い合わせ</h2>
                <span class="badge">{{ $inquiries_count ?? 0 }}件の未読</span>
            </div>
            <div class="table-responsive">
                <table class="dashboard-table inquiries-table">
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
                        @if(isset($inquiries) && $inquiries->count() > 0)
                            @foreach($inquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->id }}</td>
                                    <td>{{ $inquiry->name }}</td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td>{{ Str::limit($inquiry->subject, 50) }}</td>
                                    <td>{{ $inquiry->created_at->format('Y/m/d') }}</td>
                                    <td class="action-buttons">
                                        <a href="#" class="btn btn-view">詳細</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="no-data">まだ新しいお問い合わせはありません。</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <a href="{{ route("admin.index") }}">コンテンツ作成</a>
@endsection