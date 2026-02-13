<!DOCTYPE html>
<html lang="ja" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO対策 --}}
    <title>@yield('title', 'ホーム') | エロ漫画と夜のおもちゃ</title>
    <meta name="description" content="@yield('description', 'エロ漫画と夜のおもちゃは、毎日更新される漫画や大人のおもちゃのレビューメディアです。')">
    <meta name="keywords" content="@yield('keywords', '漫画レビュー,おすすめ漫画,無料漫画,エロ漫画,夜のおもちゃ,アダルトトイ')">
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- OGP設定 --}}
    <meta property="og:site_name" content="エロ漫画と夜のおもちゃ">
    <meta property="og:title" content="@yield('title', 'ホーム') | エロ漫画と夜のおもちゃ">
    <meta property="og:description" content="@yield('description', '毎日更新される厳選漫画と大人のおもちゃのレビューメディア。')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    {{-- 外部リソース --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --bg-light: #f8fafc;
            --card-bg: #ffffff;
            --primary-color: #10b981;
            --border-color: #e2e8f0;
            --text-main: #1e293b;
            --text-secondary: #64748b;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-main);
            font-family: 'Inter', 'Noto Sans JP', sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
        }

        .navbar-brand { font-weight: 800; color: var(--primary-color) !important; }

        /* コンテナ共通パディング */
        .main-content-container, .contact-container, .policy-container, .detail-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            padding: 3rem !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        /* 巨大な矢印アイコンを隠し、ページネーションを整える */
        .pagination svg {
            width: 20px;
            height: 20px;
        }
        .pagination .flex.justify-between.flex-1 {
            display: none; /* スマホ用の重複表示を消す */
        }

        /* 広告横揺れ防止用 */
        .ad-scroll-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            display: flex;
            justify-content: center;
            padding: 1rem 0;
        }
        .ad-scroll-container > div {
            min-width: 728px;
            flex-shrink: 0;
        }

        /* ボタン崩れ防止 */
        .btn-responsive-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .btn-responsive-group {
                flex-direction: column;
                align-items: center;
                width: 100%;
            }
            .btn-responsive-group .btn {
                width: 100%;
                max-width: 300px;
                padding: 1rem !important;
            }
            .main-content-container, .contact-container {
                padding: 1.5rem !important;
            }
        }

        @yield('css')
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container-xxl">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('top.index') }}">
                    <i class="fas fa-book-open me-2"></i>エロ漫画と夜のおもちゃ
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link px-3 fw-bold" href="{{ route('top.index') }}">ホーム</a></li>
                        <li class="nav-item"><a class="nav-link px-3 fw-bold" href="{{ route('tags.index') }}">タグ一覧</a></li>
                        <li class="nav-item"><a class="nav-link px-3 fw-bold" href="{{ route('top.contact') }}">お問合せ</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="text-center py-5 mt-5 border-top bg-white">
        <div class="container">
            <ul class="list-inline mb-4">
                <li class="list-inline-item mx-2"><a href="{{ route('top.sitePolicy') }}" class="text-secondary text-decoration-none small">サイトポリシー</a></li>
                <li class="list-inline-item mx-2"><a href="{{ route('top.disclaimer') }}" class="text-secondary text-decoration-none small">免責事項</a></li>
                <li class="list-inline-item mx-2"><a href="{{ route('top.privacyPolicy') }}" class="text-secondary text-decoration-none small">個人情報保護</a></li>
            </ul>
            <p class="text-secondary small">&copy; {{ date('Y') }} エロ漫画と夜のおもちゃ - All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>