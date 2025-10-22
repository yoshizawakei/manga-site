@extends('layouts.admin')
{{-- NOTE: ユーザー向けページですが、デザイン統一のため、Bootstrap構造を持つlayouts.adminを継承します。 --}}

@section("css")
    <link rel="stylesheet" href="{{ asset('css/tags.css') }}">
    <style>
        /* タグ一覧ページ用スタイル */
        .main-content-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            background-color: var(--card-background);
            /* common.cssのカード背景色を使用 */
            border-radius: 0.75rem;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
        }

        .main-content-container h2 {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 2rem;
        }

        .tag-list {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            list-style: none;
        }

        .tag-list li {
            margin: 0 0.75rem 0.75rem 0;
        }

        .tag-link {
            /* Bootstrapのバッジやボタンのようにデザイン */
            display: inline-block;
            padding: 0.75rem 1.25rem;
            background-color: #333333;
            /* 少し濃い背景色 */
            color: var(--secondary-color);
            /* シアンの文字色 */
            border: 1px solid var(--secondary-color);
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }

        .tag-link:hover {
            background-color: var(--secondary-color);
            /* ホバーで背景色をシアンに */
            color: #121212;
            /* ホバーで文字色をダークに */
            border-color: var(--primary-color);
            /* ホバーでボーダーを紫に */
            transform: translateY(-2px);
        }

        .no-results {
            color: #888;
        }
    </style>
@endsection

@section('content')
    <div class="main-content-container">
        <h2>タグ一覧</h2>

        <p class="text-white-50 mb-4">気になるキーワードから漫画を探しましょう。</p>

        @if(isset($tags))
            <ul class="tag-list">
                @forelse($tags as $tag)
                    <li>
                        <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}" class="tag-link">
                            <i class="fas fa-tag me-1"></i>{{ $tag->name }}
                        </a>
                    </li>
                @empty
                    <p class="no-results alert alert-secondary text-dark">
                        <i class="fas fa-search-minus me-2"></i>タグが見つかりませんでした。
                    </p>
                @endforelse
            </ul>
        @else
            <p class="no-results alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>タグ情報を取得できませんでした。
            </p>
        @endif
    </div>
@endsection