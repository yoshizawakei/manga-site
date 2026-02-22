<!DOCTYPE html>
<html lang="ja" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- タイトル --}}
    <title>@yield('title', 'ホーム') | Keiの副業ログ ｜未経験からの収益化実践記</title>

        {{-- メタタグ --}}
    <meta name="description" content="@yield('description', 'スキルなし・知識ゼロから副業ブログをスタート。初収益を出すまでの道のりや、初心者がつまずきやすいポイントを実体験ベースで共有。一歩ずつ着実に収益化を目指す記録です。')">
    <meta name="keywords" content="@yield('keywords', '副業,ブログ運営,収益化,初心者,実践記,未経験,在宅ワーク,アフィリエイト')">

    {{-- OGP設定 --}}
    <meta property="og:site_name" content="Keiの副業ログ｜未経験からの収益化実践記">
    <meta property="og:title" content="@yield('title', 'ホーム') | Keiの副業ログ">
    <meta property="og:description" content="@yield('description', 'スキルなし・知識ゼロから副業ブログをスタート。初収益を出すまでの道のりや、初心者がつまずきやすいポイントを実体験ベースで共有。一歩ずつ着実に収益化を目指す記録です。')">
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

        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--primary-color) !important;
        }

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

        /* カードにマウスを置いた時の動き */
        .card.h-100 {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card.h-100:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        /* タイトルを最大2行に制限 */
        .card-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
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
            .main-content-container img {
                max-width: 100%;
                height: auto;
                border-radius: 0.5rem;
            }
            /* テーブルがスマホで崩れないように */
            .main-content-container table {
                width: 100%;
                margin-bottom: 1rem;
                overflow-x: auto;
                display: block;
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
                    {{-- 成長をイメージするアイコンに変更 --}}
                    <i class="fas fa-shoe-prints me-2"></i>Keiの副業ログ
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link px-3 fw-bold" href="{{ route('top.index') }}">ホーム</a>
                        </li>
                        {{-- アフィリエイトブログで役立つ「カテゴリ（タグ）」や「実践記」への導線 --}}
                        <li class="nav-item"><a class="nav-link px-3 fw-bold" href="{{ route('tags.index') }}">ジャンル別</a>
                        </li>
                        <li class="nav-item"><a class="nav-link px-3 fw-bold"
                                href="{{ route('top.contact') }}">お問い合わせ</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        {{-- コンテンツの背景に少し余白を持たせるため、必要に応じてcontainerで囲むと綺麗です --}}
        @yield('content')
    </main>

    <footer class="text-center py-5 mt-5 border-top bg-white">
        <div class="container">
            <div class="mb-4">
                <p class="fw-bold mb-1">Keiの副業ログ</p>
                <p class="text-secondary small">未経験からの収益化実践記</p>
            </div>
            <ul class="list-inline mb-4">
                <li class="list-inline-item mx-2"><a href="{{ route('top.sitePolicy') }}"
                        class="text-secondary text-decoration-none small">サイトポリシー</a></li>
                <li class="list-inline-item mx-2"><a href="{{ route('top.disclaimer') }}"
                        class="text-secondary text-decoration-none small">免責事項</a></li>
                <li class="list-inline-item mx-2"><a href="{{ route('top.privacyPolicy') }}"
                        class="text-secondary text-decoration-none small">プライバシーポリシー</a></li>
            </ul>
            <p class="text-secondary small">&copy; {{ date('Y') }} Keiの副業ログ - All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('script')
    @yield('scripts')
</body>
</html>