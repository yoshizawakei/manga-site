@extends('layouts.app')

@section('title', $content->title)
@section('description', Str::limit(strip_tags($content->body), 120))

@section('css')
    <style>
        .toc-container {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .toc-title {
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .toc-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .toc-list li {
            margin-bottom: 0.5rem;
        }

        .toc-list a {
            text-decoration: none;
            color: #475569;
            font-size: 0.95rem;
        }

        .toc-list a:hover {
            color: #10b981;
        }

        /* Markdown本文内の見出し装飾 */
        .markdown-body h2 {
            font-size: 1.5rem;
            border-left: 5px solid #10b981;
            padding: 0.5rem 1rem;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            background: #f0fdf4;
            font-weight: 800;
        }

        .markdown-body h3 {
            font-size: 1.25rem;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        /* リストの装飾 */
        .markdown-body ul, .markdown-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        /* 画像のレスポンシブ対応 */
        .markdown-body img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        @media (min-width: 992px) {
            .toc-container {
                top: 2rem; /* 画面上部からの固定位置 */
                max-height: calc(100vh - 4rem);
                overflow-y: auto;
                z-index: 10;
            }
        }

        /* 現在読んでいるセクションを強調するためのクラス（任意） */
        .toc-list a.active {
            color: #10b981;
            font-weight: 800;
            border-left: 2px solid #10b981;
            padding-left: 0.5rem;
        }

        /* テーブルを綺麗に見せるためのスタイル */
        .markdown-body table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .markdown-body th, .markdown-body td {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            text-align: left;
        }

        .markdown-body th {
            background-color: #f8fafc;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="row g-4 justify-content-center">
        <article class="col-lg-8">
            <div class="main-content-container mt-0 shadow-sm border p-4 p-md-5 bg-white rounded-4">

                {{-- パンくずリスト --}}
                <nav aria-label="breadcrumb" class="mb-4 small">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('top.index') }}"
                                class="text-decoration-none text-secondary">ホーム</a></li>
                        <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">実践記詳細</li>
                    </ol>
                </nav>

                <header class="mb-5">
                    <div class="mb-3 d-flex flex-wrap gap-2">
                        @foreach($content->tags as $tag)
                            <span
                                class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill small border border-primary border-opacity-25">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <h1 class="h3 fw-bold mb-4" style="color: var(--text-main); line-height: 1.5; letter-spacing: -0.01em;">
                        {{ $content->title }}</h1>
                    <div
                        class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border-start border-primary border-4">
                        <div class="text-secondary small">
                            <span class="me-3"><i
                                    class="far fa-calendar-alt me-1 text-primary"></i>公開：{{ $content->created_at->format('Y.m.d') }}</span>
                            @if($content->updated_at > $content->created_at)
                                <span><i
                                        class="fas fa-sync-alt me-1 text-primary"></i>更新：{{ $content->updated_at->format('Y.m.d') }}</span>
                            @endif
                        </div>
                        <div class="small text-secondary fw-bold">
                            <i class="fas fa-hourglass-half me-1"></i>読了目安：約{{ ceil(mb_strlen($content->body) / 400) }}分
                        </div>
                    </div>
                </header>

                {{-- アイキャッチ画像 --}}
                @if($content->image_url)
                    <div class="text-center mb-5">
                        <img src="{{ asset(ltrim($content->image_url, '/')) }}" alt="{{ $content->title }}"
                            class="img-fluid rounded-4 shadow-sm border w-100" style="max-height: 450px; object-fit: cover;">
                    </div>
                @endif

                {{-- 目次エリア --}}
                <div id="toc" class="toc-container" style="display:none;">
                    <div class="toc-title"><i class="fas fa-list-ul me-2 text-primary"></i>目次</div>
                    <ul id="toc-list" class="toc-list"></ul>
                </div>

                {{-- 本文エリア：ここに集約します --}}
                <div class="article-body">
                    <div class="content-text markdown-body"
                        style="color: var(--text-main); line-height: 1.8; letter-spacing: 0.03em; font-size: 1rem;">
                        <div class="article-body">
                            <div class="content-text markdown-body">
                                {!! Str::markdown($content->body) !!}
                            </div>
                        </div>
                    </div>

                    {{-- アフィリエイト商品リンク --}}
                    @if($content->content_url)
                        <div class="product-card-wrapper my-5 p-4 rounded-4 border-start border-primary border-5 shadow-sm"
                            style="background-color: #f0fdf4;">
                            <p class="text-primary fw-bold mb-3 small"><i class="fas fa-check-circle me-1"></i> 今回紹介したツール・サービス
                            </p>
                            <div class="row align-items-center bg-white p-3 rounded-4 border mx-0">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <img src="{{ asset(ltrim($content->image_url, '/')) }}" class="rounded shadow-sm img-fluid"
                                        style="max-height: 120px;">
                                </div>
                                <div class="col-md-8">
                                    <h4 class="h6 fw-bold mb-2">{{ $content->title }}</h4>
                                    <p class="text-secondary small mb-3">Keiが実際に活用しているおすすめのツールです。詳細は公式サイトをチェックしてください。</p>
                                    <a href="{{ $content->content_url }}" target="_blank" rel="nofollow"
                                        class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm w-100">公式サイトで詳しく見る <i
                                            class="fas fa-external-link-alt ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <hr class="my-5 border-secondary border-opacity-10">

            </div>
        </article>
        @include('partials.sidebar')
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.querySelector('.markdown-body');
            const tocList = document.getElementById('toc-list');
            const tocContainer = document.getElementById('toc');
            const headings = body.querySelectorAll('h2, h3');

            if (headings.length > 0) {
                tocContainer.style.display = 'block';

                // IntersectionObserverでスクロール監視
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            // 目次の全リンクからactiveを外す
                            document.querySelectorAll('.toc-list a').forEach(a => a.classList.remove('active'));
                            // 現在表示されている見出しに対応するリンクを強調
                            const activeAnchor = document.querySelector(`.toc-list a[href="#${entry.target.id}"]`);
                            if (activeAnchor) activeAnchor.classList.add('active');
                        }
                    });
                }, { rootMargin: '-10% 0px -80% 0px' });

                headings.forEach((heading, index) => {
                    const id = 'heading-' + index;
                    heading.setAttribute('id', id);
                    observer.observe(heading); // 監視開始

                    const li = document.createElement('li');
                    li.style.paddingLeft = heading.tagName === 'H3' ? '1.5rem' : '0';

                    const a = document.createElement('a');
                    a.href = '#' + id;
                    a.textContent = heading.textContent;
                    a.className = 'transition-all duration-200';

                    li.appendChild(a);
                    tocList.appendChild(li);
                });
            }
        });
    </script>
@endsection