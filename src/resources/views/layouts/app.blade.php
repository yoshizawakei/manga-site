<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JNLK32N9JG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-JNLK32N9JG');
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7530354105922551"
     crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ホーム') | KEI BLOG</title>

    {{-- SEO: メタディスクリプション --}}
    <meta name="description" content="@yield('meta_description', 'KEI BLOGはフリーランスエンジニアKEIが運営するブログです。公務員からエンジニアへの転身記、AI活用、フリーランスのリアルを発信しています。')">

    {{-- SEO: canonical URL --}}
    <link rel="canonical" href="@yield('canonical_url', request()->url())">

    {{-- OGP (Open Graph Protocol) --}}
    <meta property="og:site_name" content="KEI BLOG">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical_url', request()->url())">
    <meta property="og:title" content="@yield('title', 'ホーム') | KEI BLOG">
    <meta property="og:description" content="@yield('meta_description', 'KEI BLOGはフリーランスエンジニアKEIが運営するブログです。公務員からエンジニアへの転身記、AI活用、フリーランスのリアルを発信しています。')">
    <meta property="og:image" content="@yield('og_image', asset('img/profile.png'))">
    <meta property="og:locale" content="ja_JP">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'ホーム') | KEI BLOG">
    <meta name="twitter:description" content="@yield('meta_description', 'KEI BLOGはフリーランスエンジニアKEIが運営するブログです。公務員からエンジニアへの転身記、AI活用、フリーランスのリアルを発信しています。')">
    <meta name="twitter:image" content="@yield('og_image', asset('img/profile.png'))">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Noto+Sans+JP:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --bg-body: #ffffff;
            --text-main: #111111;
            --text-muted: #666666;
            --border-color: #eeeeee;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Inter', 'Noto Sans JP', sans-serif;
            line-height: 1.8;
            letter-spacing: 0.03em;
        }

        /* Navbar */
        .navbar {
            background-color: #fff !important;
            border-bottom: 1px solid var(--border-color);
            padding: 1.2rem 0;
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.3rem;
            letter-spacing: 0.01em;
            color: var(--text-main) !important;
        }

        .nav-link {
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--text-main) !important;
            margin-left: 1.2rem;
        }

        /* ページネーション */
        .pagination .page-link {
            border: none;
            color: var(--text-main);
            font-weight: bold;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--text-main);
            border-radius: 4px;
        }

        footer {
            background-color: #fff;
            border-top: 1px solid #f0f0f0;
            padding: 80px 0;
            margin-top: 100px;
        }

        /* サイドバー崩れ防止 */
        aside .card {
            border: none !important;
            background: none !important;
            margin-bottom: 3rem;
        }

        aside .card-title {
            font-size: 0.9rem;
            font-weight: 700;
            border-bottom: 2px solid #111;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
        }

        .footer-logo a {
            font-size: 1.1rem;
            letter-spacing: 0.2em;
            color: #111;
            opacity: 0.8;
        }

        .footer-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .footer-nav a {
            font-size: 0.65rem;
            font-weight: 700;
            color: #888;
            text-decoration: none;
            letter-spacing: 0.15em;
            transition: color 0.3s ease;
        }

        .footer-nav a:hover {
            color: #111;
        }

        .footer-nav .sep {
            font-size: 0.6rem;
            color: #ddd;
            user-select: none;
        }

        .copyright {
            font-size: 0.6rem;
            color: #bbb;
            letter-spacing: 0.05em;
            margin-top: 20px;
        }

        @media (max-width: 576px) {
            .footer-nav {
                flex-direction: column;
                gap: 12px;
            }
            .footer-nav .sep {
                display: none;
            }
        }

        .sidebar-ad-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: #999;
            margin-bottom: 0.5rem;
        }

        @yield('css')
    </style>

    {{-- JSON-LD 構造化データ（各ページが @section('json_ld') でセット） --}}
    @yield('json_ld')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('top.index') }}">KEI BLOG</a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#main-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('top.index') }}">TOP</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tags.index') }}">CATEGORIES</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('top.contact') }}">CONTACT</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container px-4 d-none d-lg-block text-center my-4">
        <div class="sidebar-ad-label">広告</div>
        <div id="im-d1ddaa8aeaa84e82830f83243e1e1b73">
            <script async src="https://imp-adedge.i-mobile.co.jp/script/v1/spot.js?20220104"></script>
            <script>(window.adsbyimobile=window.adsbyimobile||[]).push({pid:85164,mid:594598,asid:1937397,type:"banner",display:"inline",elementid:"im-d1ddaa8aeaa84e82830f83243e1e1b73"})</script>
        </div>
    </div>

    <div class="container px-4 d-lg-none text-center my-4">
        <div class="sidebar-ad-label">広告</div>
        <div id="im-c293c8b0bdb840fe86787f8b2d01ab1a">
            <script async src="https://imp-adedge.i-mobile.co.jp/script/v1/spot.js?20220104"></script>
            <script>(window.adsbyimobile=window.adsbyimobile||[]).push({pid:85164,mid:594598,asid:1937398,type:"banner",display:"inline",elementid:"im-c293c8b0bdb840fe86787f8b2d01ab1a"})</script>
        </div>
    </div>

    <main>@yield('content')</main>

    <footer>
        <div class="container">
            <div class="footer-content text-center">
                <div class="footer-logo mb-4">
                    <a href="{{ route('top.index') }}" class="fw-black text-decoration-none">KEI BLOG</a>
                </div>

                <nav class="footer-nav mb-4">
                    <a href="{{ route('top.sitePolicy') }}">SITE POLICY</a>
                    <span class="sep">/</span>
                    <a href="{{ route('top.disclaimer') }}">DISCLAIMER</a>
                    <span class="sep">/</span>
                    <a href="{{ route('top.privacyPolicy') }}">PRIVACY POLICY</a>
                </nav>

                <div class="copyright">
                    &copy; {{ date('Y') }} KEI BLOG. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>

</html>
