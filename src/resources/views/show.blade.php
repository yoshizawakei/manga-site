@extends('layouts.app')

@section('title', $content->title)
@section('description', Str::limit(strip_tags($content->body), 120))

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row g-4 g-lg-5">
            {{-- メインコンテンツ --}}
            <article class="col-lg-8">
                <header class="mb-5">
                    <div class="mb-3 d-flex flex-wrap gap-3">
                        @foreach($content->tags as $tag)
                            <a href="{{ route('tags.show', $tag->name) }}"
                                class="text-decoration-none text-secondary small fw-bold">#{{ $tag->name }}</a>
                        @endforeach
                    </div>

                    <h1 class="fw-black mb-4" style="font-size: 2.2rem; line-height: 1.4; color: #111;">
                        {{ $content->title }}
                    </h1>

                    <div class="d-flex align-items-center text-secondary small border-top border-bottom py-3"
                        style="letter-spacing: 0.05em;">
                        <div class="me-4">
                            <i class="far fa-calendar-alt me-1"></i>{{ $content->created_at->format('Y.m.d') }}
                        </div>
                        @if($content->updated_at > $content->created_at)
                            <div class="me-4">
                                <i class="fas fa-sync-alt me-1"></i>{{ $content->updated_at->format('Y.m.d') }}
                            </div>
                        @endif
                        <div class="ms-auto text-uppercase fw-bold" style="font-size: 0.7rem;">
                            Estimate: {{ ceil(mb_strlen($content->body) / 400) }} min
                        </div>
                    </div>
                </header>

                @if($content->image_url)
                    <div class="mb-5">
                        <img src="{{ asset(ltrim($content->image_url, '/')) }}" alt="{{ $content->title }}"
                            class="img-fluid w-100" style="max-height: 500px; object-fit: cover; border-radius: 2px;">
                    </div>
                @endif

                <div id="toc" class="toc-container mb-5" style="display:none;">
                    <div class="toc-title text-uppercase">Index</div>
                    <ul id="toc-list" class="toc-list"></ul>
                </div>

                <div class="article-body">
                    <div class="markdown-body">
                        {!! Str::markdown($content->body) !!}
                    </div>

                    @if($content->content_url)
                        <div class="my-5 p-4 border rounded-2 bg-light">
                            <p class="fw-bold mb-3 small text-uppercase" style="letter-spacing: 0.1em;">おすすめのサービス</p>
                            <div class="row align-items-center g-3">
                                <div class="col-md-3">
                                    <img src="{{ asset(ltrim($content->image_url, '/')) }}" class="img-fluid rounded-1 border">
                                </div>
                                <div class="col-md-9">
                                    <h4 class="h6 fw-black mb-2">{{ $content->title }}</h4>
                                    <p class="text-secondary small mb-3">実際に活用しているおすすめのツールです。</p>
                                    <a href="{{ $content->content_url }}" target="_blank" rel="nofollow"
                                        class="sidebar-link">VISIT OFFICIAL SITE →</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-5 pt-5 border-top text-center">
                    <a href="{{ route('top.index') }}" class="sidebar-link">BACK TO TOP →</a>
                </div>
            </article>

            {{-- サイドバー：他ページと同じ共通パーツを使用 --}}
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
        .fw-black {
            font-weight: 900 !important;
        }

        /* 1. サイドバーのデザインを他ページと完全同期 */
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
            text-transform: uppercase;
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

        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111 !important;
            text-decoration: none;
            border-bottom: 1px solid #111;
            padding-bottom: 2px;
            display: inline-block;
            transition: opacity 0.2s;
        }

        .sidebar-link:hover {
            opacity: 0.7;
            color: #111 !important;
        }

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
            color: #111;
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

        /* 2. 目次と本文のスタイル */
        .toc-container {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 2px;
        }

        .toc-title {
            font-weight: 900;
            font-size: 0.8rem;
            margin-bottom: 1.2rem;
            letter-spacing: 0.1em;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }

        .toc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .toc-list li {
            margin-bottom: 0.6rem;
        }

        .toc-list a {
            text-decoration: none;
            color: #666;
            font-size: 0.9rem;
        }

        .toc-list a:hover,
        .toc-list a.active {
            color: #111;
            font-weight: bold;
        }

        .markdown-body {
            font-size: 1.05rem;
            line-height: 2;
            color: #333;
        }

        .markdown-body h2 {
            font-size: 1.6rem;
            font-weight: 900;
            margin-top: 4rem;
            margin-bottom: 1.5rem;
            padding-bottom: 10px;
            border-bottom: 2px solid #111;
            color: #111;
        }

        .markdown-body h3 {
            font-size: 1.3rem;
            font-weight: 900;
            margin-top: 3rem;
            margin-bottom: 1.2rem;
            color: #111;
        }

        .markdown-body p {
            margin-bottom: 2rem;
        }

        @media (min-width: 992px) {
            .sidebar-sticky-wrapper {
                position: sticky;
                top: 100px;
                padding-left: 3rem;
            }
        }
    </style>
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
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            document.querySelectorAll('.toc-list a').forEach(a => a.classList.remove('active'));
                            const activeAnchor = document.querySelector(`.toc-list a[href="#${entry.target.id}"]`);
                            if (activeAnchor) activeAnchor.classList.add('active');
                        }
                    });
                }, { rootMargin: '-10% 0px -80% 0px' });

                headings.forEach((heading, index) => {
                    const id = 'heading-' + index;
                    heading.setAttribute('id', id);
                    observer.observe(heading);
                    const li = document.createElement('li');
                    if (heading.tagName === 'H3') li.style.paddingLeft = '1.2rem';
                    const a = document.createElement('a');
                    a.href = '#' + id;
                    a.textContent = heading.textContent;
                    li.appendChild(a);
                    tocList.appendChild(li);
                });
            }
        });
    </script>
@endsection