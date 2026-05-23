@extends('layouts.app')

@section('content')
    <section class="py-5 mt-lg-5 mb-5">
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-8">
                    {{-- 案3：ゆるい決意をベースに --}}
                    <h1 class="display-6 fw-bold mb-4" style="font-weight: 900; letter-spacing: 0.01em;">
                        KEI BLOG
                    </h1>
                    <p class="text-secondary mb-4 fs-6" style="max-width: 600px; line-height: 1.8;">
                        完璧より、継続。<br>
                        WEBエンジニアが「とりあえずやってみる」ための、なんてことない場所。
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('tags.index') }}"
                            class="text-dark fw-bold text-decoration-none border-bottom border-1 border-dark pb-1"
                            style="font-size: 0.8rem; letter-spacing: 0.1em;">
                            INDEX →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container px-4">
        <div class="row g-5">
            {{-- メインコンテンツ --}}
            <main class="col-lg-8">
                <div class="mb-5 pb-2 border-bottom border-dark border-1">
                    <h2 class="h6 fw-bold mb-0" style="letter-spacing: 0.15em;">RECENT POSTS</h2>
                </div>

                <div class="row">
                    @forelse($contents_all as $index => $manga_all)
                        <div class="col-12 mb-5">
                            <article class="post-item">
                                <a href="{{ route('post.show', $manga_all->encrypted_id) }}"
                                    class="text-decoration-none row g-4 align-items-start">
                                    <div class="col-md-4">
                                        {{-- 画像はカラー。hoverで少し薄くして「押せる感」を出します --}}
                                        <div style="background-color: #f8f8f8; overflow: hidden; border-radius: 2px;">
                                            <img src="{{ $manga_all->image_url }}" class="img-fluid post-thumbnail"
                                                style="width: 100%; height: 160px; object-fit: cover; transition: 0.3s;"
                                                alt="{{ $manga_all->title }}">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="mb-2">
                                            <span class="text-muted small fw-bold"
                                                style="letter-spacing: 0.05em; font-size: 0.7rem;">
                                                {{ $manga_all->created_at->format('Y.m.d') }}
                                            </span>
                                        </div>
                                        <h3 class="text-dark fw-bold mb-2" style="line-height: 1.5; font-size: 1.15rem;">
                                            {{ $manga_all->title }}
                                        </h3>
                                        <p class="text-secondary small d-none d-md-block mb-0" style="line-height: 1.7;">
                                            {{ Str::limit($manga_all->description, 180) }}
                                        </p>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @empty
                        <div class="col-12 py-5 text-muted">No articles found.</div>
                    @endforelse
                </div>

                <div class="mt-5">
                    {!! $contents_all->appends(Request::all())->links('pagination::bootstrap-4') !!}
                </div>
            </main>

            {{-- サイドバー：PC環境での崩れ防止（余白とフォントサイズ調整） --}}
            <aside class="col-lg-4">
                <div class="ps-lg-5 sticky-top sidebar-wrapper" style="top: 100px;">
                    @include('partials.sidebar')
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* メインコンテンツ：ホバー時の下線を自然に */
        .post-item {
            transition: opacity 0.3s;
            text-decoration: none;
        }

        .post-item:hover {
            opacity: 0.7;
        }

        /* サイドバー全体の調整 */
        .sidebar-inner {
            padding-left: 2rem;
        }

        .sidebar-section {
            margin-bottom: 4rem;
        }

        /* プロフィール */
        .profile-icon i {
            font-size: 50px;
            color: #111;
            margin-bottom: 1.2rem;
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
            margin-bottom: 1.2rem;
        }

        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111;
            text-decoration: none;
            border-bottom: 1px solid #111;
        }

        /* サイドバー見出し（マナブログ風） */
        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            border-bottom: 1px solid #111;
            padding-bottom: 8px;
            margin-bottom: 1.5rem;
        }

        /* リスト（カテゴリーなど） */
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

        .sidebar-list li a:hover {
            text-decoration: underline;
        }

        /* 最新記事ミニリスト */
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

        @media (max-width: 991px) {
            .sidebar-inner {
                padding-left: 0;
                margin-top: 5rem;
            }
        }
    </style>
@endsection