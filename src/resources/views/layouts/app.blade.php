<!DOCTYPE html>
<html lang="ja" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="無料で読めるエロ漫画を毎日更新！あなたにぴったりの一冊を見つけよう。">
    <meta name="keywords" content="エロ漫画, 無料漫画, 新着漫画, おすすめ漫画, ドキドキ漫画">
    <meta name="author" content="ドキドキ漫画">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD0z3W2ShW4SgM7U+mB0n7MvUq0F/UjPjG/P3UaYl9ZJ8E0+W5H1Vp/o0M0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset("css/layouts/sanitize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/layouts/common.css") }}">
    <link rel="stylesheet" href="{{ asset('css/tags.css') }}">
    @yield("css")

    <style>
        .ad-center-block {
            /* 中央寄せのためマージンを左右autoに設定 */
            margin-left: auto !important;
            margin-right: auto !important;
            /* ブロック要素として動作することを明示 */
            display: block !important;
        }
    </style>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-43VEPFSJSE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-43VEPFSJSE');
    </script>
    <title>ドキドキ漫画 - 無料で読めるエロ漫画を毎日更新！</title>
</head>

<body class="bg-dark text-white">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
            <div class="container-fluid container-xxl">
                <a class="navbar-brand header-h1" href="{{ route("top.index") }}">ドキドキ漫画</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
                    aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("top.index") }}"><i class="fas fa-home me-1"></i>ホーム</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("tags.index") }}"><i
                                    class="fas fa-tags me-1"></i>タグ一覧</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("top.contact") }}"><i
                                    class="fas fa-envelope me-1"></i>お問合せ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-xxl my-4 main-wrapper">

        <section class="hero-section text-center p-5">
            <div class="hero-content">
                <h2 class="display-5 fw-bold text-white mb-3">無料で読めるエロ漫画を毎日更新しています！</h2>
                <p class="lead text-secondary mb-4">あなたにぴったりの一冊を見つけよう</p>
                <form action="{{ route('search.results') }}" method="GET"
                    class="search-form-inline d-flex justify-content-center">
                    <input type="text" name="keyword" placeholder="キーワードを入力して検索" value="{{ request('keyword') }}"
                        class="form-control form-control-lg me-2 border-secondary" style="max-width: 450px;">
                    <button type="submit" class="btn btn-lg btn-warning fw-bold">
                        <i class="fas fa-search me-1"></i>検索
                    </button>
                </form>
            </div>
        </section>

        <div class="row content-container g-3 d-flex justify-content-center">
            <main class="col-lg-8">
                <script src="https://adm.shinobi.jp/s/65c86dec891067fdd7176002a8ef3181"></script>

                <section class="ad-section-inline my-4">
                    <div class="row g-0 d-flex justify-content-center">
                        <div class="col">
                            <div class="card bg-secondary border-0 p-2 ad-item ad-placeholder ad-center-block">
                                <ins class="dmm-widget-placement" data-id="b52df2cfb345572d2e574978552aca8b"
                                    style="background:transparent"></ins>
                                <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                                    data-id="b52df2cfb345572d2e574978552aca8b"></script>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-secondary border-0 p-2 ad-item ad-placeholder ad-center-block">
                                <ins class="dmm-widget-placement" data-id="ac8e424ab539c275eea2af4ad51e25b6"
                                    style="background:transparent"></ins>
                                <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                                    data-id="ac8e424ab539c275eea2af4ad51e25b6"></script>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="new-releases js-fadein my-5">
                    @if(isset($contents_latest))
                        <h2 class="section-title">新着・おすすめ作品</h2>
                        <div class="row row-cols-2 row-cols-md-3 g-3 manga-grid">
                            @forelse($contents_latest as $manga)
                                <div class="col">
                                    <div class="card manga-card border-0 p-0 h-100">
                                        <a href="{{ $manga->content_url }}" target="_blank" rel="noopener noreferrer"
                                            class="text-decoration-none text-white">
                                            <img src="{{ $manga->image_url }}" class="card-img-top" alt="{{ $manga->title }}">
                                            <div class="card-body p-3">
                                                <h3 class="card-title fs-6 fw-bold text-truncate">{{ $manga->title }}</h3>
                                                <div class="manga-description card-text text-secondary small">
                                                    {{ $manga->description }}
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
                        </div>
                    @endif
                </section>
                @yield('content')

                <section class="ad-section-inline my-5">
                    <h3 class="ad-section-title text-white-50">おすすめのサービス</h3>
                    <div class="row g-0 d-flex justify-content-center">
                        <div class="col-12 col-md-6">
                            <div class="card bg-secondary border-0 p-2 ad-item ad-placeholder ad-center-block">
                                <ins class="dmm-widget-placement" data-id="b52df2cfb345572d2e574978552aca8b"
                                    style="background:transparent"></ins>
                                <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                                    data-id="b52df2cfb345572d2e574978552aca8b"></script>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card bg-secondary border-0 p-2 ad-item ad-placeholder ad-center-block">
                                <ins class="dmm-widget-placement" data-id="ac8e424ab539c275eea2af4ad51e25b6"
                                    style="background:transparent"></ins>
                                <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                                    data-id="ac8e424ab539c275eea2af4ad51e25b6"></script>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="col-lg-4 mt-4 mt-lg-0">
                <div class="sidebar p-4">
                    <h3>人気ランキング</h3>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item bg-transparent border-0"><a href="#"
                                class="text-white text-decoration-none">人気作品A</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#"
                                class="text-white text-decoration-none">人気作品B</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#"
                                class="text-white text-decoration-none">人気作品C</a></li>
                    </ul>
                    <h3>タグから探す</h3>
                    <div class="tag-list d-flex flex-wrap gap-2">
                        @forelse($tags as $tag)
                            <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}"
                                class="btn btn-sm btn-outline-secondary tag-link">{{ $tag->name }}</a>
                        @empty
                            <p class="no-results text-white-50">タグが見つかりませんでした。</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>

        <section class="ad-section bottom-ad-section mt-5">
            <h3 class="ad-section-title text-white-50">その他の注目サービス</h3>
            <div class="row row-cols-1 row-cols-md-3 g-0 text-center">
                <div class="col">
                    <div class="card bg-secondary border-0 p-3 ad-item ad-placeholder ad-center-block">
                        <script src="https://adm.shinobi.jp/s/df349200fae07afe14174435c7accc6e"></script>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-secondary border-0 p-3 ad-item ad-placeholder ad-center-block">
                        <ins class="dmm-widget-placement" data-id="715e75385c21d5f934f66fdff0ed5e48"
                            style="background:transparent"></ins>
                        <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                            data-id="715e75385c21d5f934f66fdff0ed5e48"></script>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-secondary border-0 p-3 ad-item ad-placeholder ad-center-block">
                        <script src="https://adm.shinobi.jp/s/df349200fae07afe14174435c7accc6e"></script>
                    </div>
                </div>
            </div>
        </section>

        <section class="ad-section bottom-ad-section mt-3">
            <div class="row row-cols-1 row-cols-md-3 g-0 text-center">
                <div class="col">
                    <div class="card bg-secondary border-0 p-3 ad-item ad-placeholder ad-center-block">
                        <ins class="dmm-widget-placement" data-id="9e88f64eebb3d09da9a930c57dd138a1"
                            style="background:transparent"></ins>
                        <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                            data-id="9e88f64eebb3d09da9a930c57dd138a1"></script>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-secondary border-0 p-3 ad-item ad-placeholder ad-center-block">
                        <script src="https://adm.shinobi.jp/s/df349200fae07afe14174435c7accc6e"></script>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-secondary border-0 p-3 ad-item ad-placeholder ad-center-block">
                        <ins class="dmm-widget-placement" data-id="d38144138179f7d463277fa158b634dc"
                            style="background:transparent"></ins>
                        <script src="https://widget-view.dmm.co.jp/js/placement.js" class="dmm-widget-scripts"
                            data-id="d38144138179f7d463277fa158b634dc"></script>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-dark text-center py-4 mt-5 border-top border-secondary">
        <nav class="footer-nav mb-3">
            <ul class="list-inline">
                <li class="list-inline-item mx-2"><a href="{{ route('top.sitePolicy') }}"
                        class="text-decoration-none text-white-50 small">サイトポリシー・利用規約</a></li>
                <li class="list-inline-item mx-2"><a href="{{ route("top.disclaimer") }}"
                        class="text-decoration-none text-white-50 small">免責事項</a></li>
                <li class="list-inline-item mx-2"><a href="{{ route("top.privacyPolicy") }}"
                        class="text-decoration-none text-white-50 small">個人情報保護方針</a></li>
            </ul>
        </nav>
        <p class="text-white-50 mb-0">&copy; {{ date('Y') }} ドキドキ漫画</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // BootstrapのNavbarTogglerを使用するため、元のトグル処理は削除または無効化
            /*
            const menuToggle = document.querySelector('.menu-toggle');
            const mainNav = document.getElementById('main-nav');
            menuToggle.addEventListener('click', () => {
                menuToggle.classList.toggle('is-active');
                mainNav.classList.toggle('is-active');
            });
            */

            const fadeinElements = document.querySelectorAll('.js-fadein');

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            fadeinElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(el);
            });
        });
    </script>
    @yield('scripts')

</body>

</html>