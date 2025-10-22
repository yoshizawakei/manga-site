@extends('layouts.app')

@section('content')
    <div class="container-xxl my-4">
        <section class="other-manga-section">
            <h2 class="section-title text-white border-bottom border-secondary pb-2 mb-4 fs-3 fw-bold">{{ $title }}</h2>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 manga-grid">
                @if ($contents->count() > 0)
                    @foreach ($contents as $content)
                        <div class="col">
                            <div class="card manga-card border-0 p-0 h-100">
                                <a href="{{ $content->content_url }}" target="_blank" rel="noopener noreferrer"
                                    class="text-decoration-none text-white">
                                    <img src="{{ $content->image_url }}" class="card-img-top" alt="{{ $content->title }}">
                                    <div class="card-body p-3">
                                        <h3 class="card-title fs-6 fw-bold text-truncate">{{ $content->title }}</h3>
                                        <div class="manga-description card-text text-secondary small">
                                            {{ Str::limit($content->description, 70) }}</div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p class="no-results alert alert-secondary text-dark text-center">
                            <i class="fas fa-search-minus me-2"></i>該当するコンテンツは見つかりませんでした。
                        </p>
                    </div>
                @endif
            </div>

            <div class="pagination-links mt-5 d-flex justify-content-center">
                {{-- Bootstrap 5 のページネーションスタイルを適用 --}}
                {{ $contents->links('pagination::bootstrap-5') }}
            </div>
        </section>
    </div>
@endsection