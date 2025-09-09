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
            <h1>ドキドキ漫画</h1>
            <button class="menu-toggle" aria-controls="main-nav" aria-expanded="false">
                <span class="hamburger-icon"></span>
            </button>
            <nav id="main-nav" class="main-nav">
                <ul>
                    <li><a href="#">ホーム</a></li>
                    <li><a href="#">タグ一覧</a></li>
                    <li><a href="#">お問合せ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="main-wrapper">
        <section class="hero-section">
            <div class="hero-content">
                <h2>話題の漫画から懐かしの名作まで</h2>
                <p>あなたにぴったりの一冊を見つけよう</p>
                <form action="#" method="GET" class="search-form-inline">
                    <input type="text" name="keyword" placeholder="キーワードを入力して検索" value="{{ request('keyword') }}">
                    <button type="submit">検索</button>
                </form>
            </div>
        </section>

        <section class="ad-section top-ad-section">
            <div class="ad-grid">
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </section>

        <div class="content-container">
            <main>
                <section class="new-releases">
                    <h2 class="section-title">新着・おすすめ作品</h2>
                    <div class="manga-grid">
                        {{-- 新着・おすすめ作品のデータを表示するループ --}}
                        @if(isset($contents_latest))
                            @forelse($contents_latest as $manga)
                                <div class="manga-card">
                                    <a href="{{ $manga->content_url }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ $manga->image_url }}" alt="{{ $manga->title }}">
                                        <h3>{{ $manga->title }}</h3>
                                    </a>
                                </div>
                            @empty
                                <p class="no-results">新着・おすすめ作品が見つかりませんでした。</p>
                            @endforelse
                        @else
                            {{-- APIテストができない場合のダミーデータ --}}
                            @for ($i = 0; $i < 12; $i++)
                                <div class="manga-card">
                                    <a href="#" target="_blank" rel="noopener noreferrer">
                                        <img src="https://via.placeholder.com/180x250.png?text=Manga+Cover+{{ $i + 1 }}"
                                            alt="ダミー漫画タイトル{{ $i + 1 }}">
                                        <h3>ダミー漫画タイトル{{ $i + 1 }}</h3>
                                    </a>
                                </div>
                            @endfor
                        @endif
                    </div>
                </section>

                @yield('content')
            </main>

            <!-- <aside>
                <div class="ad-section sidebar-ad-section">
                    <div class="ad-grid">
                        <div class="ad-item">
                            <script async
                                src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                                crossorigin="anonymous"></script>
                            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                                data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class="ad-item">
                            <script async
                                src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                                crossorigin="anonymous"></script>
                            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                                data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class="ad-item">
                            <script async
                                src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                                crossorigin="anonymous"></script>
                            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                                data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class="ad-item">
                            <script async
                                src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                                crossorigin="anonymous"></script>
                            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                                data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
                </div>
            </aside> -->
        </div>
        <section class="ad-section bottom-ad-section">
            <div class="ad-grid">
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="ad-item">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxxxxxxxxxx"
                        crossorigin="anonymous"></script>
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                        data-ad-slot="yyyyy" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} 漫画manga</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.querySelector('.menu-toggle');
            const mainNav = document.getElementById('main-nav');

            menuToggle.addEventListener('click', () => {
                // .is-active クラスをトグルする
                menuToggle.classList.toggle('is-active');
                mainNav.classList.toggle('is-active');
            });
        });
    </script>
    @yield('scripts')

</body>

</html>