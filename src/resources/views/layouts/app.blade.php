<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("sanitize.css") }}">
    <link rel="stylesheet" href="{{ asset("common.css") }}">
    @yield("css")
    <title>漫画manga</title>
</head>
<body>
    <header>
        <h1>漫画manga</h1>
        <nav>
            <ul>
                <li><a href="#">ホーム</a></li>
                <li><a href="#">漫画一覧</a></li>
                <li><a href="#">漫画を追加</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <aside>
        <h2>サイドバー</h2>
        <ul>
            <li><a href="#">リンク1</a></li>
            <li><a href="#">リンク2</a></li>
            <li><a href="#">リンク3</a></li>
        </ul>
    </aside>

    <footer>
        <p>&copy; {{ date('Y') }} 漫画manga</p>
    </footer>

    @yield('scripts')
    
</body>
</html>