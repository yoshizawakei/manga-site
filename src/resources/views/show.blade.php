@extends('layouts.app')

@section('title', $content->title)
@section('meta_description', Str::limit(strip_tags($content->description), 120))
@section('canonical_url', route('post.show', $content->slug))
@section('og_type', 'article')
@section('og_image', $content->image_url ? asset(ltrim($content->image_url, '/')) : asset('img/profile.png'))

@section('json_ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": {!! json_encode($content->title) !!},
  "description": {!! json_encode(Str::limit(strip_tags($content->description), 200)) !!},
  "url": {!! json_encode(route('post.show', $content->slug)) !!},
  "datePublished": {!! json_encode($content->created_at->toIso8601String()) !!},
  "dateModified": {!! json_encode($content->updated_at->toIso8601String()) !!},
  "author": {
    "@type": "Person",
    "name": "KEI",
    "url": {!! json_encode(route('top.profile')) !!}
  },
  "publisher": {
    "@type": "Organization",
    "name": "KEI BLOG",
    "url": {!! json_encode(url('/')) !!}
  },
  "image": {!! json_encode($content->image_url ? asset(ltrim($content->image_url, '/')) : asset('img/profile.png')) !!}
}
</script>
@endsection

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

                    <h1 class="fw-black mb-4" style="font-size: 1.8rem; line-height: 1.4; color: #111;">
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

                <p class="article-body">
                    {{ $content->description }}
                </p>

                {{-- 目次エリア --}}
                <div id="toc" class="toc-container mb-5" style="display:none;">
                    <div class="toc-title text-uppercase">Index</div>
                    <ul id="toc-list" class="toc-list"></ul>
                </div>

                <div class="article-body">
                    <div class="markdown-body">
                        {!! Str::markdown($content->body) !!}
                    </div>

                    <!-- @if($content->content_url)
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
                    @endif -->
                </div>

                {{-- 関連記事 --}}
                @if($related_contents->isNotEmpty())
                <div class="mt-5 pt-5 border-top">
                    <h2 class="related-title mb-4">RELATED ARTICLES</h2>
                    <div class="row g-4">
                        @foreach($related_contents as $related)
                        <div class="col-sm-6">
                            <a href="{{ route('post.show', $related->slug) }}" class="text-decoration-none related-card">
                                @if($related->image_url)
                                    <img src="{{ asset(ltrim($related->image_url, '/')) }}"
                                         alt="{{ $related->title }}"
                                         class="related-card-img mb-2">
                                @else
                                    <div class="related-card-img-placeholder mb-2"></div>
                                @endif
                                <div class="related-card-tags mb-1">
                                    @foreach($related->tags->take(2) as $tag)
                                        <span class="related-tag">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <p class="related-card-title">{{ $related->title }}</p>
                                <p class="related-card-date">{{ $related->created_at->format('Y.m.d') }}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mt-5 pt-4 border-top text-center">
                    <a href="{{ route('top.index') }}" class="sidebar-link">BACK TO TOP →</a>
                </div>
            </article>

            {{-- サイドバー --}}
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

        /* サイドバー共通パーツ：他ページと同期 */
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

        .profile-icon-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1.2rem;
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
        }

        .latest-item {
            display: flex !important;
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

        /* 目次のデザイン */
        .toc-container {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 2px;
            border: 1px solid #eee;
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

        .toc-item {
            margin-bottom: 0.6rem;
        }

        .toc-link-wrap {
            display: flex;
            align-items: center;
        }

        .toc-link {
            text-decoration: none;
            color: #666;
            font-size: 0.9rem;
            font-weight: bold;
            transition: color 0.2s;
        }

        .toc-link:hover {
            color: #111;
        }

        .toc-child-group {
            list-style: none;
            padding-left: 1.5rem;
            margin-top: 0.4rem;
            display: none;
            border-left: 1px dashed #ccc;
        }

        .toc-child-group.is-open {
            display: block;
        }

        .toc-child-link {
            text-decoration: none;
            color: #888;
            font-size: 0.85rem;
            display: block;
            padding: 2px 0;
        }

        .toc-child-link:hover {
            color: #111;
        }

        .toc-toggle {
            cursor: pointer;
            display: inline-block;
            width: 20px;
            font-size: 0.6rem;
            color: #999;
            transition: transform 0.2s;
        }

        .toc-toggle.is-active {
            transform: rotate(90deg);
            color: #111;
        }

        /* 本文スタイル */
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

        /* 関連記事 */
        .related-title {
            font-size: 0.75rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            border-bottom: 1px solid #111;
            padding-bottom: 8px;
            color: #111;
            text-transform: uppercase;
        }

        .related-card {
            display: block;
            color: inherit;
        }

        .related-card-img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 2px;
            display: block;
        }

        .related-card-img-placeholder {
            width: 100%;
            height: 140px;
            background: #f0f0f0;
            border-radius: 2px;
        }

        .related-card-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .related-tag {
            font-size: 0.7rem;
            color: #888;
            font-weight: bold;
        }

        .related-card-title {
            font-size: 0.9rem;
            font-weight: 900;
            color: #111;
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .related-card-date {
            font-size: 0.75rem;
            color: #aaa;
            margin: 0;
        }

        .related-card:hover .related-card-title {
            opacity: 0.7;
        }
    </style>
@endsection

@section('script')
    {{-- Markdown解析用のライブラリをここで読み込み --}}
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.querySelector('.markdown-body');
            const tocList = document.getElementById('toc-list');
            const tocContainer = document.getElementById('toc');
            if (!body || !tocList || !tocContainer) return;

            // 本文の中から見出しを探す
            const headings = body.querySelectorAll('h2, h3');

            // 見出しが1つ以上あれば目次を表示する
            if (headings.length > 0) {
                // CSSに勝てるように明示的に表示
                tocContainer.style.setProperty('display', 'block', 'important');

                let currentH2Li = null;
                let currentChildGroup = null;

                headings.forEach((heading, index) => {
                    const id = 'section-' + index;
                    heading.setAttribute('id', id);

                    if (heading.tagName === 'H2') {
                        currentH2Li = document.createElement('li');
                        currentH2Li.className = 'toc-item';

                        const linkWrap = document.createElement('div');
                        linkWrap.className = 'toc-link-wrap';

                        const toggle = document.createElement('span');
                        toggle.className = 'toc-toggle';
                        toggle.style.visibility = 'hidden';
                        toggle.innerHTML = '▶';
                        linkWrap.appendChild(toggle);

                        const a = document.createElement('a');
                        a.href = '#' + id;
                        a.className = 'toc-link';
                        a.textContent = heading.textContent;
                        linkWrap.appendChild(a);

                        currentH2Li.appendChild(linkWrap);
                        tocList.appendChild(currentH2Li);

                        currentChildGroup = document.createElement('ul');
                        currentChildGroup.className = 'toc-child-group';
                        currentH2Li.appendChild(currentChildGroup);

                        toggle.onclick = (e) => {
                            toggle.classList.toggle('is-active');
                            currentChildGroup.classList.toggle('is-open');
                        };
                    }
                    else if (heading.tagName === 'H3' && currentChildGroup) {
                        const parentToggle = currentH2Li.querySelector('.toc-toggle');
                        if (parentToggle) parentToggle.style.visibility = 'visible';

                        const childLi = document.createElement('li');
                        const childA = document.createElement('a');
                        childA.href = '#' + id;
                        childA.className = 'toc-child-link';
                        childA.textContent = heading.textContent;
                        childLi.appendChild(childA);
                        currentChildGroup.appendChild(childLi);
                    }
                });
            }
        });
    </script>
@endsection