@extends('layouts.app')

@section('title', $title . ' の記事一覧')

@section('content')
    <div class="container-xxl my-4">
        <section class="practice-log-section">
            
            {{-- セクションタイトル --}}
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <h1 class="h4 fw-bold mb-0" style="color: var(--text-main);">
                    <i class="fas fa-hashtag me-2 text-primary"></i>{{ $title }}
                </h1>
                <span class="ms-3 badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary-subtle small">
                    {{ $contents->total() }} 記事
                </span>
            </div>

            <div class="row g-4">
                {{-- メインコンテンツ --}}
                <div class="col-lg-8">
                    @if ($contents->count() > 0)
                        <div class="row g-3">
                            @foreach ($contents as $content)
                                <div class="col-12 mb-2">
                                    <article class="card h-100 border-0 shadow-sm overflow-hidden bg-white">
                                        <a href="{{ route('manga.show', $content->id) }}" class="text-decoration-none d-flex flex-column flex-md-row">
                                            {{-- 画像エリア --}}
                                            <div class="col-md-4 col-lg-3" style="background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 150px;">
                                                <img src="{{ $content->image_url }}" class="img-fluid p-2" style="max-height: 140px; object-fit: contain;" alt="{{ $content->title }}">
                                            </div>
                                            
                                            {{-- テキストエリア --}}
                                            <div class="card-body p-3 p-md-4 flex-grow-1">
                                                <div class="text-secondary small mb-1">
                                                    <i class="far fa-calendar-alt me-1"></i>{{ $content->created_at->format('Y.m.d') }}
                                                </div>
                                                <h2 class="card-title text-main fs-5 fw-bold mb-2">{{ $content->title }}</h2>
                                                <p class="text-secondary small mb-0 line-clamp-2">
                                                    {{ Str::limit(strip_tags($content->description), 90) }}
                                                </p>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                            @endforeach
                        </div>

                        {{-- ページネーション --}}
                        <div class="pagination-links mt-5 d-flex justify-content-center">
                            {{ $contents->links('pagination::bootstrap-4') }}
                        </div>

                    @else
                        <div class="py-5 text-center bg-white rounded-4 border shadow-sm">
                            <i class="fas fa-search-minus fa-3x text-light mb-3"></i>
                            <p class="text-secondary fs-5 mb-0">このカテゴリーの記事は準備中です。</p>
                            <a href="{{ route('top.index') }}" class="btn btn-primary mt-4 px-5 rounded-pill shadow-sm">
                                トップページに戻る
                            </a>
                        </div>
                    @endif
                </div>

                {{-- サイドバーの呼び出し --}}
                @include('partials.sidebar')
            </div>
        </section>
    </div>
@endsection

@section('css')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection