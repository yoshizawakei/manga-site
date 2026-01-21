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

    <style>
        /* 共有いただいたCSS定義を統合 */
        :root {
            /* ベース：深い紺色（真っ黒よりも奥行きが出ます） */
            --bg-dark: #0f172a; 
            /* カード：少しだけ明るい紺（階層を表現） */
            --card-bg: #1e293b;
            /* メインカラー：上品なエメラルド（目に優しくおしゃれ） */
            --primary-color: #10b981; 
            /* アクセント：落ち着いたゴールド（高級感） */
            --accent-color: #f59e0b; 
            /* ボーダー：馴染む程度の暗いグレー */
            --border-color: #334155;
            /* テキスト：純白ではなく少しグレーを混ぜて読みやすく */
            --text-main: #f1f5f9;
            --text-secondary: #94a3b8;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Inter', 'Noto Sans JP', sans-serif; /* モダンなフォント */
        }

        /* 共通：コンテンツコンテナ（規約、お問い合わせ等） */
        .main-content-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 3rem 1.5rem;
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .main-content-container h2 {
            color: var(--primary-color);
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        /* リンク設定 */
        a { color: var(--secondary-color); text-decoration: none; transition: 0.3s; }
        a:hover { color: var(--primary-color); }

        /* ヘッダー */
        .navbar {
            background-color: rgba(15, 23, 42, 0.8) !important;
            backdrop-filter: blur(10px); /* すりガラス効果 */
            border-bottom: 1px solid var(--border-color);
        }
        .navbar-brand { font-weight: 900; letter-spacing: 2px; color: var(--primary-color) !important; }

        /* カード共通 */
        .manga-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .manga-card:hover { transform: translateY(-5px); }

        /* ヒーローセクションの装飾 */
        .hero-section {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-main) !important;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: -1;
        }

        /* サイドバーのカード */
        .card {
            border-radius: 0.75rem;
            border-color: var(--border-color);
        }

        .card-header {
            background-color: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid var(--border-color);
        }

        /* リストグループの調整 */
        .list-group-item {
            transition: background-color 0.2s;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }

        .smaller {
            font-size: 0.75rem;
        }
        
        .smaller { font-size: 0.7rem; }
        .ad-container { transition: 0.3s; }
        .cta-section { 
            background: linear-gradient(to bottom, #1e1e1e, #121212); 
            border: 1px solid #333 !important;
        }
        .btn-warning {
            background-color: var(--accent-color);
            color: #ffffff;
            border: none;
            font-weight: 600;
        }
        .btn-warning:hover {
            background-color: #ffca2c;
            transform: scale(1.05);
        }
        @yield('css')
    </style>
    {{-- layouts/app.blade.php の <head> 内に追加 --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
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