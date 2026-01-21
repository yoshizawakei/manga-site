@extends('layouts.app')

@section('title', ' | ' . $title)

@section('content')
    <div class="container-xxl my-4">
        <section class="other-manga-section">
            {{-- セクションタイトル：エメラルドのアクセント --}}
            <div class="d-flex align-items-center mb-4 border-bottom border-secondary pb-3">
                <h2 class="section-title text-white mb-0 fs-3 fw-bold">
                    <i class="fas fa-layer-group me-2 text-primary"></i>{{ $title }}
                </h2>
                <span class="ms-3 badge rounded-pill bg-dark border border-secondary text-secondary small">
                    {{ $contents->total() }} items
                </span>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 manga-grid">
                @if ($contents->count() > 0)
                    @foreach ($contents as $content)
                        <div class="col">
                            {{-- 修正：manga-card クラスを適用し、デザインを統一 --}}
                            <article class="card manga-card border-0 p-0 h-100 shadow-sm overflow-hidden">
                                {{-- 修正：詳細ページ(manga.show)へのリンクに変更し、内部回遊を促す --}}
                                <a href="{{ route('manga.show', $content->id) }}" class="text-decoration-none text-white">
                                    <div class="position-relative overflow-hidden">
                                        <img src="{{ $content->image_url }}" class="card-img-top" alt="{{ $content->title }}" 
                                             style="aspect-ratio: 3/4; object-fit: cover; transition: transform 0.5s ease;">
                                    </div>
                                    <div class="card-body p-3">
                                        <h3 class="card-title fs-6 fw-bold text-truncate mb-2">{{ $content->title }}</h3>
                                        <div class="manga-description card-text text-secondary smaller" style="line-height: 1.5;">
                                            {{ Str::limit($content->description, 50) }}
                                        </div>
                                        
                                        {{-- タグがあれば表示（任意） --}}
                                        @if($content->tags->count() > 0)
                                            <div class="mt-2 pt-2 border-top border-secondary border-opacity-50">
                                                <span class="text-primary smaller">
                                                    #{{ $content->tags->first()->name }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 py-5 text-center">
                        <div class="no-results p-5 rounded-4 bg-dark bg-opacity-50 border border-secondary border-dashed">
                            <i class="fas fa-search-minus fa-3x text-secondary mb-3"></i>
                            <p class="text-secondary fs-5 mb-0">該当するコンテンツは見つかりませんでした。</p>
                            <a href="{{ route('top.index') }}" class="btn btn-outline-primary mt-4 px-4 rounded-pill">
                                トップページに戻る
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ページネーション --}}
            <div class="pagination-links mt-5 d-flex justify-content-center">
                {{ $contents->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
@endsection

@section('css')
<style>
    /* 画像ホバー時のズームエフェクト */
    .manga-card:hover img {
        transform: scale(1.1);
    }
    
    /* カードのテキスト調整 */
    .smaller {
        font-size: 0.75rem;
    }
    
    /* 枠線がダッシュ（点線）のスタイル（結果なし用） */
    .border-dashed {
        border-style: dashed !important;
    }
</style>
@endsection