@extends('layouts.app')

@section('title', 'SITE POLICY')

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                {{-- ヘッダー：他ページと完全同期 --}}
                <header class="mb-5">
                    <h1 class="fw-black mb-3"
                        style="font-size: 2.0rem; letter-spacing: 0.01em; text-transform: uppercase; color: #111;">
                        SITE POLICY
                    </h1>
                    <p class="text-secondary small" style="letter-spacing: 0.1em;">
                        サイトポリシー・利用規約
                    </p>
                </header>

                {{-- リード文：装飾を排除し、タイポグラフィで読ませる --}}
                <div class="mb-5 pb-4 border-bottom">
                    <p class="fw-bold" style="font-size: 1.1rem; line-height: 1.8; color: #111;">
                        「KEI BLOG」は、Webエンジニアである運営者が得た知識を技術を実践する「とりあえずやってみる」ための個人ブログです。
                        ユーザーの皆様に有益かつ安全な情報を提供するため、以下の通り利用規約を定めます。
                    </p>
                </div>

                <div class="policy-content">
                    <section class="mb-5">
                        <h3 class="section-title">1. 知的財産権について</h3>
                        <p class="section-text">
                            当サイトに掲載されている文章、画像、ソースコード、およびその他のコンテンツの著作権は、運営者または正当な権利者に帰属します。
                            これらを無断で複製、転載、販売する行為は固く禁じます。
                        </p>
                        <div class="p-4 bg-light border-start border-dark border-4 mt-3">
                            <p class="small mb-0 text-dark" style="line-height: 1.6;">
                                <i class="fas fa-info-circle me-2"></i>
                                技術的な解説のためのコードスニペットの参照などは自由ですが、コンテンツ全体の無断コピーはご遠慮ください。
                            </p>
                        </div>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">2. リンクについて</h3>
                        <p class="section-text">
                            当サイトは原則リンクフリーです。リンクを行う際の許可や連絡は不要です。
                            ただし、インラインフレームの使用や画像の直リンク、公序良俗に反するサイトからのリンクはご遠慮ください。
                        </p>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">3. アフィリエイトプログラムについて</h3>
                        <p class="section-text">
                            当サイトでは、各アフィリエイトプログラム（Googleアドセンス、Amazonアソシエイト、バリューコマース等）を利用して商品やサービスを紹介しています。
                            紹介している商品やサービスは当サイトが販売しているものではありません。購入に関するトラブル等は販売元へ直接お問い合わせください。
                        </p>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title">4. 禁止事項</h3>
                        <p class="section-text">利用者は、当サイトの利用にあたり、以下の行為を行ってはならないものとします。</p>
                        <ul class="list-unstyled ms-2">
                            <li class="mb-3 d-flex align-items-start small fw-bold">
                                <i class="fas fa-times me-3 mt-1"></i>
                                <span>法令または公序良俗に違反する行為</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start small fw-bold">
                                <i class="fas fa-times me-3 mt-1"></i>
                                <span>当サイトのサーバーまたはネットワークの機能を破壊・妨害する行為</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start small fw-bold">
                                <i class="fas fa-times me-3 mt-1"></i>
                                <span>他の利用者に対する誹謗中傷や迷惑行為</span>
                            </li>
                        </ul>
                    </section>
                </div>

                <footer class="mt-5 pt-5 border-top text-center">
                    <p class="small text-secondary mb-4" style="letter-spacing: 0.05em;">改定日：2026年04月27日</p>
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

        /* 見出し：記事詳細のH2などと共通のルール */
        .section-title {
            font-size: 1.3rem;
            font-weight: 900;
            color: #111;
            margin-bottom: 1.5rem;
            padding-bottom: 8px;
            border-bottom: 1px solid #111;
            display: inline-block;
        }

        /* 本文のテキスト：読みやすさを考慮した行間 */
        .section-text {
            font-size: 0.95rem;
            line-height: 2;
            color: #444;
            margin-bottom: 1.5rem;
        }

        /* サイドバー等と共通のリンクスタイル */
        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111;
            text-decoration: none;
            border-bottom: 1px solid #111;
            padding-bottom: 2px;
            display: inline-block;
        }

        /* アイコンの色調整（モノトーン） */
        .fa-times {
            color: #111;
            font-size: 0.8rem;
        }

        .fa-info-circle {
            color: #111;
        }
    </style>
@endsection