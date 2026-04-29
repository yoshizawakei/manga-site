@extends('layouts.app')

@section('title', 'PRIVACY POLICY')

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                {{-- ヘッダー：他ページと完全同期 --}}
                <header class="mb-5">
                    <h1 class="fw-black mb-3"
                        style="font-size: 2.0rem; letter-spacing: 0.01em; text-transform: uppercase; color: #111;">
                        PRIVACY POLICY
                    </h1>
                    <p class="text-secondary small" style="letter-spacing: 0.1em;">
                        プライバシーポリシー
                    </p>
                </header>

                {{-- リード文 --}}
                <div class="mb-5 pb-4 border-bottom">
                    <p class="fw-bold" style="font-size: 1.1rem; line-height: 1.8; color: #111;">
                        「KEI BLOG」（以下、当ブログ）は、読者の皆様の個人情報保護の重要性を認識し、法令を遵守するとともに、本プライバシーポリシーに従い適切に取り扱います。
                    </p>
                </div>

                <div class="policy-content">
                    <section class="mb-5">
                        <h3 class="section-title">1. 個人情報の取得について</h3>
                        <p class="section-text">当ブログは、お問い合わせフォームのご利用、または広告サービスを通じて、以下の情報を取得する場合があります。</p>
                        <ul class="list-unstyled ms-2">
                            <li class="mb-2 d-flex align-items-center small fw-bold">
                                <i class="fas fa-chevron-right me-3" style="font-size: 0.7rem;"></i>
                                <span>お名前・メールアドレス（お問い合わせ時）</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center small fw-bold">
                                <i class="fas fa-chevron-right me-3" style="font-size: 0.7rem;"></i>
                                <span>IPアドレス</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center small fw-bold">
                                <i class="fas fa-chevron-right me-3" style="font-size: 0.7rem;"></i>
                                <span>Cookie（クッキー）情報</span>
                            </li>
                        </ul>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">2. 個人情報の利用目的</h3>
                        <p class="section-text">取得した情報は、以下の目的で適切に利用します。</p>
                        <ul class="list-unstyled ms-2">
                            <li class="mb-2 d-flex align-items-center small fw-bold">
                                <i class="fas fa-check me-3" style="font-size: 0.8rem;"></i>
                                <span>お問い合わせへの回答および本人確認</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center small fw-bold">
                                <i class="fas fa-check me-3" style="font-size: 0.8rem;"></i>
                                <span>サービスの改善、アクセスの統計分析</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center small fw-bold">
                                <i class="fas fa-check me-3" style="font-size: 0.8rem;"></i>
                                <span>広告配信の効果測定および最適化</span>
                            </li>
                        </ul>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">3. 広告の配信について</h3>
                        <p class="section-text">
                            当ブログでは、第三者配信の広告サービス（Googleアドセンス、Amazonアソシエイト、A8.net、もしもアフィリエイト等）を利用しています。
                        </p>
                        <div class="p-4 bg-light border-start border-dark border-4 mt-3">
                            <h4 class="h6 fw-black mb-3 text-uppercase" style="letter-spacing: 0.05em;">Cookie Usage</h4>
                            <p class="small mb-0 text-dark" style="line-height: 1.7;">
                                広告配信事業者は、ユーザーの興味に応じた商品やサービスの広告を表示するため、Cookieを使用して当サイトや他サイトへのアクセスに関する情報を収集することがあります。
                                これにより得られる情報に氏名、住所、メールアドレス、電話番号は含まれません。
                            </p>
                        </div>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">4. アクセス解析ツールについて</h3>
                        <p class="section-text">
                            当ブログでは、Googleによるアクセス解析ツール「Googleアナリティクス」を利用しています。トラフィックデータは匿名で収集されており、個人を特定するものではありません。
                            この機能はCookieを無効にすることで収集を拒否することが出来ますので、お使いのブラウザの設定をご確認ください。
                        </p>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">5. 第三者提供の制限</h3>
                        <p class="section-text">法令に基づく場合を除き、ご本人の同意を得ることなく個人情報を第三者に提供することはありません。</p>
                    </section>
                </div>

                <footer class="mt-5 pt-5 border-top text-center">
                    <p class="small text-secondary mb-4" style="letter-spacing: 0.05em;">最終改定日：2026年04月27日</p>
                    <a href="{{ route('top.index') }}" class="sidebar-link">BACK TO TOP →</a>
                </footer>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .fw-black {
            font-weight: 900 !important;
        }

        /* 見出し：サイトポリシーと完全同期 */
        .section-title {
            font-size: 1.3rem;
            font-weight: 900;
            color: #111;
            margin-bottom: 1.5rem;
            padding-bottom: 8px;
            border-bottom: 1px solid #111;
            display: inline-block;
        }

        /* 本文のテキスト */
        .section-text {
            font-size: 0.95rem;
            line-height: 2;
            color: #444;
            margin-bottom: 1.5rem;
        }

        /* リンクスタイル */
        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111;
            text-decoration: none;
            border-bottom: 1px solid #111;
            padding-bottom: 2px;
            display: inline-block;
        }

        /* アイコン */
        .fa-check,
        .fa-chevron-right {
            color: #111;
        }
    </style>
@endsection