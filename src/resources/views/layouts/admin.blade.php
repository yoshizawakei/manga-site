<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/layouts/sanitize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/layouts/common.css") }}">
    @yield("css")
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

    <main>
        @yield('content')
    </main>

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