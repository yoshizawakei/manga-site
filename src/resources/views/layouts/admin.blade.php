<!DOCTYPE html>
<html lang="ja" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD0z3W2ShW4SgM7U+mB0n7MvUq0F/UjPjG/P3UaYl9ZJ8E0+W5H1Vp/o0M0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset("css/layouts/sanitize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/layouts/common.css") }}">
    @yield("css")

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-43VEPFSJSE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-43VEPFSJSE');
    </script>
    <title>ドキドキ漫画 @yield('title')</title>
</head>

<body class="bg-dark text-white">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
            <div class="container-xxl">
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

    <main class="container-xxl my-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-center py-4 mt-5 border-top border-secondary">
        <div class="container-xxl">
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
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // カスタムトグル処理は不要
        });
    </script>
    @yield('scripts')

</body>

</html>