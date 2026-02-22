@extends('layouts.app')

@section('title', '免責事項')

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

        .policy-container p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .policy-alert {
            background-color: #fffbeb;
            border: 2px solid #f59e0b;
            color: #b45309;
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 2.5rem 0;
            font-weight: 700;
        }

        .policy-footer {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
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
                            <li class="breadcrumb-item active" aria-current="page">免責事項</li>
                        </ol>
                    </nav>

                    <h2>免責事項</h2>
                    <p class="lead fw-bold" style="color: var(--text-main);">
                        「Keiの副業ログ」（以下、当ブログ）における免責事項は、下記の通りです。
                    </p>

                    <hr class="my-5" style="border-color: var(--border-color); opacity: 1;">

                    <section>
                        <h3>1. 情報の正確性について</h3>
                        <p>
                            当ブログのコンテンツや情報において、可能な限り正確な情報を掲載するよう努めておりますが、誤情報が入り込んだり、情報が古くなっていることもございます。
                            特にIT技術や副業関連の情報は変化が早いため、必ずしも正確性や安全性を保証するものではありません。
                        </p>
                        <div class="policy-alert shadow-sm">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            当ブログに掲載された内容によって生じた損害等の一切の責任を負いかねますのでご了承ください。
                        </div>
                    </section>

                    <section>
                        <h3>2. リンク先サイトについて</h3>
                        <p>
                            当ブログから移動した先のサイトで提供される情報、サービス等について一切の責任を負いません。
                            また、当ブログで紹介しているサービスやツールの利用に関しては、ユーザーご自身の責任において行っていただけますようお願いいたします。
                        </p>
                    </section>

                    <section>
                        <h3>3. 広告について</h3>
                        <p>
                            当ブログはアフィリエイトプログラムに参加しており、商品やサービスを紹介しています。
                            紹介している商品等の詳細な購入方法、お問い合わせは、リンク先の各販売店へ直接ご確認ください。当ブログではお答えいたしかねる場合がございます。
                        </p>
                    </section>

                    <div class="policy-footer">
                        <p class="small text-secondary mb-3">最終改訂日：2026年02月19日</p>
                        <a href="{{ route('top.index') }}" class="btn btn-outline-dark px-5 rounded-pill fw-bold btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>ホームへ戻る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection