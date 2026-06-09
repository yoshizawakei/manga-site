<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Google Fonts: モダンなフォントを採用 --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Noto+Sans+JP:wght@400;700&display=swap"
        rel="stylesheet">

    {{-- Bootstrap & FontAwesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- 既存のCSS --}}
    <link rel="stylesheet" href="{{ asset("css/layouts/sanitize.css") }}">

    <title>@yield('title') | 管理パネル</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">

    <style>
        :root {
            --bg-light: #f8fafc;
            --primary-color: #10b981;
            --primary-dark: #059669;
            --text-main: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --card-bg: #ffffff;
        }

        /* 横揺れ・はみ出しバグを完全にシャットアウト */
        html,
        body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: var(--bg-light);
            color: var(--text-main);
            font-family: 'Inter', 'Noto Sans JP', sans-serif;
            line-height: 1.6;
        }

        /* ヘッダー・ナビゲーション */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: var(--text-main) !important;
            font-weight: 600;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* 【最重要修正】
          メインコンテンツが子ビューのBootstrapグリッド（rowやcol）を破壊しないよう、
          ブロック要素として素直に幅100%を維持させます。
        */
        main {
            width: 100%;
            display: block;
        }

        /* フッター */
        footer {
            background-color: #f1f5f9;
            border-top: 1px solid var(--border-color);
            padding: 3rem 0 2rem;
            margin-top: 4rem;
            /* コンテンツとの適度なディスタンス */
            width: 100%;
        }

        .footer-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .footer-link:hover {
            color: var(--primary-color);
        }

        .smaller {
            font-size: 0.75rem;
        }

        .bg-primary-subtle-custom {
            background-color: #f0fdf4;
        }

        /* モバイル用のメニュー調整 */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #ffffff;
                margin: 0.5rem -1rem -0.5rem -1rem;
                padding: 1rem;
                border-top: 1px solid var(--border-color);
            }

            .nav-item {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
        }
    </style>
    @stack('css')
</head>

<body>
    {{-- 管理者用のナビゲーションバー（Keiの副業ログ） --}}
    <header>
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container-xxl">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-seedling me-2"></i>Keiの副業ログ
                </a>
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item px-2">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">管理パネルホーム</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-1"></i>ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- メインコンテンツ：ここに対象の管理者画面がはめ込まれます --}}
    <main>
        @yield('content')
    </main>

    {{-- 管理者用フッター --}}
    <footer>
        <div class="container-xxl">
            <div class="row g-4 mb-4 align-items-center">
                <div class="col-12 col-md-4 text-center text-md-start">
                    <h5 class="fw-bold mb-2">Keiの副業ログ</h5>
                    <p class="text-secondary small mb-0">Webエンジニアが挑む<br>アフィリエイト・副業の実践記録。</p>
                </div>
                <div class="col-12 col-md-8 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item px-2"><a href="{{ route('top.sitePolicy') }}"
                                class="footer-link">サイトポリシー</a></li>
                        <li class="list-inline-item px-2"><a href="{{ route('top.disclaimer') }}"
                                class="footer-link">免責事項</a></li>
                        <li class="list-inline-item px-2"><a href="{{ route('top.privacyPolicy') }}"
                                class="footer-link">プライバシーポリシー</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-top pt-4 text-center">
                <p class="text-secondary smaller mb-0">&copy; {{ date('Y') }} Keiの副業ログ All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>