@extends('layouts.app')

@section('title', 'DISCLAIMER')

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                {{-- ヘッダー：他ページと完全同期 --}}
                <header class="mb-5">
                    <h1 class="fw-black mb-3"
                        style="font-size: 2.5rem; letter-spacing: 0.01em; text-transform: uppercase; color: #111;">
                        DISCLAIMER
                    </h1>
                    <p class="text-secondary small" style="letter-spacing: 0.1em;">
                        免責事項
                    </p>
                </header>

                {{-- リード文 --}}
                <div class="mb-5 pb-4 border-bottom">
                    <p class="fw-bold" style="font-size: 1.1rem; line-height: 1.8; color: #111;">
                        「KEI BLOG」（以下、当ブログ）における免責事項は、下記の通りです。
                    </p>
                </div>

                <div class="policy-content">
                    <section class="mb-5">
                        <h3 class="section-title">1. 情報の正確性について</h3>
                        <p class="section-text">
                            当ブログのコンテンツや情報において、可能な限り正確な情報を掲載するよう努めておりますが、誤情報が入り込んだり、情報が古くなっていることもございます。
                            特にIT技術や副業関連の情報は変化が早いため、必ずしも正確性や安全性を保証するものではありません。
                        </p>
                        <div class="p-4 bg-light border-start border-dark border-4 mt-3">
                            <p class="small mb-0 text-dark fw-bold" style="line-height: 1.6;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                当ブログに掲載された内容によって生じた損害等の一切の責任を負いかねますのでご了承ください。
                            </p>
                        </div>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">2. リンク先サイトについて</h3>
                        <p class="section-text">
                            当ブログから移動した先のサイトで提供される情報、サービス等について一切の責任を負いません。
                            また、当ブログで紹介しているサービスやツールの利用に関しては、ユーザーご自身の責任において行っていただけますようお願いいたします。
                        </p>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">3. 広告について</h3>
                        <p class="section-text">
                            当ブログはアフィリエイトプログラムに参加しており、商品やサービスを紹介しています。
                            紹介している商品等の詳細な購入方法、お問い合わせは、リンク先の各販売店へ直接ご確認ください。当ブログではお答えいたしかねる場合がございます。
                        </p>
                    </section>
                </div>

                <footer class="mt-5 pt-5 border-top text-center">
                    <p class="small text-secondary mb-4" style="letter-spacing: 0.05em;">最終改訂日：2026年04月27日</p>
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

        /* 見出し：他の固定ページと共通のスタイル */
        .section-title {
            font-size: 1.3rem;
            font-weight: 900;
            color: #111;
            margin-bottom: 1.5rem;
            padding-bottom: 8px;
            border-bottom: 1px solid #111;
            display: inline-block;
        }

        /* 本文のテキスト：読みやすさを優先 */
        .section-text {
            font-size: 0.95rem;
            line-height: 2;
            color: #444;
            margin-bottom: 1.5rem;
        }

        /* 他のページと同期したリンクスタイル */
        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111;
            text-decoration: none;
            border-bottom: 1px solid #111;
            padding-bottom: 2px;
            display: inline-block;
        }

        /* 注意喚起ボックスのアイコンカラー */
        .fa-exclamation-triangle {
            color: #111;
        }
    </style>
@endsection