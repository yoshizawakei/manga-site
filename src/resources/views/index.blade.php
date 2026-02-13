@extends('layouts.app')

@section('content')
    {{-- ヒーローセクション (中央揃え & レスポンシブ) --}}
    <section class="hero-clean bg-white border-bottom py-5 mb-5 shadow-sm text-center">
        <div class="container-xxl px-4">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="mb-4">
                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 fw-bold small"></span>
                    </div>
                    <h1 class="display-5 fw-bold mb-4" style="color: var(--text-main); line-height: 1.3;">エロ漫画と夜のおもちゃ<br>
                        <span style="color: var(--primary-color);"></span>
                    </h1>
                    <p class="lead text-secondary mb-5 mx-auto fs-6 fs-md-5" style="max-width: 700px; line-height: 1.8;">
                        話題の新作から隠れた名作まで、あなたの「次に読みたい」が見つかる。
                    </p>
                    
                    <div class="btn-responsive-group">
                        <a href="#main-content" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm">
                            最新レビューを見る
                        </a>
                        <a href="{{ route('tags.index') }}" class="btn btn-outline-dark btn-lg rounded-pill px-5 py-3 fw-bold">
                            タグから探す
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-xxl px-3" id="main-content">
        <div class="row g-4">
            {{-- メイン：一覧 --}}
            <main class="col-lg-8">
                <h2 class="h3 fw-bold mb-4 pb-2 border-bottom">最新の漫画レビュー</h2>
                
                <div class="row g-3 g-md-4">
                    @forelse($contents_all as $index => $manga_all)
                        @if($index > 0 && $index % 6 == 0)
                            <div class="col-12 my-3">
                                <div class="ad-scroll-container bg-white border rounded shadow-sm">
                                    <div>
                                        <ins class="dmm-widget-placement" data-id="526c6c1e3807186e9de662e4bf9d0970" style="background:transparent"></ins>
                                        <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts" data-id="526c6c1e3807186e9de662e4bf9d0970"></script>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-6 col-md-4">
                            <article class="card h-100 border-0 shadow-sm overflow-hidden bg-white">
                                <a href="{{ route('manga.show', $manga_all->id) }}" class="text-decoration-none">
                                    {{-- 修正：object-fitをcontainにし、背景色を追加 --}}
                                    <div style="aspect-ratio: 3/4; overflow: hidden; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ $manga_all->image_url }}" class="w-100 h-100 shadow-sm" style="object-fit: contain;" alt="{{ $manga_all->title }}">
                                    </div>
                                    <div class="card-body p-2 p-md-3 text-start">
                                        <h3 class="card-title text-main fs-6 fw-bold text-truncate mb-1">{{ $manga_all->title }}</h3>
                                        <p class="text-secondary smaller mb-0 text-truncate">{{ $manga_all->description }}</p>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 text-secondary fw-bold">準備中です。</div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center pagination-wrapper">
                    {!! $contents_all->appends(Request::all())->links('pagination::bootstrap-4') !!}
                </div>
            </main>

            {{-- サイドバー --}}
            <aside class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold text-center border-bottom">RECOMMENDED</div>
                        <div class="card-body p-2 d-flex justify-content-center overflow-hidden">
                            <div style="width: 300px;">
                                <ins class="dmm-widget-placement" data-id="bee09c210e9d1989e6509a2edc082bfa" style="background:transparent"></ins>
                                <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts" data-id="bee09c210e9d1989e6509a2edc082bfa"></script>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold text-center border-bottom">人気のカテゴリー</div>
                        <div class="card-body d-flex flex-wrap gap-2 justify-content-center">
                            @isset($tags)
                                @foreach($tags as $tag)
                                    <a href="{{ route('tags.show', $tag->name) }}" class="badge rounded-pill border text-secondary text-decoration-none py-2 px-3 bg-light">#{{ $tag->name }}</a>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                    <div class="card bg-white border shadow-sm">
                        <div class="card-header border-bottom fw-bold small bg-light text-center text-lg-start" style="color: var(--text-main);">
                            <i class="fas fa-clock me-1 text-primary"></i> 最新のレビュー
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($contents_latest as $latest)
                            <a href="{{ route('manga.show', $latest->id) }}" class="list-group-item list-group-item-action bg-white border-bottom small py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $latest->image_url }}" class="rounded me-3 border" style="width: 50px; height: 50px; object-fit: cover;" alt="">
                                    <div class="text-truncate fw-bold" style="color: var(--text-main);">{{ $latest->title }}</div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection