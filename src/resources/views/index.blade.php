@extends('layouts.app')

@section('content')
    <div class="container-xxl my-4">
        <section class="other-manga-section">
            <h2 class="section-title text-white">漫画一覧</h2>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 manga-grid">
                @if(isset($contents_all))
                    @forelse($contents_all as $manga_all)
                        <div class="col">
                            <div class="card manga-card border-0 p-0 h-100">
                                <a href="{{ $manga_all->content_url }}" target="_blank" rel="noopener noreferrer"
                                    class="text-decoration-none text-white">
                                    <img src="{{ $manga_all->image_url }}" class="card-img-top" alt="{{ $manga_all->title }}">
                                    <div class="card-body p-3">
                                        <h3 class="card-title fs-6 fw-bold text-truncate">{{ $manga_all->title }}</h3>
                                        <div class="manga-description card-text text-secondary small">{{ $manga_all->description }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        @for ($i = 0; $i < 4; $i++)
                            <div class="col">
                                <div class="card manga-card border-0 p-0 h-100 placeholder-glow">
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="250"
                                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                                        preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#333"></rect>
                                    </svg>
                                    <div class="card-body p-3">
                                        <h3 class="card-title fs-6 fw-bold text-truncate placeholder col-8"></h3>
                                        <p class="card-text text-secondary small manga-description placeholder col-10"></p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endforelse
                @endif
            </div>

            <div class="pagination-links mt-5 d-flex justify-content-center">
                @if(isset($contents_all))
                    {{-- Bootstrap 4 のページネーションスタイルを適用 --}}
                    {{ $contents_all->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </section>
    </div>
@endsection