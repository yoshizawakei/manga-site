@extends('layouts.app')

@section('title', ' | ' . $content->title . 'のレビュー・感想')
@section('description', $content->title . 'の徹底レビュー！あらすじから管理人の熱い感想、おすすめポイントまで詳しく解説しています。')

@section('content')
<div class="row g-4">
    <article class="col-lg-8">
        <div class="main-content-container mt-0 shadow-sm border p-4 p-md-5">
            {{-- パンくずリスト：text-white-50を完全に排除 --}}
            <nav aria-label="breadcrumb" class="mb-4 small">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('top.index') }}" class="text-decoration-none">ホーム</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $content->title }}</li>
                </ol>
            </nav>

            <header class="mb-4">
                <h1 class="h2 fw-bold mb-3" style="color: var(--text-main);">{{ $content->title }}</h1>
                <div class="text-secondary small">
                    <i class="far fa-calendar-alt me-1"></i>{{ $content->created_at->format('Y.m.d') }}
                </div>
            </header>

            {{-- 中央画像：背景をbg-light、枠線を追加 --}}
            <div class="text-center mb-5 bg-light rounded p-4 border">
                <img src="{{ $content->image_url }}" alt="{{ $content->title }}" class="img-fluid rounded shadow-sm" style="max-height: 600px;">
            </div>

            <div class="manga-review-body py-4 border-top">
                <h2 class="h4 border-start border-4 border-primary ps-3 mb-4 fw-bold" style="color: var(--text-main);">管理人のレビュー・感想</h2>
                <div class="review-text fs-5 mb-5" style="color: var(--text-main); line-height: 1.8;">
                    {!! nl2br(e($content->body)) ?: '<p class="text-secondary">レビュー執筆中...</p>' !!}
                </div>

                {{-- 広告：白背景に馴染むよう修正 --}}
                <div class="ad-section-wrapper p-3 rounded bg-white border shadow-sm mt-5">
                    <div class="text-center">
                        <p class="text-secondary mb-2 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.1em;">
                            <i class="fas fa-thumbs-up me-1 text-primary"></i>あなたへのおすすめ作品
                        </p>
                        <div class="d-flex justify-content-center align-items-center overflow-auto" style="min-height: 110px;">
                            <div style="min-width: 728px; flex-shrink: 0;">
                                <ins class="dmm-widget-placement" data-id="526c6c1e3807186e9de662e4bf9d0970" style="background:transparent"></ins>
                                <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts" data-id="526c6c1e3807186e9de662e4bf9d0970"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="cta-section text-center py-5 rounded-4 border bg-light mt-5">
                <h3 class="h5 mb-3 fw-bold" style="color: var(--text-main);">この商品を今すぐチェック</h3>
                <a href="{{ $content->content_url }}" target="_blank" rel="nofollow noopener" class="btn btn-lg btn-warning px-5 py-3 fw-bold shadow-sm">
                    <i class="fas fa-external-link-alt me-2"></i>公式サイトで詳しく見る
                </a>
            </section>
        </div>
    </article>

    <aside class="col-lg-4">
        <div class="sticky-top" style="top: 100px;">
            <div class="card bg-white border mb-4 shadow-sm overflow-hidden">
                <div class="card-header border-bottom fw-bold text-primary small bg-light text-center">
                    RECOMMENDED
                </div>
                <div class="card-body p-2 bg-white">
                    <div class="d-flex justify-content-center align-items-center overflow-hidden" style="min-height: 250px;">
                        <div style="width: 300px; flex-shrink: 0;">
                            <ins class="dmm-widget-placement" data-id="bee09c210e9d1989e6509a2edc082bfa" style="background:transparent"></ins>
                            <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts" data-id="bee09c210e9d1989e6509a2edc082bfa"></script>
                        </div>
                    </div>
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
@endsection