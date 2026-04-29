@extends('layouts.app')

@section('title', 'カテゴリー一覧')

@section('content')
    {{-- ヘッダー：他ページと余白・フォントを完全同期 --}}
    <section class="py-5 mt-lg-5 mb-5">
        <div class="container px-4">
            <h1 class="fw-black mb-4" style="font-size: 2.0rem; letter-spacing: 0.01em; text-transform: uppercase;">
                CATEGORIES
            </h1>
            <p class="text-secondary" style="letter-spacing: 0.05em; line-height: 1.8;">
                これまでの記事をカテゴリー別にまとめています。
            </p>
        </div>
    </section>

    <div class="container px-4">
        <div class="row g-5">
            {{-- 左側：メインコンテンツ --}}
            <main class="col-lg-8">
                <div class="mb-5">
                    @if(isset($tags) && $tags->count() > 0)
                        <div class="tag-grid">
                            @foreach($tags as $tag)
                                <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}" class="tag-item">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="py-5 text-center border">
                            <p class="text-secondary small mb-0">現在、登録されているカテゴリーはありません。</p>
                        </div>
                    @endif
                </div>

                <div class="mt-5 pt-5 text-center">
                    <a href="{{ route('top.index') }}" class="sidebar-link">BACK TO TOP →</a>
                </div>
            </main>

            {{-- 右側：サイドバー (PCのみ固定、スマホでは下に流れる) --}}
            <aside class="col-lg-4">
                <div class="sidebar-wrapper">
                    @include('partials.sidebar')
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* 共通設定 */
        .fw-black {
            font-weight: 900 !important;
            color: #111;
        }

        /* タググリッドのデザイン：トップページのトーンに合わせる */
        .tag-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .tag-item {
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #111;
            /* 細い黒枠 */
            color: #111;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: bold;
            letter-spacing: 0.05em;
            transition: all 0.2s ease;
        }

        .tag-item:hover {
            background-color: #111;
            color: #fff;
            text-decoration: none;
        }

        /* サイドバー・リンク共通スタイル */
        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111;
            text-decoration: none;
            border-bottom: 1px solid #111;
            padding-bottom: 4px;
        }

        /* レスポンシブ制御 */
        @media (min-width: 992px) {
            .sidebar-wrapper {
                position: sticky;
                top: 100px;
                padding-left: 3rem;
            }
        }

        @media (max-width: 991px) {
            .sidebar-wrapper {
                margin-top: 5rem;
                padding-left: 0;
            }

            .fw-black {
                font-size: 1.8rem;
            }
        }

        /* サイドバーコンポーネント用：以前の修正内容を補完 */
        .sidebar-section {
            margin-bottom: 4rem;
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
        }

        .sidebar-text {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.8;
        }

        .sidebar-list {
            list-style: none;
            padding: 0;
        }

        .sidebar-list li {
            margin-bottom: 12px;
        }

        .sidebar-list li a {
            font-size: 0.9rem;
            color: #444;
            text-decoration: none;
        }

        .latest-item {
            display: flex;
            align-items: center;
            text-decoration: none;
            margin-bottom: 15px;
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
    </style>
@endsection