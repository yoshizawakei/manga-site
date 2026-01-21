@extends('layouts.app')

@section('title', ' | タグ一覧')

@section('css')
    <style>
        /* 1. コンテナ：他の固定ページと統一したパディングと幅 */
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
            padding: 1.25rem 1.5rem;
            background-color: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            font-weight: 800;
        }

        /* 2. パディング確保：モバイルでも端にくっつかないように調整 */
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
            gap: 0.75rem;
            padding: 0;
            list-style: none;
            margin: 0;
        }

        .tag-badge-link {
            display: inline-block;
            padding: 0.6rem 1.25rem;
            background-color: #f1f5f9;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            border-radius: 999px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .tag-badge-link:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background-color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
        }

        /* 3. 広告コンテナ：レスポンシブ対応（横揺れ防止） */
        .ad-scroll-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            display: flex;
            justify-content: flex-start;
            padding: 10px 0;
        }

        @media (min-width: 992px) {
            .ad-scroll-container {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl py-4">
        <div class="tags-main-container">

            <div class="tags-card shadow-sm">
                <div class="tags-card-header d-flex align-items-center">
                    <i class="fas fa-tags me-2 text-primary"></i>
                    <span>全てのカテゴリー一覧</span>
                </div>

                <div class="tags-card-body">
                    {{-- パンくずリスト --}}
                    <nav aria-label="breadcrumb" class="mb-4 small">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('top.index') }}"
                                    class="text-decoration-none">ホーム</a></li>
                            <li class="breadcrumb-item active" aria-current="page">タグ一覧</li>
                        </ol>
                    </nav>

                    <p class="text-secondary mb-5 fw-bold">気になるキーワードから漫画・商品をお探しいただけます。</p>

                    @if(isset($tags))
                        <ul class="tag-list">
                            @forelse($tags as $tag)
                                <li>
                                    <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}" class="tag-badge-link">
                                        #{{ $tag->name }}
                                    </a>
                                </li>
                            @empty
                                <div class="py-5 text-center w-100">
                                    <p class="text-secondary">現在、登録されているタグはありません。</p>
                                </div>
                            @endforelse
                        </ul>
                    @else
                        <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger small">
                            <i class="fas fa-exclamation-triangle me-2"></i>タグ情報を取得できませんでした。
                        </div>
                    @endif
                </div>
            </div>

            {{-- 修正点：他のページ（show.blade.php）と同じ広告セクションを導入 --}}
            <div class="ad-section-wrapper p-3 rounded bg-white border shadow-sm mt-5 text-center">
                <p class="text-secondary mb-2 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.1em;">
                    <i class="fas fa-thumbs-up me-1 text-primary"></i>あなたへのおすすめ作品
                </p>

                {{-- 横長の広告が悪さをしないよう、スクロールコンテナで包む --}}
                <div class="ad-scroll-container">
                    <div style="min-width: 728px; flex-shrink: 0;">
                        {{-- DMM 728x90 タグ：他のページと統一 --}}
                        <ins class="dmm-widget-placement" data-id="526c6c1e3807186e9de662e4bf9d0970"
                            style="background:transparent"></ins>
                        <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                            data-id="526c6c1e3807186e9de662e4bf9d0970"></script>
                    </div>
                </div>
            </div>

            <div class="mt-5 text-center">
                <a href="{{ route('top.index') }}" class="btn btn-outline-primary px-5 rounded-pill fw-bold">
                    <i class="fas fa-arrow-left me-2"></i>トップページへ戻る
                </a>
            </div>

        </div>
    </div>
@endsection