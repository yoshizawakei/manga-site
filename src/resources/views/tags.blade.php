@extends('layouts.app')

@section('title', 'カテゴリー一覧')

@section('css')
    <style>
        .tags-main-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .tags-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .tags-card-header {
            padding: 1.5rem;
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            font-weight: 800;
            font-size: 1.25rem;
        }

        .tags-card-body {
            padding: 2rem 1.5rem;
        }

        @media (min-width: 768px) {
            .tags-card-body {
                padding: 3rem;
            }
        }

        .tag-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 0;
            list-style: none;
            margin: 0;
        }

        .tag-badge-link {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #f8fafc;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            border-radius: 999px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .tag-badge-link:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background-color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
        }

        /* 広告枠のプレースホルダー */
        .ad-placeholder {
            background-color: #f1f5f9;
            border: 2px dashed var(--border-color);
            border-radius: 1rem;
            padding: 2rem;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl py-4">
        <div class="tags-main-container">

            <div class="tags-card shadow-sm bg-white">
                <div class="tags-card-header d-flex align-items-center">
                    <i class="fas fa-folder-open me-2 text-primary"></i>
                    <span>カテゴリー一覧</span>
                </div>

                <div class="tags-card-body">
                    {{-- パンくずリスト --}}
                    <nav aria-label="breadcrumb" class="mb-4 small">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('top.index') }}"
                                    class="text-decoration-none">ホーム</a></li>
                            <li class="breadcrumb-item active" aria-current="page">カテゴリー</li>
                        </ol>
                    </nav>

                    <h1 class="h5 fw-bold mb-3">気になるテーマから探す</h1>
                    <p class="text-secondary mb-5 small">これまでの副業の実践記録や、使用しているツールをカテゴリー別にまとめています。</p>

                    @if(isset($tags))
                        <ul class="tag-list">
                            @forelse($tags as $tag)
                                <li>
                                    <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}" class="tag-badge-link">
                                        <i class="fas fa-hashtag me-1 text-primary-emphasis opacity-50"></i>{{ $tag->name }}
                                    </a>
                                </li>
                            @empty
                                <div class="py-5 text-center w-100">
                                    <p class="text-secondary">現在、登録されているカテゴリーはありません。</p>
                                </div>
                            @endforelse
                        </ul>
                    @else
                        <div class="alert alert-warning border-0 small">
                            <i class="fas fa-exclamation-triangle me-2"></i>カテゴリー情報を読み込めませんでした。
                        </div>
                    @endif
                </div>
            </div>

            {{-- 広告セクション（将来用） --}}
            <div class="mt-5 text-center">
                <div class="ad-placeholder">
                    <p class="mb-0">-- 広告 / お知らせ --</p>
                </div>
            </div>

            <div class="mt-5 text-center">
                <a href="{{ route('top.index') }}" class="btn btn-outline-dark px-5 rounded-pill fw-bold btn-sm">
                    <i class="fas fa-arrow-left me-2"></i>トップページへ戻る
                </a>
            </div>

        </div>
    </div>
@endsection