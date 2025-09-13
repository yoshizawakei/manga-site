<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/layouts/sanitize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/layouts/common.css") }}">
    @yield("css")

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXXXXX');
    </script>
    <title>ドキドキ漫画</title>
</head>

<body>
    <header>
        <div class="header-inner">
            <a class="header-h1" href="{{ route("top.index") }}">ドキドキ漫画</a>
            <button class="menu-toggle" aria-controls="main-nav" aria-expanded="false">
                <span class="hamburger-icon"></span>
            </button>
            <nav id="main-nav" class="main-nav">
                <ul>
                    <li><a href="{{ route("top.index") }}">ホーム</a></li>
                    <li><a href="{{ route("tags.index") }}">タグ一覧</a></li>
                    <li><a href="{{ route("top.contact") }}">お問合せ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="main-wrapper">
        <section class="hero-section">
            <div class="hero-content">
                <h2>無料で読めるエロ漫画を毎日更新しています！</h2>
                <p>あなたにぴったりの一冊を見つけよう</p>
                {{-- 検索フォームのactionを修正 --}}
                <form action="{{ route('search.results') }}" method="GET" class="search-form-inline">
                    <input type="text" name="keyword" placeholder="キーワードを入力して検索" value="{{ request('keyword') }}">
                    <button type="submit">検索</button>
                </form>
            </div>
        </section>

        <section class="ad-section top-ad-section">
            <div class="ad-grid">
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
            </div>
        </section>

        <section class="ad-section top-ad-section">
            <div class="ad-grid">
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
            </div>
        </section>

        <div class="content-container">
            <main>
                <section class="new-releases">
                @if(isset($contents_latest))
                    <h2 class="section-title">新着・おすすめ作品</h2>
                    <div class="manga-grid">
                        @forelse($contents_latest as $manga)
                            <div class="manga-card">
                                <a href="{{ $manga->content_url }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ $manga->image_url }}" alt="{{ $manga->title }}">
                                    <!-- <h3>{{ $manga->title }}</h3> -->
                                    <div class="manga-description">{{ $manga->description }}</div>
                                    <!-- <div class="manga-tag">
                                        @foreach ($manga->tags as $tag)
                                            <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}">#{{ $tag->name }}</a>
                                        @endforeach
                                    </div> -->
                                </a>
                            </div>
                        @empty
                            <div class="manga-card">
                                <a href="#">
                                    <img src="#" alt="ここに画像が入ります">
                                    <div class="manga-description">ここに商品紹介が入ります。</div>
                                </a>
                            </div>
                            <div class="manga-card">
                                <a href="#">
                                    <img src="#" alt="ここに画像が入ります">
                                    <div class="manga-description">ここに商品紹介が入ります。</div>
                                </a>
                            </div>
                            <div class="manga-card">
                                <a href="#">
                                    <img src="#" alt="ここに画像が入ります">
                                    <div class="manga-description">ここに商品紹介が入ります。</div>
                                </a>
                            </div>
                            <div class="manga-card">
                                <a href="#">
                                    <img src="#" alt="ここに画像が入ります">
                                    <div class="manga-description">ここに商品紹介が入ります。</div>
                                </a>
                            </div>
                        @endforelse
                    </div>
                @endif
                </section>
                @yield('content')
            </main>
        </div>
        <section class="ad-section bottom-ad-section">
            <div class="ad-grid">
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
            </div>
        </section>

        <section class="ad-section bottom-ad-section">
            <div class="ad-grid">
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
                <div class="ad-item ad-placeholder">
                    <p>広告準備中</p>
                    <script type="text/javascript" src="https://adm.shinobi.jp/s/xxxxxxxxxxxxxx" async></script>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <nav class="footer-nav">
            <ul>
                <li><a href="{{ route('top.sitePolicy') }}">サイトポリシー・利用規約</a></li>
                <li><a href="{{ route("top.disclaimer") }}">免責事項</a></li>
                <li><a href="{{ route("top.privacyPolicy") }}">個人情報保護方針</a></li>
            </ul>
        </nav>
        <p>&copy; {{ date('Y') }} ドキドキ漫画</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.querySelector('.menu-toggle');
            const mainNav = document.getElementById('main-nav');

            menuToggle.addEventListener('click', () => {
                menuToggle.classList.toggle('is-active');
                mainNav.classList.toggle('is-active');
            });
        });
    </script>
    @yield('scripts')

</body>

</html>