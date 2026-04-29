@extends('layouts.app')

@section('title', $title . ' の記事一覧')

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row g-4 g-lg-5">
            {{-- メインコンテンツ：ABOUT MEの構造と完全同期 --}}
            <main class="col-lg-8">
                <h1 class="fw-black mb-4 mb-lg-5"
                    style="font-size: 1.7rem; letter-spacing: 0.01em; text-transform: uppercase;">
                    {{ $title }}
                </h1>

                <p class="text-secondary small mb-5" style="letter-spacing: 0.1em;">
                    TOTAL: {{ $contents->total() }} POSTS
                </p>

                @if ($contents->count() > 0)
                    <div class="post-list">
                        @foreach ($contents as $content)
                            <div class="mb-5">
                                <a href="{{ route('post.show', $content->encrypted_id) }}"
                                    class="text-decoration-none d-flex align-items-start shadow-none">
                                    {{-- サムネイル：140x95pxで固定 --}}
                                    <div class="me-4"
                                        style="width: 140px; height: 95px; flex-shrink: 0; background-color: #f8f8f8;">
                                        <img src="{{ $content->image_url }}" alt="{{ $content->title }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="text-secondary" style="font-size: 0.75rem; margin-bottom: 5px;">
                                            {{ $content->created_at->format('Y.m.d') }}</div>
                                        <h2 class="fw-bold text-dark"
                                            style="font-size: 1.1rem; line-height: 1.5; margin-bottom: 8px;">{{ $content->title }}
                                        </h2>
                                        <p class="text-secondary small d-none d-md-block mb-0" style="line-height: 1.7;">
                                            {{ Str::limit(strip_tags($content->description), 100) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        {{ $contents->links('pagination::bootstrap-4') }}
                    </div>
                @endif

                <div class="mt-5 pt-5 text-center">
                    <a href="{{ route('top.index') }}"
                        class="text-dark fw-bold small text-decoration-none border-bottom border-dark pb-1">BACK TO TOP
                        →</a>
                </div>
            </main>

            {{-- サイドバー：余計なWrapperを入れず、ABOUT MEと同じasideクラス --}}
            <aside class="col-lg-4">
                <div class="sidebar-sticky-wrapper">
                    @include('partials.sidebar')
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* 1. フォントと基本設定 */
        .fw-black {
            font-weight: 900 !important;
        }

        /* 2. サイドバーのデザインを他ページと1px単位で同期 */
        .sidebar-section {
            margin-bottom: 3.5rem;
        }

        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            border-bottom: 1px solid #111;
            padding-bottom: 8px;
            margin-bottom: 1.5rem;
            color: #111;
        }

        .sidebar-name {
            font-size: 1.1rem;
            font-weight: 900;
            margin-bottom: 1rem;
            color: #111;
        }

        .sidebar-text {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.7;
            margin-bottom: 1.2rem;
        }

        .profile-icon {
            font-size: 4rem;
            color: #111;
            margin-bottom: 10px;
        }

        /* 【ここを修正】プロフィール詳細リンクの色とスタイル */
        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111 !important;
            /* 強制的に黒にする */
            text-decoration: none;
            border-bottom: 1px solid #111;
            /* 下線をボーダーで再現 */
            padding-bottom: 2px;
            display: inline-block;
            transition: opacity 0.2s;
        }

        .sidebar-link:hover {
            opacity: 0.7;
            color: #111 !important;
        }

        /* 3. リストのスタイル設定 */
        .sidebar-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-list li {
            margin-bottom: 10px;
        }

        .sidebar-list li a {
            font-size: 0.9rem;
            color: #444;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .sidebar-list li a:hover {
            opacity: 0.7;
        }

        .latest-item {
            display: flex !important;
            align-items: center;
            text-decoration: none;
            margin-bottom: 15px;
            transition: opacity 0.2s;
        }

        .latest-item:hover {
            opacity: 0.7;
        }

        .latest-item img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            margin-right: 12px;
            border-radius: 2px;
        }

        .latest-title {
            font-size: 0.85rem;
            font-weight: bold;
            color: #333;
            line-height: 1.4;
        }

        /* 4. PCのみサイドバーを固定 */
        @media (min-width: 992px) {
            .sidebar-sticky-wrapper {
                position: sticky;
                top: 100px;
                padding-left: 3rem;
            }
        }
    </style>
@endsection