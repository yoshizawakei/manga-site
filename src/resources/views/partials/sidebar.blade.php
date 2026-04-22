<aside class="col-lg-4">
    <div class="sticky-top" style="top: 100px;">
        {{-- 運営者プロフィール --}}
        <div class="card border-0 shadow-sm mb-4 text-center p-4 bg-white">
            <div class="mb-3">
                <i class="fas fa-user-circle fa-4x text-primary-emphasis"></i>
            </div>
            <h5 class="fw-bold mb-2">Kei</h5>
            <p class="text-secondary small">
                元公務員。現在はフリーランスエンジニアをしながら、副業アフィリエイトに挑戦中。
            </p>
            <a href="{{ route('top.profile') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">プロフィール詳細</a>
        </div>

        {{-- カテゴリー一覧（タグ） --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-bold text-center border-bottom">カテゴリー</div>
            <div class="card-body d-flex flex-wrap gap-2 justify-content-center">
                @isset($tags)
                    @foreach($tags as $tag)
                        <a href="{{ route('tags.show', $tag->name) }}" class="badge rounded-pill border text-secondary text-decoration-none py-2 px-3 bg-light">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                @endisset
            </div>
        </div>

        {{-- 最近の更新 --}}
        <div class="card bg-white border shadow-sm">
            <div class="card-header border-bottom fw-bold small bg-light text-center text-lg-start" style="color: var(--text-main);">
                <i class="fas fa-history me-1 text-primary"></i> 最近の更新
            </div>
            <div class="list-group list-group-flush">
                @isset($contents_latest)
                    @foreach($contents_latest as $latest)
                        <a href="{{ route('post.show', $latest->encrypted_id) }}" class="list-group-item list-group-item-action bg-white border-bottom small py-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ $latest->image_url }}" class="rounded me-3 border" style="width: 50px; height: 50px; object-fit: cover;" alt="">
                                <div class="text-truncate fw-bold" style="color: var(--text-main);">{{ $latest->title }}</div>
                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</aside>