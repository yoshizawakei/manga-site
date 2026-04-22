@extends('layouts.app')

@section('content')
    {{-- ヒーローセクション：Keiの副業ログ仕様 --}}
    <section class="hero-clean bg-white border-bottom py-5 mb-5 shadow-sm text-center">
        <div class="container-xxl px-4">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="mb-4">
                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 fw-bold small">
                            <i class="fas fa-shoe-prints me-1"></i> 未経験からの挑戦
                        </span>
                    </div>
                    {{-- ★ display-5 を h2 に変更し、サブタイトルのサイズも調整 ★ --}}
                    <h1 class="h2 fw-bold mb-3" style="color: var(--text-main); line-height: 1.4;">
                        Keiの副業ログ<br>
                        <span style="color: var(--primary-color); font-size: 0.6em; letter-spacing: 0.05em;">未経験からの収益化実践記</span>
                    </h1>
                    {{-- ★ 本文も fs-6 (16px) を基準に調整 ★ --}}
                    <p class="text-secondary mb-4 mx-auto fs-6" style="max-width: 600px; line-height: 1.7;">
                        スキルなし・知識ゼロから始めたアフィリエイトのリアルな過程を公開。<br class="d-none d-md-block">
                        一歩ずつ着実に収益化を目指す、等身大の実践記録です。
                    </p>

                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-4">
                        <a href="#main-content" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                            <i class="fas fa-book-open me-2"></i>最新の実践記を読む
                        </a>
                        <a href="{{ route('tags.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
                            <i class="fas fa-search me-2"></i>ジャンルから探す
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-xxl px-3" id="main-content">
        <div class="row g-4">
            {{-- メイン：記事一覧 --}}
            <main class="col-lg-8">
                <h2 class="h3 fw-bold mb-4 pb-2 border-bottom">
                    <i class="fas fa-latest me-2"></i>最新の記事
                </h2>

                <div class="row g-3 g-md-4">
                    @forelse($contents_all as $index => $manga_all)
                        {{-- 広告エリア：将来的にASPのバナーなどに差し替えられるよう維持 --}}
                        @if($index > 0 && $index % 6 == 0)
                            <div class="col-12 my-3">
                                <div class="ad-scroll-container bg-white border rounded shadow-sm text-center py-4">
                                    <span class="text-secondary small">-- Advertisement --</span>
                                    {{-- 将来ここにアフィリエイトバナーを配置 --}}
                                </div>
                            </div>
                        @endif

                        <div class="col-12 mb-3">
                            <article class="card h-100 border-0 shadow-sm overflow-hidden bg-white">
                                <a href="{{ route('post.show', $manga_all->encrypted_id) }}" class="text-decoration-none d-flex flex-column flex-md-row">
                                    {{-- 画像エリアを小さく固定 --}}
                                    <div class="col-md-4 col-lg-3"
                                        style="background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 180px;">
                                        <img src="{{ $manga_all->image_url }}" class="img-fluid p-2"
                                            style="max-height: 160px; object-fit: contain;" alt="{{ $manga_all->title }}">
                                    </div>
                                    {{-- テキストエリアを広く取る --}}
                                    <div class="card-body p-3 p-md-4 flex-grow-1">
                                        <div class="mb-2">
                                            <span class="badge bg-primary bg-opacity-10 text-primary small">実践記</span>
                                        </div>
                                        <h3 class="card-title text-main fs-5 fw-bold mb-2">{{ $manga_all->title }}</h3>
                                        <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                            {{ Str::limit($manga_all->description, 100) }}
                                        </p>
                                        <div class="mt-3 text-primary small fw-bold">
                                            続きを読む <i class="fas fa-arrow-right ms-1"></i>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-secondary fw-bold">記事を準備中です。</div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center pagination-wrapper">
                    {!! $contents_all->appends(Request::all())->links('pagination::bootstrap-4') !!}
                </div>
            </main>
            {{-- サイドバーの呼び出し --}}
            @include('partials.sidebar')
        </div>
    </div>
@endsection