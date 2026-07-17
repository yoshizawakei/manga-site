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

    {{-- 広告（i-mobile / サイドバー） --}}
    <div class="sidebar-section">
        <div class="sidebar-ad-label">広告</div>
        <div id="im-e2b65fc20ce945419f3a7c10f62dbf09">
            <script async src="https://imp-adedge.i-mobile.co.jp/script/v1/spot.js?20220104"></script>
            <script>(window.adsbyimobile=window.adsbyimobile||[]).push({pid:85164,mid:594598,asid:1937394,type:"banner",display:"inline",elementid:"im-e2b65fc20ce945419f3a7c10f62dbf09"})</script>
        </div>
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
                    <a href="{{ route('post.show', $latest->slug) }}" class="latest-item">
                        <img src="{{ $latest->image_url }}" alt="">
                        <span class="latest-title">{{ $latest->title }}</span>
                    </a>
                @endforeach
            @endisset
        </div>
    </div>
</div>