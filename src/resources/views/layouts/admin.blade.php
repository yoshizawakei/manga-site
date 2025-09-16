<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <main>
        @yield('content')
    </main>

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
                // .is-active クラスをトグルする
                menuToggle.classList.toggle('is-active');
                mainNav.classList.toggle('is-active');
            });
        });
    </script>
    @yield('scripts')

</body>

</html>