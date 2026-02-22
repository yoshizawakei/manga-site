@extends('layouts.app')

@section('title', 'サイトポリシー・利用規約')

@section('css')
    <style>
        .policy-container {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .policy-container h2 {
            color: var(--primary-color);
            font-weight: 800;
            border-left: 6px solid var(--primary-color);
            padding-left: 1.25rem;
            margin-bottom: 2rem;
            letter-spacing: -0.02em;
        }

        .policy-container h3 {
            color: var(--text-main);
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 3rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
        }

        .policy-container h3::before {
            content: "";
            display: inline-block;
            width: 20px;
            height: 3px;
            background-color: var(--primary-color);
            margin-right: 12px;
            border-radius: 2px;
        }

        .policy-container h4 {
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 700;
            margin-top: 1.5rem;
        }

        .policy-container p,
        .policy-container li {
            color: var(--text-secondary);
            line-height: 1.8;
            font-weight: 500;
        }

        .alert-info-custom {
            background-color: #f0fdf4;
            border: 1px solid var(--primary-color);
            color: var(--text-main);
            padding: 1.25rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }

        .breadcrumb-item a {
            color: var(--primary-color) !important;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-9">
            <div class="policy-container shadow-sm bg-white">
                <div class="p-4 p-md-5">
                    <nav aria-label="breadcrumb" class="mb-4 small">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('top.index') }}">ホーム</a></li>
                            <li class="breadcrumb-item active" aria-current="page">サイトポリシー</li>
                        </ol>
                    </nav>

                    <h2>サイトポリシー・利用規約</h2>

                    <p class="lead fw-bold" style="color: var(--text-main);">
                        「Keiの副業ログ」は、Webエンジニアである運営者が副業やアフィリエイト、IT技術に関する情報を発信する個人ブログです。
                        ユーザーの皆様に有益かつ安全な情報を提供するため、以下の通り利用規約を定めます。
                    </p>

                    <hr class="my-5" style="border-color: var(--border-color); opacity: 1;">

                    <section>
                        <h3>1. 知的財産権について</h3>
                        <p>
                            当サイトに掲載されている文章、画像、ソースコード、およびその他のコンテンツの著作権は、運営者または正当な権利者に帰属します。
                            これらを無断で複製、転載、販売する行為は固く禁じます。
                        </p>
                        <div class="alert-info-custom shadow-sm">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            技術的な解説のためのコードスニペットの参照などは自由ですが、コンテンツ全体の無断コピーはご遠慮ください。
                        </div>
                    </section>

                    <section>
                        <h3>2. リンクについて</h3>
                        <p>
                            当サイトは原則リンクフリーです。リンクを行う際の許可や連絡は不要です。
                            ただし、インラインフレームの使用や画像の直リンク、公序良俗に反するサイトからのリンクはご遠慮ください。
                        </p>
                    </section>

                    <section>
                        <h3>3. アフィリエイトプログラムについて</h3>
                        <p>
                            当サイトでは、各アフィリエイトプログラム（Googleアドセンス、Amazonアソシエイト、バリューコマース等）を利用して商品やサービスを紹介しています。
                            紹介している商品やサービスは当サイトが販売しているものではありません。購入に関するトラブル等は販売元へ直接お問い合わせください。
                        </p>
                    </section>

                    <section>
                        <h3>4. 禁止事項</h3>
                        <p>利用者は、当サイトの利用にあたり、以下の行為を行ってはならないものとします。</p>
                        <ul class="list-unstyled ms-3">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-times-circle text-danger me-2 mt-1"></i>
                                <span>法令または公序良俗に違反する行為</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-times-circle text-danger me-2 mt-1"></i>
                                <span>当サイトのサーバーまたはネットワークの機能を破壊・妨害する行為</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-times-circle text-danger me-2 mt-1"></i>
                                <span>他の利用者に対する誹謗中傷や迷惑行為</span>
                            </li>
                        </ul>
                    </section>

                    <footer class="mt-5 pt-4 border-top text-center">
                        <p class="small text-secondary mb-3">改定日：2026年02月19日</p>
                        <a href="{{ route('top.index') }}" class="btn btn-outline-dark px-5 rounded-pill fw-bold btn-sm">
                            <i class="fas fa-home me-2"></i>トップページへ戻る
                        </a>
                    </footer>
                </div>
            </div>
        </div>
    </div>
@endsection