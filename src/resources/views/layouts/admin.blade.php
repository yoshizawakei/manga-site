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

    {{-- 既存のCSS（適宜パスを調整してください） --}}
    <link rel="stylesheet" href="{{ asset("css/layouts/sanitize.css") }}">

    <title>@yield('title') | Keiの副業ログ</title>

    <style>
        :root {
            --bg-light: #f8fafc;
            /* サイト全体の背景色 */
            --primary-color: #10b981;
            /* メインカラー（エメラルド） */
            --primary-dark: #059669;
            /* ホバー時の濃い色 */
            --text-main: #1e293b;
            /* メイン文字色（深い紺色） */
            --text-secondary: #64748b;
            /* サブ文字色（グレー） */
            --border-color: #e2e8f0;
            /* 境界線 */
            --card-bg: #ffffff;
            /* カードの背景 */
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-main);
            font-family: 'Inter', 'Noto Sans JP', sans-serif;
            line-height: 1.6;
        }

        /* ヘッダー・ナビゲーション */
        .navbar {
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
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

        /* 共通コンテナ */
        .main-content-container {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            overflow: hidden;
        }

        /* フッター */
        footer {
            background-color: #f1f5f9;
            border-top: 1px solid var(--border-color);
            padding: 4rem 0 2rem;
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

        /* 汎用クラス */
        .smaller {
            font-size: 0.75rem;
        }

        .bg-primary-subtle-custom {
            background-color: #f0fdf4;
        }

        @yield('css')
    </style>
</head>

<body>
    {{-- ヘッダー：ロゴと主要ナビ --}}
    <header>
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container-xxl">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('top.index') }}">
                    <i class="fas fa-seedling me-2"></i>Keiの副業ログ
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#main-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item px-2">
                            <a class="nav-link" href="{{ route('top.index') }}">ホーム</a>
                        </li>

                        {{-- ログインしている場合 --}}
                        @auth
                                <li class="nav-item px-2">
                                    <a class="nav-link text-primary fw-bold" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-1"></i>管理パネル
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i>ログアウト
                                    </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            {{-- ログインしていない場合 --}}
                        @else
                            <li class="nav-item px-2">
                                <a class="nav-link" href="{{ route('top.profile') }}">プロフィール</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link" href="{{ route('tags.index') }}">カテゴリー</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link" href="{{ route('top.contact') }}">お問い合わせ</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- メインコンテンツ --}}
    <main>
        @yield('content')
    </main>

    {{-- フッター：法的リンクと著作権 --}}
    <footer>
        <div class="container-xxl">
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-4 text-center text-md-start">
                    <h5 class="fw-bold mb-3">Keiの副業ログ</h5>
                    <p class="text-secondary small">Webエンジニアが挑む<br>アフィリエイト・副業の実践記録。</p>
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
                <p class="text-secondary smaller">&copy; {{ date('Y') }} Keiの副業ログ All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @yield('scripts')
    @yield('script')
</body>

</html>