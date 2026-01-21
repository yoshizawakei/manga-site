@extends('layouts.app')

@section('content')
    {{-- 1. ヒーローセクション (中央揃え) --}}
    <section class="hero-clean bg-white border-bottom py-5 mb-5">
        <div class="container-xxl text-center">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="mb-3">
                        <span
                            class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 fw-bold"></span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4" style="color: var(--text-main);">エロ漫画と夜のおもちゃのレビューサイト<br>
                        <span style="color: var(--primary-color);">ドキドキ漫画</span>
                    </h1>
                    <p class="lead text-secondary mb-5 mx-auto" style="max-width: 700px;">
                        話題の新作から隠れた名作まで、実際に読んで徹底レビュー。<br>
                        あなたの「次に読みたい」が見つかる、漫画・商品ナビゲーションメディア。
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#main-content"
                            class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold shadow-sm">最新レビュー</a>
                        <a href="{{ route('tags.index') }}"
                            class="btn btn-outline-dark btn-lg px-5 py-3 rounded-pill fw-bold">タグ検索</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-xxl" id="main-content">
        <div class="row g-4">
            {{-- メイン：一覧 --}}
            <main class="col-lg-8">
                <h2 class="h3 fw-bold mb-4 pb-2 border-bottom">最新の漫画レビュー</h2>

                <div class="row g-3 g-md-4">
                    @forelse($contents_all as $index => $manga_all)
                        {{-- 広告挿入 --}}
                        @if($index > 0 && $index % 6 == 0)
                            <div class="col-12 my-3">
                                <div class="ad-scroll-container bg-white border rounded shadow-sm">
                                    <div>
                                        <ins class="dmm-widget-placement" data-id="526c6c1e3807186e9de662e4bf9d0970"
                                            style="background:transparent"></ins>
                                        <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                                            data-id="526c6c1e3807186e9de662e4bf9d0970"></script>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- カード --}}
                        <div class="col-6 col-md-4">
                            <article class="card h-100 border-0 shadow-sm overflow-hidden bg-white">
                                <a href="{{ route('manga.show', $manga_all->id) }}" class="text-decoration-none text-dark">
                                    <div style="aspect-ratio: 3/4; overflow: hidden;">
                                        <img src="{{ $manga_all->image_url }}" class="w-100 h-100 object-fit-cover"
                                            alt="{{ $manga_all->title }}">
                                    </div>
                                    <div class="card-body p-2 p-md-3">
                                        <h3 class="fs-6 fw-bold text-truncate mb-1">{{ $manga_all->title }}</h3>
                                        <p class="text-secondary small mb-0 text-truncate">{{ $manga_all->description }}</p>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">準備中です。</div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{-- 修正：エラー回避のため標準のlinks()を使用 --}}
                    {{ $contents_all->links() }}
                </div>
            </main>

            {{-- サイドバー --}}
            <aside class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold text-center">RECOMMENDED</div>
                        <div class="card-body p-2 d-flex justify-content-center overflow-hidden">
                            <div style="width: 300px;">
                                <ins class="dmm-widget-placement" data-id="bee09c210e9d1989e6509a2edc082bfa"
                                    style="background:transparent"></ins>
                                <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                                    data-id="bee09c210e9d1989e6509a2edc082bfa"></script>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold text-center">人気のカテゴリー</div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                                <a href="{{ route('tags.show', $tag->name) }}"
                                    class="badge rounded-pill border text-secondary text-decoration-none py-2 px-3 bg-light">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection