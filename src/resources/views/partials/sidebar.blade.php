<div class="sidebar-inner">
    {{-- プロフィール --}}
    <div class="sidebar-section">
        <div class="profile-icon">
            <img class="profile-icon-img" src="{{ asset('img/profile.png') }}" alt="icon">
        </div>
        <h3 class="sidebar-name">KEI</h3>
        <p class="sidebar-text">
            元地方公務員。現在はフリーランスエンジニアをしながら、ブログの運営をしています。
        </p>
        <a href="{{ route('top.profile') }}" class="sidebar-link">プロフィール詳細 →</a>
    </div>

    {{-- カテゴリー --}}
    <div class="sidebar-section">
        <h2 class="sidebar-title">CATEGORIES</h2>
        <ul class="sidebar-list">
            @isset($tags)
                @foreach($tags->take(10) as $tag)
                    <li><a href="{{ route('tags.show', $tag->name) }}">{{ $tag->name }}</a></li>
                @endforeach
            @endisset
        </ul>
    </div>

    {{-- 最新記事 --}}
    <div class="sidebar-section">
        <h2 class="sidebar-title">RECENT POSTS</h2>
        <div class="sidebar-latest">
            @isset($contents_latest)
                @foreach($contents_latest->take(5) as $latest)
                    <a href="{{ route('post.show', $latest->encrypted_id) }}" class="latest-item">
                        <img src="{{ $latest->image_url }}" alt="">
                        <span class="latest-title">{{ $latest->title }}</span>
                    </a>
                @endforeach
            @endisset
        </div>
    </div>
</div>